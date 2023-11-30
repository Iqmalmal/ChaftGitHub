<x-layout>
  <x-card class="p-10 max-w-4xl mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Sell Item</h2>
      <p class="mb-4">Sell your item to the whole GMI's Community</p>
    </header>

    <form method="POST" action="/listings" enctype="multipart/form-data">
      @csrf
    
      <!-- <div class="mb-6">
        <label for="seller" class="inline-block text-lg mb-2">Seller Name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="seller" placeholder="Example: John Doe"
          value="{{old('seller')}}" />

        @error('seller')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div> -->

      <div class="mb-6">
        <label for="product_name" class="inline-block text-lg mb-2">Product name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="product_name"
          placeholder="Example: Hotwheel, Cover set, Gundam" value="{{old('product_name')}}" />

        @error('product_name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="location" class="inline-block text-lg mb-2">Seller Location</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
          placeholder="Example: Block A2, Block A3, A2-5-1" value="{{old('location')}}" />

        @error('location')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <!-- <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">
          Contact Email
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" placeholder="john.doe@student.gmi.edu.my" value="{{old('email')}}" />

        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div> -->

      <div class="mb-6">
        <label for="price" class="inline-block text-lg mb-2">
          Price
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price" placeholder="120"
          value="{{old('price')}}" />

        @error('price')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div>
        <x-card>
            <div id="variantContainer">
                <!-- Initial variant row -->
                <div class="variant-row flex">
                  <!-- variant 1 -->
                  <div class="flex">
                    <div class="mb-6">
                      <label for="colour_1" class="inline-block text-lg mb-2">
                        Variant 1
                      </label>
                      <input type="text" class="border border-gray-200 rounded p-2 w-full" name="colour_1" placeholder="Red"
                        value="{{old('colour_1')}}" />

                      @error('colour_1')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-6">
                      <label for="size_1" class="inline-block text-lg mb-2">
                        Size 1
                      </label>
                      <input type="text" class="border border-gray-200 rounded p-2 w-full" name="size_1" placeholder="S"
                        value="{{old('size_1')}}" />

                      @error('size_1')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-6">
                      <label for="capacity_1" class="inline-block text-lg mb-2">
                        Capacity 1
                      </label>
                      <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity_1" placeholder="1"
                        value="{{old('capacity_1')}}" />

                      @error('capacity_1')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>

                    <div class="mb-6">
                      <label for="stock_1" class="inline-block text-lg mb-2">
                        Stock 1
                      </label>
                      <input type="text" class="border border-gray-200 rounded p-2 w-full" name="stock_1" placeholder="10"
                        value="{{old('stock_1')}}" />

                      @error('stock_1')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                </div>
            </div>
            <button id="addVariantBtn" class="bg-green-600 text-white rounded py-2 px-4 hover:bg-black">Add Variant</button>
        </x-card>
    </div>
    

      
      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
          Tags (Comma Separated)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
          placeholder="Example: Toys, Hobby, Clothes" value="{{old('tags')}}" />

        @error('tags')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="images" class="inline-block text-lg mb-2">
            Product Images
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="images[]" multiple />

        @error('images')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          item Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
          placeholder="Include product decription">{{old('description')}}</textarea>

        @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Sell
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const addVariantBtn = document.getElementById('addVariantBtn');
      const variantContainer = document.getElementById('variantContainer');
      let variantCount = 1;

      addVariantBtn.addEventListener('click', function () {
        event.preventDefault();
          variantCount++;

          const newVariantRow = document.createElement('div');
          newVariantRow.classList.add('variant-row', 'flex');
          newVariantRow.innerHTML = `
              <!-- Variant ${variantCount} -->

              
              <div class="mb-6">
                  <label for="colour_${variantCount}" class="inline-block text-lg mb-2">
                      Variant ${variantCount}
                  </label>
                  <input type="text" class="border border-gray-200 rounded p-2 w-full"
                      name="colour_${variantCount}" placeholder="Color ${variantCount}"
                      value="{{ old('colour_${variantCount}') }}" />
                  <!-- Error handling for colour_${variantCount} -->
                  @error('colour_${variantCount}')
                      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
              </div>


              
              <div class="mb-6">
              <label for="size_${variantCount}" class="inline-block text-lg mb-2">
                Size ${variantCount}
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="size_${variantCount}" placeholder="Size ${variantCount}"
                value="{{old('size_${variantCount}')}}" />

              @error('size_${variantCount}')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>


            
            <div class="mb-6">
              <label for="capacity_${variantCount}" class="inline-block text-lg mb-2">
                Capacity ${variantCount}
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity_${variantCount}" placeholder="Capacity ${variantCount}"
                value="{{old('capacity_${variantCount}')}}" />

              @error('capacity_${variantCount}')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>



            
            <div class="mb-6">
              <label for="stock_${variantCount}" class="inline-block text-lg mb-2">
                Stock ${variantCount}
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="stock_${variantCount}" placeholder="Stock ${variantCount}"
                value="{{old('stock_${variantCount}')}}" />

              @error('stock_${variantCount}')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
          `;

          variantContainer.appendChild(newVariantRow);
      });
  });
</script>
