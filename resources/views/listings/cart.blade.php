<x-layout>
    <x-card class="p-10 max-w-7xl mx-auto mt-5">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
            Shopping Cart
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <thead>
            <tr>
                <th class="px-4 py-2 text-left">Product Name</th>
                <th class="px-4 py-2 text-left">Variant</th>
                <th class="px-4 py-2 text-left">Price</th>
                <th class="px-4 py-2 text-left">Quantity</th>
                <th class="px-4 py-2 text-left">Subtotal</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            @php
            $total = 0; // Initialize the total variable
            @endphp
            @unless($cartItems->isEmpty())
            @foreach($cartItems as $item)
            @php
            // Calculate the subtotal for the current item
            $subtotal = $item->price * $item->quantity;
            // Add the subtotal to the total
            $total += $subtotal;
            @endphp
            <tr class="border-gray-300">
                <td class="px-4 py-5"> <img src="{{$item->logo ? asset('storage/' . $item->logo) : asset('/images/logo-crop.png')}}" alt="" class="w-12"> {{ $item->product_name }}</td>
                <td class="px-4 py-5">{{ $item->variant }}</td>
                <td class="px-4 py-5">{{ $item->price }}</td>
                <td class="px-4 py-5">{{ $item->quantity }}</td>
                <td class="px-4 py-5">{{ $subtotal }}</td>
                <td class="px-4 py-5">
                    <form method="POST" action="/cart/remove/{{$item->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg" colspan="5">
                <p class="text-center">Your shopping cart is empty.</p>
                </td>
            </tr>
            @endunless
            </tbody>
        </table>
        
        @if(!$cartItems->isEmpty())
        <div class="text-right mt-4">
            <p class="text-xl font-bold">Total: ${{ $total }}</p>
            <a href="/checkout" class="bg-green-600 text-white rounded py-2 px-4 mt-2 hover:bg-black inline-block">Proceed to Checkout</a>
        </div>
        @endif

    </x-card>
</x-layout>
