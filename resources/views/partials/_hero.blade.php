<section class="relative h-72 max-h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4">
  <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
    style="background-image: url('images/logo-crop.png')"></div>

  <div class="z-10">
    <h1 class="text-4xl md:text-7xl font-bold uppercase text-white">
      Chaft<span class="text-black"> E-Commerce</span>
    </h1>
    <p class="text-lg md:text-2xl text-gray-200 font-bold my-4">
      Buy or Sell your item
    </p>
    <div>
      @auth
		@if(\App\Models\Seller::where('user_id', auth()->id())->exists())
      <a href="/listings/create"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Sell Your Item Now!</a>
		@else
		<a href="/sellerRegister"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Sell Your Item Now!</a>
        @endif
    @else	
      <a href="/register"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">SignUp to Sell Item!</a>
      @endauth
    </div>
  </div>
</section>
