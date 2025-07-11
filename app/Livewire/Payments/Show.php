<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض تفاصيل مدفوعات | Show Payment Component
 */
class Show extends Component
{
    public Payment $payment;
    public $confirmingDelete = false;

    public function mount(Payment $payment)
    {
        abort_unless(Gate::allows('manage users'), 403);
        $this->payment = $payment;
    }

    public function confirmDelete()
    {
        abort_unless(Gate::allows('manage payments'), 403);
        $this->confirmingDelete = true;
    }
    public function delete()
    {
        abort_unless(Gate::allows('manage payments'), 403);
        $this->payment->delete();
        session()->flash('success', 'تم حذف الدفع بنجاح | Payment deleted successfully');
        return redirect()->route('payments.index');
    }

    public function render()
    {
        return view('livewire.payments.show', [
            'payment' => $this->payment,
        ]);
    }
}
