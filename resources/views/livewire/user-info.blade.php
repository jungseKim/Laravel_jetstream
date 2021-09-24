<div>
   <section class="pt-16 bg-blueGray-50">
<div class="w-full px-4 mx-auto">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
    <div class="px-6">
      <div class="text-center mt-12">
        <h3 class="text-xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
         {{$user->name}}
        </h3>
        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold">
        <i class="fas fa-envelope-square mr-2 text-lg text-blueGray-400"></i>
        email: {{ $user->email }}
        </div>
        <div class="mb-2 text-blueGray-600 mt-10">
          <i class="fas fa-male mr-2 text-lg text-blueGray-400"></i>
         created_at{{ $user->created_at }}
        </div>
        <div class="mb-2 text-blueGray-600 font-bold {{ $loginCheck?'bg-green-400':'bg-red-400' }}">
          <i class="fas fa-sign-in-alt mr-2 text-sm text-blueGray-400  "></i>
        Current login: {{ $loginCheck?'login':'logout' }}
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="relative  pt-8 pb-6 mt-8">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-6/12 px-4 mx-auto text-center">
        <div class="text-sm text-blueGray-500 font-semibold py-1">
          Made with <a href="https://www.creative-tim.com/product/notus-js" class="text-blueGray-500 hover:text-gray-800" target="_blank">Notus JS</a> by <a href="https://www.creative-tim.com" class="text-blueGray-500 hover:text-blueGray-800" target="_blank"> Creative Tim</a>.
        </div>
      </div>
    </div>
  </div>
</footer>
</section>
</div>
