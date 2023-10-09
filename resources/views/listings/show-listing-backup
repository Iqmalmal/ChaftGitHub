<x-layout>
  <head>
    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  </head>

  <style>
    /* Add this CSS to your stylesheet */
    .owl-carousel .owl-stage {
        margin: 0; /* Remove any margin */
        padding: 0; /* Remove any padding */
    }

    .owl-carousel .owl-stage-outer {
        position: relative;
        top: 0%;
        margin-bottom: 80%;
        z-index: 0;
    }

    .owl-container {
    position: relative;
    top: 40px;
    left: 0;
    z-index: 1; /* Ensure it's above other elements */
    }
  </style>

  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
  <div class="flex mx-4 items-center justify-center">
    <div class="w-1/2 p-4">
      <div class="owl-container">
        <div class="owl-carousel owl-theme">
          @foreach (json_decode($listing->images) as $image)
          <div class="item">
            <img style="max-height: 50vh; max-width: 50vh;" class="w-auto ml-60" src="{{ asset('storage/' . $image) }}" alt="Product Image">
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="w-1/2 p-4 mr-60">
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

          <form action="/addCart">
            @csrf
          <div class="mb-5">
            <h5 class="text-2xl font-bold mb-5">Product Variants</h5>
            <div class=" inline-block text-lg space-y-6"></div>
              @if ($productVariantData->isNotEmpty())
              <span>Colour:</span>
              <div>
                <select name="variant-select" id="variant-colour">
                  @foreach ($productVariantData as $variant)
                    <option value="-">-</option>
                    @foreach([$productVariantData->first()->colour_1, $productVariantData->first()->colour_2, $productVariantData->first()->colour_3] as $color)
                    <option value="{{$color}}">{{$color}}</option>
                    @endforeach
                  @endforeach
                </select>
              </div>
              <br>
              <span>Size:</span>
              <div>
                <select name="variant-select" id="variant-size">
                  @foreach ($productVariantData as $variant)
                    <option value="-">-</option>
                    @foreach([$productVariantData->first()->size_1, $productVariantData->first()->size_2, $productVariantData->first()->size_3] as $size)
                    <option value="{{$size}}">{{$size}}</option>
                    @endforeach
                  @endforeach
                </select>
              </div>
              <br>
              <span>Capacity:</span>
              <div>
                
                <select name="variant-select" id="variant-capacity">
                  @foreach ($productVariantData as $variant)
                    <option value="-">-</option>
                    @if (!empty($productVariantData->first()->capacity_1))
                      @foreach([$productVariantData->first()->capacity_1, $productVariantData->first()->capacity_2, $productVariantData->first()->capacity_3] as $capacity)
                      <option value="{{$capacity}}">{{$capacity}}</option>
                      @endforeach
                    @endif
                  @endforeach
                </select>
                
              </div>

              @else
                <span> empty </span>
              @endif
            </div>
          </div>

          <div class="border border-gray-200 w-full mb-5"></div>
          <div class="flex gap-3 mb-7">

            

              <input type="hidden" name="listing-id" value="{{ $listing->id }}">
              <input type="hidden" name="listing-name" value="{{ $listing->product_name }}">
              <input type="hidden" name="listing-price" value="{{ $listing->price }}">
              <input type="hidden" name="selected-variants[]" id="selected-variants" value="" multiple>

              <button type="submit" class="bg-green-600 text-white rounded py-2 px-4 hover:bg-black">Add to cart</button>
            </form>

            @if (Auth::check())
              <a href="mailto:{{$listing->email}}?subject=Chaft%3A%20{{$listing->product_name}}&body=Hi%2C%20is%20this%20still%20available%3F">
                <button type="submit" class="bg-blue-600 text-white rounded py-2 px-4 hover:bg-black"> Contact Seller </button>
              </a>
            @else
              <a href="/register">
                <button type="submit" class="bg-blue-600 text-white rounded py-2 px-4 hover:bg-black"> Contact Seller </button>
              </a>
            @endif
            {{-- <a href="mailto:{{$listing->email}}?subject=Chaft%3A%20{{$listing->product_name}}&body=Hi%2C%20is%20this%20still%20available%3F">
              <button type="submit" class="bg-blue-600 text-white rounded py-2 px-4 hover:bg-black"> Contact Seller </button>
            </a> --}}
          </div>
          <div class="border border-gray-200 w-full mb-6"></div>
          <div>
            <h3 class="text-3xl font-bold mb-4">Job Description</h3>
            <div class="text-lg space-y-6">
            {!! nl2br(e($listing->description)) !!}

            </div>
          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
          $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
              items: 1, // Number of items to display
              loop: true, // Enable looping
              autoplay: true, // Enable autoplay
              autoplayTimeout: 3000, // Autoplay interval in milliseconds
              autoplayHoverPause: true, // Pause on hover
              dots: false, // Disable dots
            });
          });
        </script>

        <script>

          const selectedVariantsInput = document.getElementById('selected-variants');

          $(document).ready(function() {
            $('#variant-colour, #variant-size, #variant-capacity').change(function() {
                var selectedVariants = [];
                selectedVariants.push($('#variant-colour').val());
                selectedVariants.push($('#variant-size').val());
                selectedVariants.push($('#variant-capacity').val());

                console.log(selectedVariants); // This will log the array to the console
                selectedVariantsInput.value = selectedVariants.join(', ');
            });
        });
        </script>
      </x-card>
    </div>
  </div>
</x-layout>