<x-layout>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  </head>

  <style>
    body{
      overflow-x: hidden;
    }

    .owl-carousel .owl-stage {
        margin: 0; /* Remove any margin */
        padding: 0; /* Remove any padding */
    }

    .owl-carousel .owl-stage-outer {
        position: relative;
        width: 800px;
        z-index: -1;
    }

    .image-details{
      display: flex;
      margin-right: 300px;
      justify-content: center;
      align-items: center;
    }

    img{
      max-height: 50vh;
      max-width: 50vh;
    }

    .listing-card{
      display: inline-block;
    }

    select {
      width: 150px;
      height: 40px;
      border-radius: 5px;
    }

    .desc{
      text-transform: capitalize;
      margin-top: 50px;
      margin-left: 300px;
    }

    .description-card {
      width: 1000px;
      margin-left: 145px;
      display: inline-block;
    }

    /* Media query for tablets */
    @media screen and (max-width: 768px) {
      .desc{
        margin-left: 30px;
        
      }

      .description-card {
        width: 80%; /* Adjust the width as needed for tablets */
        margin: auto;
      }
    }

    /* Media query for smartphones */
    @media screen and (max-width: 480px) {
      body{
        overflow-x: hidden;
      }

      .image-details {
        flex-direction: column;
        margin: auto;
      }

      img {
        max-height: 60vh;
        max-width: 60vh;
      }

      .product-details {
        flex-direction: column;
      }

      .listing-card {
        width: 100%;
      }

      .description-card {
        width: 118%; /* Adjust the width as needed for smartphones */
        margin-left: 60px;
      }


      /* listing detail under image */
      .detail{
        margin-top: 30px;
        margin-left: 220px;
      }
    }


  </style>

  <div class="product-details">
    <div class="image-details">

      <!-- image -->
      <div class="owl-container">
        <div class="owl-carousel owl-theme">
          @foreach (json_decode($listing->images) as $image)
            <div class="item">
              <img class="w-auto ml-60" src="{{ asset('storage/' . $image) }}" alt="Product Image">
            </div>
          @endforeach
        </div>
      </div>


      <!-- details -->

      <div class="detail">
      <x-card class="listing-card">
        <div class="details">

          <!-- listing details -->
          <h2 class="product-brand text-3xl"><b>{{$listing->product_name}}</b></h2>
          <a href="/sellers/{{$sellerListings->id ?? ''}}"><p class="product-short-des">{{$listing->sellerName}}</p></a>
          <span class="product-price">RM{{$listing->price}}</span>
          <br>


          <!-- Add to cart form -->
          <form action="/addCart">
          @csrf

          <div class="mb-5">
            <h5 class="text-2xl mb-5">Product Variants</h5>
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

          
        @if(Auth::check() && (Auth::user()->seller && Auth::user()->seller->id == $listing->seller_id) || (Auth::check() && Auth::user()->isAdmin()))
    <span><b>Listing Owner cannot purchase own listing</b></span>
@else
          <div class="flex gap-3 mb-7">
            <input type="hidden" name="listing-id" value="{{ $listing->id }}">
            <input type="hidden" name="listing-name" value="{{ $listing->product_name }}">
            <input type="hidden" name="listing-price" value="{{ $listing->price }}">
            <input type="hidden" name="selected-variants[]" id="selected-variants" value="" multiple>

            <button type="submit" class="bg-green-600 text-white rounded w-48 h-15 py-2 px-4 hover:bg-black">Add to cart</button>

            </form>

            <a href="mailto:{{$listing->email}}?subject=Chaft: {{$listing->product_name}}&body=Hello, is this {{$listing->product_name}} still available?">
              <button class="bg-blue-600 text-white rounded w-48 h-15 py-2 px-4 hover:bg-black">Contact Seller</button>
            </a>
          </div>
        @endif
      </x-card>
      </div>



    </div>

    <div class="desc">
      <x-card class="description-card">
        <h2 class="font-bold text-3xl">description</h2>
        <p class="des">{!! nl2br(e($listing->description)) !!}</p>
      </x-card>
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
        margin: 30, // Spacing between items (in px)
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


</x-layout>