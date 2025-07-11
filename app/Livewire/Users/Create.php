<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/**
 * مكون إضافة مستخدم جديد | Create User Component
 */
class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;

    public function mount()
    {
        abort_unless(Gate::allows('manage users'), 403);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $user->assignRole($this->role);

        session()->flash('success', 'تمت إضافة المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.create', [
            'roles' => Role::all(),
        ]);
    }
}
