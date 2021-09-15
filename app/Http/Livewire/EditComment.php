<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;



class EditComment extends ModalComponent
{
    use WithFileUploads;

    public $commentId;
    public $orgComment;
    public $newComment;
    public $image;

    protected $listeners = [
        'update' => 'updateComment'
    ];

    public function updateComment()
    {

        $this->validate([
            'newComment' => 'required',
            'image' => 'nullable|image|max:1024'
        ]);
        $imageFileNAme = null;
        if ($this->image) {
            if ($this->orgComment->image) {
                Storage::disk('public')->delete('images/' . $this->orgComment->image);
            }
            $imageFileNAme = $this->storeImage();
            $this->orgComment->image = $imageFileNAme;
        }
        $this->orgComment->text = $this->newComment;
        $this->orgComment->save();

        $this->newComment = '';
        $this->image = null;


        session()->flash('message', "updated susscesfully");
        $this->closeModal();

        //emit 은 모든 컴포넌트에게 이벤트 전달함
        $this->emit('commentUpdated');
        //한페이지 나타나는 코드는 이벤트를 똑같이 받을수가 있음
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
    public function mount($commentId)
    {
        $this->commentId = $commentId;
        $this->orgComment = Comment::find($commentId);
        $this->newComment = $this->orgComment->text;
    }
    public function storeImage()
    {
        $img = ImageManagerStatic::make($this->image)
            ->resize(300, 300)
            ->encode('jpg');
        $name = Str::random() . '.jpg';
        // $this->image->storeAs('public/images', $name);
        Storage::disk('public')->put('images/' . $name, $img);
        return $name;
    }
}
