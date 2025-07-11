<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/**
 * مكون تعديل مستخدم | Edit User Component
 */
class Edit extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $role;

    public function mount(User $user)
    {
        abort_unless(Gate::allows('manage users'), 403);
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        if ($this->password) {
            $this->user->password = Hash::make($this->password);
        }
        $this->user->save();
        $this->user->syncRoles([$this->role]);

        session()->flash('success', 'تم تحديث المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'roles' => Role::all(),
        ]);
    }
}
