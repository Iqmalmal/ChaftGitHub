@php
  use App\Models\User;
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="images/logo.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
        theme: {
          extend: {
            colors: {
              laravel: '#8EDAD8',
              laravelHover: '#2D8A88',
              register: '#D1EAF0'
            },
          },
        },
      }
  </script>
  <title>Chaft E-commerce | Buy and Sell Item</title>
</head>

<style>
  /* Footer styles */
footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    font-weight: bold;
    background-color: #8EDAD8; /* Replace with your desired background color */
    color: #ffffff; /* Replace with your desired text color */
    height: 5rem; /* You can adjust the height as needed */
    margin-top: 6rem; /* You can adjust the margin as needed */
    opacity: 0.6;
}

/* Copyright text styles */
footer p {
    margin-left: 0.5rem; /* Adjust as needed */
    font-size: 20px; /* Adjust as needed */
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

footer a {
    margin-left: 28%; /* Adjust as needed */
    font-size: 20px; /* Adjust as needed */
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

/* Sell button styles */
 #sellBtn {
    position: absolute;
    top: 33%; /* Adjust as needed */
    right: 1.25rem; /* Adjust as needed */
    background-color: #000; /* Replace with your desired background color */
    color: #fff; /* Replace with your desired text color */
    padding: 0.5rem 1rem; /* Adjust padding as needed */
}

@media screen and (max-width: 486px) {
  body{
    overflow-x: hidden;
  }

  footer {
    max-width:0vmax;
  }
  
  .text{
    display: none;
  }
}
  

</style>

<body class="mb-48">
  <nav class="flex justify-between items-center mb-4">
    <a href="/"><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo" /></a>
    <ul class="flex space-x-6 mr-6 text-lg">
      @auth
      <li>
        <span class="font-bold uppercase">
          <a href="/profile" class="hover:text-laravel">Welcome {{auth()->user()->name}}</a>
          
        </span>
      </li>
      <li>
        <a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> <span class="text">Manage Listings</span></a>
      </li>
      <li>
        <a href="/cart" class="hover:text-laravel"><i class="fa-solid fa-shopping-cart"></i> <span class="text">Cart</span></a>
      </li>
      <li>
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit" class="hover:text-laravel">
            <i class="fa-solid fa-door-closed "></i> <span class="text"> Logout</span>
          </button>
        </form>
      </li>
      <li>
		    <a href="/profile" class="hover:text-laravel"><img src="{{auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('/images/user.png')}}" style=" max-height:50px; max-width:50px;"/> </a> 
	    </li>	
      @else
      <li>
        <a href="/register" class="hover:text-laravelHover"><i class="fa-solid fa-user-plus"></i> <span class="text">Register/Login</span></a>
      </li>
      @endauth
    </ul>
  </nav>

  <main>
    {{$slot}}
  </main>

  @if(\App\Models\Seller::where('user_id', auth()->id())->exists())
    
  @else
  <footer>
    <p>Copyright &copy; 2022, All Rights reserved</p>
    <a href="/about"> About Us</a>

    <a href="/sellerRegister" id="sellBtn">Sell</a>
  </footer>
  @endif
  

  <x-flash-message />
</body>

</html>