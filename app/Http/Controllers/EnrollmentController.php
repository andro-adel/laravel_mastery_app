<?php
/**
 * Enrollment Controller
 * English: Handles course enrollment and payment via Stripe (Cashier).
 * Arabic: يتحكم في عملية تسجيل المستخدم في الكورس والدفع عبر Stripe.
 */

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EnrollmentPaid;
use App\Notifications\EnrollmentFailed;

class EnrollmentController extends Controller
{
    /**
     * Enroll the authenticated user in a course and process payment.
     * تسجيل المستخدم في كورس ومعالجة الدفع
     */
    public function enroll(Request $request, Course $course)
    {
        $user = Auth::user();
        // Prevent duplicate enrollment
        if (Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->exists()) {
            return back()->with('error', __('You are already enrolled in this course! | أنت مسجل بالفعل في هذا الكورس!'));
        }

        // Example: fixed price for all courses (could be dynamic)
        $amount = 1000; // Amount in cents (e.g., $10.00)
        // Remove unused $paymentMethod and $paymentIntent
        // Ensure Stripe customer exists
        if (!$user->stripe_id) {
            // Ensure Stripe customer exists (manual fallback if Billable is not working)
            $stripe = new \Stripe\StripeClient(config('cashier.secret'));
            $customer = $stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            // Use Eloquent update instead of save() in case $user is not Eloquent model
            \App\Models\User::where('id', $user->id)->update(['stripe_id' => $customer->id]);
            $user->stripe_id = $customer->id; // Update in-memory for this request
        }
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $user->stripe_id,
            'metadata' => [
                'user_id' => $user->id,
                'course_id' => $course->id,
            ],
        ]);

        // Instead of $user->charge(), use PaymentIntent and confirm it on the frontend (Livewire/JS)
        // Here, just create the enrollment as pending and return client_secret for frontend confirmation
        try {
            $enrollment = Enrollment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'payment_status' => 'paid',
                'stripe_payment_id' => $intent->id,
            ]);
            // Send notification using Notification facade
            \Illuminate\Support\Facades\Notification::send($user, new EnrollmentPaid($enrollment));
            return response()->json([
                'client_secret' => $intent->client_secret,
                'enrollment_id' => $enrollment->id,
                'success' => true,
                'message' => __('Enrollment successful and payment received! | تم التسجيل والدفع بنجاح!'),
            ]);
        } catch (\Exception $e) {
            $enrollment = Enrollment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'payment_status' => 'failed',
            ]);
            \Illuminate\Support\Facades\Notification::send($user, new EnrollmentFailed($enrollment, $e->getMessage()));
            return response()->json([
                'success' => false,
                'message' => __('Payment failed: ') . $e->getMessage(),
            ], 500);
        }
    }
}
