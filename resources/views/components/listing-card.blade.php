@props(['listing'])

<x-card>
  <div class="flex">
    <!-- <img class="hidden w-48 mr-6 md:block"
      src="{{$listing->images ? asset('storage/' . $listing->images) : asset('/images/logo-crop.png')}}" alt="" /> -->
      @if (!empty($listing->images))
    <img class="hidden w-48 mr-6 md:block" src="{{ asset('storage/' . json_decode($listing->images)[0]) }}" alt="Product Image">
@endif
    <div>
      <h3 class="text-2xl">
        <a href="/listings/{{$listing->id}}">{{$listing->product_name}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$listing->seller}}</div>
      <x-listing-tags :tagsCsv="$listing->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
      </div>
    </div>
  </div>
</x-card>