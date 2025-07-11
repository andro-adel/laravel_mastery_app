<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض قائمة المدفوعات | Payments List Component
 */
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $confirmingDeleteId = null;

    public function mount()
    {
        abort_unless(Gate::allows('manage users'), 403);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        if (!Gate::allows('manage payments')) abort(403);
        $payment->delete();
        session()->flash('success', 'تم حذف الدفع بنجاح | Payment deleted successfully');
        $this->confirmingDeleteId = null;
    }

    public function render()
    {
        $payments = Payment::with(['user', 'enrollment'])
            ->when($this->search, function ($q) {
                $q->whereHas('user', fn($q2) => $q2->where('name', 'like', "%{$this->search}%"))
                  ->orWhere('transaction_id', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.payments.index', [
            'payments' => $payments,
        ]);
    }
}
