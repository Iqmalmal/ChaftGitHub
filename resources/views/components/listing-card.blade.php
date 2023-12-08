@props(['listing'])

<x-card>
  <div class="flex flex-col md:flex-row">
    @if (!empty($listing->images))
      <a href="/listings/{{$listing->id}}">
        <img class="md:w-auto md:mr-1,5" style="hidden:0; max-width: 300px; margin-right: 15px;" src="{{ asset('storage/' . json_decode($listing->images)[0]) }}" alt="Product Image">
      </a>
    @endif
    <div>
      <h3 class="text-2xl">
        <a href="/listings/{{$listing->id}}">{{$listing->product_name}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$listing->sellerName}}</div>
      <x-listing-tags :tagsCsv="$listing->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
      </div>
      <br>
      <div>
        <a href="/listings/{{$listing->id}}"><button class="bg-cyan-500 text-white rounded w-48 h-15 py-2 px-4 hover:bg-black font-bold ml-96">More Info</button></a>
        {{-- <button class="bg-cyan-500 text-white rounded w-48 h-15 py-2 px-4 hover:bg-black font-bold">Add to cart</button> --}}
      </div>
    </div>
  </div>
</x-card>