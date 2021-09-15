<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

      

      <div class="flex my-10 w-12/12">
       <div class="w-4/12 mx-2 px-2 border rounded">
            @livewire('user-list')
       </div>

         <div class="w-8/12 mx-2 px-2 border rounded">
            @livewire('comments')
       </div>
       
    </div>
       
</x-app-layout>