<x-layout>
  
  @include('partials._hero')
  

  @include('partials._search')
  @include('partials._category')
  
  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($listings) == 0)

    @foreach($listings as $listing)
      @if($listing->stock > 0)
        <x-listing-card :listing="$listing" />
      @endif
    @endforeach

    @else
    <p>No listings found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
</x-layout>
