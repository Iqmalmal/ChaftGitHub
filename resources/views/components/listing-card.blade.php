@props(['listing'])

<x-card>
  <div class="flex flex-col md:flex-row">
    @if (!empty($listing->images))
      <a href="/listings/{{$listing->id}}">
        <img class="md:w-auto md:mr-0" style="hidden:0; max-width: 300px;" src="{{ asset('storage/' . json_decode($listing->images)[0]) }}" alt="Product Image">
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
    </div>
  </div>
</x-card>