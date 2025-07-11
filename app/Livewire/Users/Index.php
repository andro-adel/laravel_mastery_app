<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض قائمة المستخدمين | Users List Component
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
        abort_unless(Gate::allows('manage users'), 403);
        $user = User::findOrFail($id);
        $user->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'تم حذف المستخدم بنجاح');
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('email', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.users.index', [
            'users' => $users,
        ]);
    }
}
