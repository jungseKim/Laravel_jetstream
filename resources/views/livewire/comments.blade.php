<div>
  <div>
    @if (session()->has('message'))
    <div class="p-3 text-green-800 bg-green-300 rounded shadow-sm">
      {{ session('message') }}
      </div>
    @endif
  </div>

  {{-- 라이브 와이어는 바인딩이되므로 메소드가 갔을때 저장만 시키면 되서
  form안에 없어도 상광없다 --}}

  {{-- @can('create',$userId)
   --}}
  @if (auth()->user()->id==$userId)
   <section>
    @if ($image)
      <img src="{{ $image->temporaryUrl() }}" width="200">
    @endif
    <input type="file" 
    wire:model="image" 
    id="image"
    wire:loading.attr="disabled">
   {{-- <label class="w-50">
                <input class="text-sm cursor-pointer w-36 hidden" type="file" multiple>
                <div class="text bg-indigo-600 text-white border border-gray-300 rounded font-semibold cursor-pointer p-1 px-3 hover:bg-indigo-500">Select</div>
            </label> --}}
    <div>
       @error("image")
        <span class="red">{{ $message }}</span>
      @enderror
   </div>
      <div wire:loading wire:target="image">
        file uploading....
    </div>
  </section>


    <form class="flex my-4" wire:submit.prevent="addComment">
      <input wire:model.lazy="newComment" 
      type="text" class="w-full p-2 my-2 mr-2 border rounded shadow"
      placeholder="new commnet here..">
      @error("newComment")
        <span class="text-red">{{ $message }}</span>
      @enderror
      <div class="py-2">
        <button 
          class="w-20 p-2 text-white bg-blue-500 rounded shadow ">
          Add
        </button>
      </div>
      </form>
 @endif
  {{-- @endcan --}}
    @foreach ($comments as $comment)
  <div class="card text-center shadow-2xl">
    <div class="flex justify-between my-2">
        <div class="flex">
          <p class="text-lg font-bold">
            {{ $comment->writer->name }}
          </p>
          <p class="py-1 mx-3 textxs font-semibold text-gray-500">
            {{ $comment->created_at->diffForHumans() }}
          </p>
        </div>
        
        <p class="text-gray-800">
          {{ $comment->text }}
        </p>
           <div>
              <i wire:click="$emit('deleteClicked',{{ $comment->id }})" 
            class="fas fa-angry hover:text-red-600"></i>
             <i wire:click="$emit('openModal','edit-comment',{{ json_encode(['commentId'=>$comment->id])}})" 
            class="fas fa-edit hover:text-red-600"></i>
           </div>
        @if ($comment->image)
          <img src="{{ $comment->image_path }}"/>
        @endif
    </div>
</div> 
@endforeach
{{ $comments->links() }}

</div>

<script>
  window.livewire.on('deleteClicked',(id)=>{
    if(confirm("Are you sure to delete?")){
      window.livewire.emit('delete',id);
    }
  })
  </script>
