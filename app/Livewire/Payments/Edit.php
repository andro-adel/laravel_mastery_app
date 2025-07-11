<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use App\Models\Payment;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Gate;

/**
 * مكون تعديل مدفوعات | Edit Payment Component
 */
class Edit extends Component
{
    public Payment $payment;
    public $user_id;
    public $enrollment_id;
    public $amount;
    public $status;
    public $payment_method;
    public $transaction_id;
    public $paid_at;

    public function mount(Payment $payment)
    {
        abort_unless(Gate::allows('manage users'), 403);
        $this->payment = $payment;
        $this->user_id = $payment->user_id;
        $this->enrollment_id = $payment->enrollment_id;
        $this->amount = $payment->amount;
        $this->status = $payment->status;
        $this->payment_method = $payment->payment_method;
        $this->transaction_id = $payment->transaction_id;
        $this->paid_at = $payment->paid_at;
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,failed,refunded',
            'payment_method' => 'nullable|string',
            'transaction_id' => 'nullable|string',
            'paid_at' => 'nullable|date',
        ]);

        $this->payment->update([
            'user_id' => $this->user_id,
            'enrollment_id' => $this->enrollment_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'transaction_id' => $this->transaction_id,
            'paid_at' => $this->paid_at,
        ]);

        session()->flash('success', 'تم تحديث المدفوعات بنجاح');
        return redirect()->route('payments.index');
    }

    public function render()
    {
        return view('livewire.payments.edit', [
            'users' => User::all(),
            'enrollments' => Enrollment::all(),
        ]);
    }
}
