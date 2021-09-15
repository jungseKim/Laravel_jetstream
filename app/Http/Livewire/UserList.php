<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserList extends Component
{
    protected $listeners = [
        'userSelected',
    ];

    public $userId;

    public function userSelected($userId)
    {
        $this->userId = $userId;
    }
    public function mount()
    {
        $this->userId = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.user-list', [
            'users' => User::latest()->paginate(5)
        ]);
    }
}
