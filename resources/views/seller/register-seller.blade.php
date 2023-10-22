<x-layout>
    <x-card class="p-10 max-w-4xl mx-auto mt-24">
      <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Register as Seller</h2>
        <p class="mb-4">Sell your item to the whole GMI's Community</p>
      </header>
  
      <form method="POST" action="/seller" enctype="multipart/form-data">
        @csrf


        <div class="mb-6">
          <label for="SellerName" class="inline-block text-lg mb-2">Seller Name</label>
          <input type="text" class="border border-gray-200 rounded p-2 w-full" name="SellerName" placeholder="Example: John Doe"
            value="{{old('SellerName')}}" />
  
          @error('seller')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
        </div> 
  
        <div class="mb-6">
            <label for="PhoneNumber" class="inline-block text-lg mb-2">Phone Number</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="PhoneNumber" placeholder="Example: 01233456789"
              value="{{old('PhoneNumber')}}" />
    
            @error('seller')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div> 

          <div class="mb-6">
            <label for="BankName" class="inline-block text-lg mb-2">Bank Name</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="BankName" placeholder="Example: Maybank"
              value="{{old('BankName')}}" />
    
            @error('seller')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div> 

          <div class="mb-6">
            <label for="BankAccountNumber" class="inline-block text-lg mb-2">Bank Account Number</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="BankAccountNumber" placeholder="Example: 0123456789"
              value="{{old('BankAccountNumber')}}" />
    
            @error('seller')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div> 
  
        <div class="mb-6">
          <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            Register
          </button>
  
          <a href="/" class="text-black ml-4"> Back </a>
        </div>
      </form>
    </x-card>
  </x-layout>
  