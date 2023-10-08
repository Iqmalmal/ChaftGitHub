<x-layout>

  <head>
    <!-- Include Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  </head>

  <style>
    .owl-carousel .owl-stage {
        margin: 0; /* Remove any margin */
        padding: 0; /* Remove any padding */
    }

    .owl-carousel .owl-stage-outer {
        position: relative;
        width: 800px;
        margin-bottom: 80%;
        z-index: -1;
    }

    .product-details{
        width: 100%;
        padding: 60px ;
        display: flex;
        justify-content: space-between;
    }

    .image-slider{
        position: relative;
        background-image: url('../img/product\ image\ 1.png');
        background-size: cover;
    }

    .product-images{
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        background: #fff;
        border-radius: 5px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        height: 100px;
        grid-gap: 10px;
        padding: 10px;
    }

    .product-images img.active{
        opacity: 0.5;
    }

    .details{
        width: 50%;
    }

    .details .product-brand{
        text-transform: capitalize;
        font-size: 30px;
    }

    .details .product-short-des{
        font-size: 25px;
        line-height: 30px;
        height: auto;
        margin: 15px 0 30px;
    }

    .product-price{
        font-weight: 700;
        font-size: 30px;
    }

    .product-actual-price{
        font-size: 30px;
        opacity: 0.5;
        text-decoration: line-through;
        margin: 0 20px;
        font-weight: 300;
    }

    .product-discount{
        color: #ff7d7d;
        font-size: 20px;
    }

    .product-sub-heading{
        font-size: 30px;
        text-transform: uppercase;
        margin: 60px 0 10px;
        font-weight: 300;
    }

    .size-radio-btn{
        display: inline-block;
        width: 80px;
        height: 80px;
        text-align: center;
        font-size: 20px;
        border: 1px solid #383838;
        border-radius: 50%;
        margin: 10px;
        margin-left: 0;
        line-height: 80px;
        text-transform: uppercase;
        color: #383838;
        cursor: pointer;
    }

    .size-radio-btn.check{
        background: #383838;
        color: #fff;
    }

    .detail-des{
        margin-top: -400px;
        padding: 0 10vw;
        text-transform: capitalize;
        font-size: 20px;
    }

    .heading{
        font-size: 30px;
        margin-bottom: 30px;
    }

    .des{
        color: #383838;
        line-height: 25px;
    }
  </style>

  <section class="product-details">
    <div class="owl-container">
      <div class="owl-carousel owl-theme">
        @foreach (json_decode($listing->images) as $image)
        <div class="item">
          <img style="max-height: 50vh; max-width: 50vh;" class="w-auto ml-60" src="{{ asset('storage/' . $image) }}" alt="Product Image">
        </div>
        @endforeach
      </div>
    </div>

    <x-card style="max-width: 75%; max-height: 800px; float: left; margin">
      <div class="details">
        <h2 class="product-brand"><b>{{$listing->product_name}}</b></h2>
        <p class="product-short-des">{{$listing->seller}}</p>
        <span class="product-price">RM{{$listing->price}}</span>
        {{-- <span class="product-actual-price">$200</span>
        <span class="product-discount">( 50% off )</span> --}}
        <br>
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

        
        <div class="flex gap-3 mb-7">

          

            <input type="hidden" name="listing-id" value="{{ $listing->id }}">
            <input type="hidden" name="listing-name" value="{{ $listing->product_name }}">
            <input type="hidden" name="listing-price" value="{{ $listing->price }}">
            <input type="hidden" name="selected-variants[]" id="selected-variants" value="" multiple>

            <button type="submit" class="bg-green-600 text-white rounded w-48 h-15 py-2 px-4 hover:bg-black">Add to cart</button>
          </form>

        <button class="btn">add to wishlist</button>
      </div>
    </x-card>
  </section>

  <section class="detail-des">
    <h2 class="heading">description</h2>
    <p class="des">{!! nl2br(e($listing->description)) !!}</p>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".owl-carousel").owlCarousel({
        items: 1, // Number of items to display
        loop: true, // Enable looping
        autoplay: false, // Enable autoplay
        autoplayTimeout: 3000, // Autoplay interval in milliseconds
        autoplayHoverPause: true, // Pause on hover
        dots: false, // Disable dots
        margin: 30, // Spacing between items (in px)
      });
    });
  </script>
</x-layout>