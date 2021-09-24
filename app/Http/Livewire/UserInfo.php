<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class UserInfo extends ModalComponent
{

    public $user;
    public $loginCheck;
    public function render()
    {
        return view('livewire.user-info');
    }

    public function mount($userId)
    {
        $this->user = User::find($userId);


        $this->loginCheck = DB::table('sessions')->where('user_id', $userId)->exists();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
