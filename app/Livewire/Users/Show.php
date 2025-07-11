<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض تفاصيل مستخدم | Show User Component
 */
class Show extends Component
{
    public User $user;

    public function mount(User $user)
    {
        abort_unless(Gate::allows('manage users'), 403);
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.users.show', [
            'user' => $this->user,
        ]);
    }
}
