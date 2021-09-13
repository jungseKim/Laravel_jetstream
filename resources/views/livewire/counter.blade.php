<div>
    {{-- The Master doesn't talk, he acts. --}}
    <h1>안녕<h1>
        <div style="text-align: center">
        <button wire:click="increment">+</button>
        <h1>{{ $count }}</h1>
        <button wire:click="decrement">+</button>
    </div>
        <div>
            <input type="text" wire:model.lazy="name"><br>
        <span>{{ $name }}</span>
        </div>
</div>
