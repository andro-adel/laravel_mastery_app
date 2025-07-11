<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use App\Models\Payment;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Gate;

/**
 * مكون إضافة مدفوعات جديدة | Create Payment Component
 */
class Create extends Component
{
    public $user_id;
    public $enrollment_id;
    public $amount;
    public $status = 'pending';
    public $payment_method;
    public $transaction_id;
    public $paid_at;

    public function mount()
    {
        abort_unless(Gate::allows('manage users'), 403);
    }

    public function save()
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

        Payment::create([
            'user_id' => $this->user_id,
            'enrollment_id' => $this->enrollment_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'transaction_id' => $this->transaction_id,
            'paid_at' => $this->paid_at,
        ]);

        session()->flash('success', 'تمت إضافة المدفوعات بنجاح');
        return redirect()->route('payments.index');
    }

    public function render()
    {
        return view('livewire.payments.create', [
            'users' => User::all(),
            'enrollments' => Enrollment::all(),
        ]);
    }
}
