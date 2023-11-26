<x-layout>
  <x-card class="p-10">
    <header>
      <h1 class="text-3xl text-center font-bold my-6 uppercase">
        Manage Product
      </h1>
    </header>

    {{-- <table class="w-full table-auto rounded-sm">
      <tbody>
        @unless($listings->isEmpty())
        @foreach($listings as $listing)
        <tr class="border-gray-300">
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <div class="flex">
            @if (!empty($listing->images))
              <img class="hidden w-20 mr-6 md:block" src="{{ asset('storage/' . json_decode($listing->images)[0]) }}" alt="Product Image">
            @endif
            <a href="/listings/{{$listing->id}}" class="font-bold" style="font-size: 20px;"> {{$listing->product_name}} </a>
            </div>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <a href="/listings/{{$listing->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                class="fa-solid fa-pen-to-square"></i>
              Edit</a>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <form method="POST" action="/listings/{{$listing->id}}">
              @csrf
              @method('DELETE')
              <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        @else
        <tr class="border-gray-300">
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <p class="text-center">No Listings Found</p>
          </td>
        </tr>
        @endunless

      </tbody> --}}

      <x-card class="mx-auto mt-5 mr-5 items-center rounded-5 p-20 h-1010 shadow-lg " style="width: 1760px; display:inline-block; margin-left: 50px">  
        @unless($listings->isEmpty())
        @foreach($listings as $listing)
  
          @php
          $images = json_decode($listing->images);
          $imagePath = !empty($images) ? asset('storage/' . $images[0]) : asset('/images/logo-crop.png');
          @endphp
  
  
          <table class="m-12 p-4" style="margin-left: 50px; padding:15px; width: 95%; align-items: center;">
            <tbody>
              <tr>
                <td rowspan="3"><img style="max-height: 20vh; padding-right:10px" class="w-30" src="{{ $imagePath }}"
                  alt="Product Image"></td>
                <td style="width: 70%; font-size: 20px; font-weight: 700;">Product Name: {{$listing->product_name}} </td>
                <td rowspan="3" >
                  <form method="GET" action="/listings/{{$listing->id}}/edit">
                    <button class="bg-blue-500 text-white rounded w-30 h-10 py-2 px-4 hover:bg-black font-bold"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                </form>
                </td>
                <td rowspan="3" >
                  <form method="POST" action="/listings/{{$listing->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white rounded w-30 h-10 py-2 px-4 hover:bg-black font-bold"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
                </td>
              </tr>
            </tbody>
            <div class="border border-solid"></div>
          </table>
  
          @endforeach
  
          <div class="total-price" style="margin-left: 90%">
          </div>
          @else
  
            <div class="to-pay">
              <img src="images/pay-per-click.gif" id="pay-img"> 
              <p>No Orders Yet</p>
            </div>
  
        @endunless
  
  
      </x-card>
  
    </table>
  </x-card>
</x-layout>
