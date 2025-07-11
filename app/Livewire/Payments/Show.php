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

    public function mount(Payment $payment)
    {
        abort_unless(Gate::allows('manage users'), 403);
        $this->payment = $payment;
    }

    public function render()
    {
        return view('livewire.payments.show', [
            'payment' => $this->payment,
        ]);
    }
}
