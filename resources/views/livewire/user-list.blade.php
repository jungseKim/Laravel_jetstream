<div>
  

    @foreach ($users as $user)
  {{-- @if ($user->id!=$userId)
  <div class="card text-center shadow-2xl">
      @else
      <div class="card text-center shadow-2xl bg-green-400">
  @endif --}}
  <div wire:click="$emit('userSelected',{{ $user->id}})" 
  class="card text-center shadow-2xl {{ $userId==$user->id? 'bg-green-400':'' }}">
    <div class="flex justify-between my-2">
        <div class="flex">
          <p class="text-lg font-bold">
            {{ $user->name }}
          </p>
          <p class="py-1 mx-3 textxs font-semibold text-gray-500">
            {{ $user->created_at->diffForHumans() }}
          </p>
        </div>
           <div>
             <i wire:click ="$emit('openModal', 'user-info',{{ json_encode(['userId'=>$user->id])}})"
            class="fas fa-info-circle hover:text-red-600"></i>
           </div>
    </div>
</div> 
@endforeach
{{ $users->links() }}

</div>

