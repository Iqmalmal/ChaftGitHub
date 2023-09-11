<x-layout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
  <div class="flex mx-4 items-center justify-center ">
    <div class="w-1/2 p-4">
      <img style="max-height: 60vh;" class="w-auto ml-60" src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" />
      <!-- The inline style enforces a maximum height of 60vh -->
    </div>
    <div class="w-1/2 p-4 mr-60"> <!-- Add the ml-8 class here -->
      <x-card class="p-10">
        <div class="inline-block text-black mb-4">
          <h3 class="text-2xl mb-2">
            <p><b>RM{{$listing->price}}</b> : {{$listing->product_name}}</p>
          </h3>
          <div class="text-xl font-bold mb-4">{{$listing->company}}</div>

          <x-listing-tags :tagsCsv="$listing->tags" />

          <div class="text-lg my-4">
            <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
          </div>

          <!-- product variants -->
          <div class="mb-5">
              <h5 class="text-2xl font-bold mb-5">Product Variants</h5>
              <div class="text-lg space-y-6">
              @if ($productVariantData->isNotEmpty())

              @if(!empty($productVariantData->first()->colour_1))
                <!-- product variant 1 -->
                <div class="flex gap-3">
                  <p><b>Variant</b></p>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->colour_1 }} </button>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->colour_2 }} </button>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->colour_3 }} </button>
                </div>
              @endif

              @if(!empty($productVariantData->first()->size_1))
                <!-- product variant 2 -->
                <div class="flex gap-3">
                  <p><b>Size</b></p>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->size_1 }} </button>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->size_2 }} </button>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->size_3 }} </button>
                </div>
              @endif

              @if(!empty($productVariantData->first()->capacity_1))
                <!-- product variant 3 -->
                <div class="flex gap-3">
                  <p><b>Capacity</b></p>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->capacity_1 }} </button>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->capacity_2 }} </button>
                  <button type="submit" class="bg-gray-200 text-black rounded py-2 px-4"> {{ $productVariantData->first()->capacity_3 }} </button>
                </div>
              @endif

              @else
                <p>No product variants available for this listing.</p>
              @endif
              </div>
          </div>

          <div class="border border-gray-200 w-full mb-5"></div>
          <div class=" flex gap-3 mb-7">
            <button type="submit" class="bg-green-600 text-white rounded py-2 px-4 hover:bg-black"> Add to cart </button>
            <a href="mailto:{{$listing->email}}?subject=Chaft%3A%20{{$listing->product_name}}&body=Hi%2C%20is%20this%20still%20available%3F">
              <button type="submit" class="bg-blue-600 text-white rounded py-2 px-4 hover:bg-black"> Contact Seller </button>
            </a>
          </div>
          <div class="border border-gray-200 w-full mb-6"></div>
          <div>
            <h3 class="text-3xl font-bold mb-4">Job Description</h3>
            <div class="text-lg space-y-6">
              {{$listing->description}}
            </div>
          </div>
        </div>
      </x-card>
    </div>
  </div>
</x-layout>
