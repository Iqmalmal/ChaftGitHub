<x-layout>
  <x-card class="p-10 max-w-4xl mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Edit Listing</h2>
      <p class="mb-4">Edit: {{$listing->product_name}}</p>
    </header>

    <form method="POST" action="/listings/{{$listing->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-6">
        <label for="product_name" class="inline-block text-lg mb-2">Product name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="product_name"
          placeholder="Example: Hotwheel, Cover set, Gundam" value="{{$listing->product_name}}" />

        @error('product_name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="location" class="inline-block text-lg mb-2">Seller Location</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
          placeholder="Example: Block A2, Block A3, A2-5-1" value="{{$listing->location}}" />

        @error('location')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="price" class="inline-block text-lg mb-2">
          Price
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="price" placeholder="120"
          value="{{$listing->price}}" />

        @error('price')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div>
        <x-card>
            <div id="variantContainer">
                <!-- Initial variant row -->
                <h1 class="text-lg">Product Variant &lpar;Optional &rpar;</h1> 
                <h2>Max 10</h2><br>
                <div class="variant-row flex">
                  
                </div>
            </div>
            <button id="addVariantBtn" class="bg-green-600 text-white rounded py-2 px-4 hover:bg-black">Add Variant</button>
        </x-card>
    </div>
    

      <div class="mb-6">
        <label for="stock" class="inline-block text-lg mb-2">
          Stock
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="stock" placeholder="10"
          value="{{$listing->stock}}" />

        @error('stock')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>
      
      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
          Tags (Comma Separated)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
          placeholder="Example: Toys, Hobby, Clothes" value="{{$listing->tags}}" />

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
          placeholder="Include product decription">{{$listing->description}}</textarea>

        @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Update Listing
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>

<script>
  document.addEventListener('DOMContentLoaded', function () {
  const variantContainer = document.getElementById('variantContainer');
  let colorsArray = {!! json_encode(explode(',', str_replace(['[', ']', '"'], '', $productVariantData->first()->colour_1)) ) !!};
  let sizesArray = {!! json_encode(explode(',', str_replace(['[', ']', '"'], '', $productVariantData->first()->size_1)) ) !!};
  let capacitiesArray = {!! json_encode(explode(',', str_replace(['[', ']', '"'], '', $productVariantData->first()->capacity_1)) ) !!};
  let variantCount = 0;

  function createVariantRow(color, size, capacity) {
    event.preventDefault();
    if (variantContainer.children.length < 10) {
      const newVariantRow = document.createElement('div');
      newVariantRow.classList.add('variant-row', 'flex');
      variantCount++;
      

      newVariantRow.innerHTML = `
        <div class="mb-6">
          <label for="colour_${variantCount}" class="inline-block text-lg mb-2">
            Variant ${variantCount}
          </label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="colour_${variantCount}" placeholder="${color || ''}" value="${color || ''}" />
        </div>

        <div class="mb-6">
          <label for="size_${variantCount}" class="inline-block text-lg mb-2">
            Size ${variantCount}
          </label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="size_${variantCount}" placeholder="${size || ''}" value="${size || ''}" />
        </div>

        <div class="mb-6">
          <label for="capacity_${variantCount}" class="inline-block text-lg mb-2">
            Capacity ${variantCount}
          </label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="capacity_${variantCount}" placeholder="${capacity || ''}" value="${capacity || ''}" />
        </div>
      `;

      variantContainer.appendChild(newVariantRow);
    }
  }

  // Populate initial variant rows
  for (let i = 0; i < Math.min(10, Math.max(colorsArray.length, sizesArray.length, capacitiesArray.length)); i++) {
    createVariantRow(colorsArray[i], sizesArray[i], capacitiesArray[i]);
  }

  // Add variant button click event
  document.getElementById('addVariantBtn').addEventListener('click', function () {
    createVariantRow('', '', ''); // Add a new variant row without values
    
  });
});
</script>