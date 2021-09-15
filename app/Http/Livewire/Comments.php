<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;

class Comments extends Component
{

    use WithPagination;
    use WithFileUploads;

    //프론트에서는 퍼블릭만 접근가능
    public $newComment = '';
    public $image;
    public $userId;

    protected $listeners = [
        'delete' => 'remove',
        'commentUpdated' => 'getComments',
        'userSelected'

    ];
    public function userSelected($userId)
    {
        $this->userId = $userId;
    }

    public function getComments()
    {
        // $this->resetPage();
        // $this->render();
        // $this->mount();
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        if ($comment->image) {
            Storage::disk('public')->delete('images/' . $comment->image);
        }
        session()->flash('message', "delete succses");
    }

    protected $rules  = [
        'newComment' => 'required',
        'image' => 'nullable|image|max:1024'

    ];

    // public function updating($name, $value)
    // {
    //     if ($name = 'image') {
    //         $this->validateOnly($name);
    //         if ($this->errorBag()->get('image')) {
    //             $this->image = null;
    //         }
    //     }
    // }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function addComment()
    {
        // dd($this->image);
        $this->validate();
        $imageFileNAme = null;
        if ($this->image) {
            $imageFileNAme = $this->storeImage();
        }
        // dd($imageFileNAme);

        //이거하려면 모델 클래스에 filleble 해줘야됨 
        $d = Comment::create(
            [
                "user_id" => Auth::user()->id,
                "text" => $this->newComment,
                'image' => $imageFileNAme
            ]
        );
        // dd($d->image);
        $this->newComment = '';
        $this->image = null;
        session()->flash('message', "create sussces");
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


    public function render()
    {
        if (!$this->userId) {
            $this->userId = auth()->user()->id;
        }
        return view('livewire.comments', [
            'comments' => Comment::whereUserId($this->userId)->latest()->paginate(5),
        ]);
    }
}
