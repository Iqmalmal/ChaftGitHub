@php
    use App\Models\User;
@endphp

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
                $total = 1; // Initialize the total variable
                @endphp
                @unless($cartItems->isEmpty())
                @foreach($cartItems as $item)
                @php
                // Calculate the subtotal for the current item
                $subtotal = $item->price * $item->quantity;
                // Add the subtotal to the total
                $total += $subtotal;
                

                $user = Auth::user(); // Retrieve the authenticated user instance
                $user->totalPrice = $total; // Assign the value of $total to the 'total' field
                $user->save(); // Save the user model to persist the changes


                $images = json_decode($item->images);
                $imagePath = !empty($images) ? asset('storage/' . $images[0]) : asset('/images/logo-crop.png');
                @endphp
                <tr class="border-gray-300">
                    <td class="px-4 py-5">
                        <img style="max-height: 60vh;" class="w-12" src="{{ $imagePath }}"
                            alt="Product Image">
                        {{ $item->product_name }}
                    </td>
                    <td class="px-4 py-5">{{ $item->variant }}</td>
                    <td class="px-4 py-5">{{ $item->price }}</td>
                    <td class="px-4 py-5">{{ $item->quantity }}</td>
                    <td class="px-4 py-5">RM {{ $subtotal }}</td>
                    <td class="px-4 py-5">
                        <form method="POST" action="/cart/remove/{{$item->id}}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Remove</button>
                            <input type="hidden" name="price" value="{{ $item->price }}">
                            <input type="hidden" name="total" value="{{$total}}">
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
            <p class="text-xl font-bold">Total: RM {{ $total }}</p>
            <span style="font-size: 10px; color:red;">*RM1 each transaction fee*</span>
            <form action="/checkout" method="POST">
                @csrf
                <button class="bg-green-600 text-white rounded py-2 px-4 mt-2 hover:bg-black inline-block">Proceed to Checkout</button>
                <input type="hidden" name="totalPrice" value="{{ $total }}">
            </form>
            
        </div>
        @endif

    </x-card>
</x-layout>