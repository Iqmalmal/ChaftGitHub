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
          placeholder="Example: Hotwheel, Cover set, Voltbar" value="{{old('product_name')}}" />

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

      <!-- ProductVariant -->
      <div>
        <x-card>

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



          <!-- variant 2 -->
          <div class="flex">
            <div class="mb-6">
              <label for="colour_2" class="inline-block text-lg mb-2">
                Variant 2
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="colour_2" placeholder="Blue"
                value="{{old('colour_2')}}" />

              @error('colour_2')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="size_2" class="inline-block text-lg mb-2">
                Size 2
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="size_2" placeholder="M"
                value="{{old('size_2')}}" />

              @error('size_2')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="capacity_2" class="inline-block text-lg mb-2">
                Capacity 2
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity_2" placeholder="2"
                value="{{old('capacity_2')}}" />

              @error('capacity_2')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="stock_2" class="inline-block text-lg mb-2">
                Stock 2
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="stock_2" placeholder="20"
                value="{{old('stock_2')}}" />

              @error('stock_2')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
          </div>



          <!-- variant 3 -->
          <div class="flex">
            <div class="mb-6">
              <label for="colour_3" class="inline-block text-lg mb-2">
                Variant 3
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="colour_3" placeholder="Green"
                value="{{old('colour_3')}}" />

              @error('colour_3')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="size_3" class="inline-block text-lg mb-2">
                Variant 3
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="size_3" placeholder="L"
                value="{{old('size_3')}}" />

              @error('size_3')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="capacity_3" class="inline-block text-lg mb-2">
                Capacity 3
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity_3" placeholder="3"
                value="{{old('capacity_3')}}" />

              @error('capacity_3')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="stock_3" class="inline-block text-lg mb-2">
                Stock 3
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="stock_3" placeholder="30"
                value="{{old('stock_3')}}" />

              @error('stock_3')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
          </div>
        </x-card>
      </div>
      <!-- end product variant -->

      
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
