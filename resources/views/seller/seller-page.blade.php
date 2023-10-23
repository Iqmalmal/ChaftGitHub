<x-layout>
    
    {{-- Hero Section --}}
    <section class="relative h-72 max-h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center" style="background-image: url('images/logo-crop.png')"></div>
        
        <div class="z-10">
            <h1 class="text-4xl md:text-7xl font-bold uppercase text-white">
                <span class="text-black">{{$sellerListing->sellerName}}</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 font-bold my-4">
                Buy or Sell your item
            </p>
        </div>

        <div>
            @auth
            <a href="/listings/create"
                class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Sell Your Item Now!</a>
            @else
            <a href="/register"
                class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">SignUp to Sell Item</a>
            @endauth
        </div>
    </section>

    {{-- Search Section --}}

    <form action="/sellers/{{$sellerListing->id}}" method="GET">
        <div class="relative border-2 border-gray-100 m-4 rounded-lg">
            <div class="absolute top-4 left-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>

            <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search" />

            <div class="absolute top-2 right-2">
            <button type="submit" class="h-10 w-20 text-white rounded-lg bg-laravel hover:laravelHover">
                Search
            </button>
            </div>
        </div>
    </form>

    {{-- Listings Section --}}

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) == 0)
    
        @foreach($listings as $listing)
            
                <x-listing-card :listing="$listing" />
            
        @endforeach
    
        @else
        <p>No listings found</p>
        @endunless
    
    </div>
    
    <div class="mt-6 p-4">
        {{ $search->links() }}
    </div>


</x-layout>