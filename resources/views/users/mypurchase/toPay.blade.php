<x-profile-nav/>
@include('partials._myPurchase');
@include('partials._tailwind');

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>toPay</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Alex+Brush&family=Poppins:wght@300;400;700&display=swap");

    * {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      outline: none;
    }

    :root {
      --body-colour: #e4e9f7;
      --sidebar-colour: #fff;
      --primary-colour: #695cfe;
      --primary-colour-light: #f6f5ff;
      --toggle-colour: #ddd;
      --text-colour: #707070;

      --tran-02: all 0.2s ease;
      --tran-03: all 0.3s ease;
      --tran-04: all 0.4s ease;
      --tran-05: all 0.4s ease;
    }

    body {
      height: 100vh;
      background-color: var(--body-colour);
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 250px;
      padding: 10px 14px;
      background: var(--sidebar-colour);
      transition: var(--tran-05);
      z-index: 100;
    }

    .sidebar.close {
      width: 70px;
    }

    .sidebar .text {
      font-size: 16px;
      font-weight: 500;
      color: var(--text-colour);
      transition: var(--tran-03);
      white-space: nowrap;
      opacity: 1;
    }

    .sidebar.close .text {
      opacity: 0;
    }

    .sidebar .image {
      min-width: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar li {
      height: 50px;
      margin-top: 10px;
      list-style: none;
      display: flex;
      align-items: center;
    }

    .sidebar li .icon {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 60px;
      font-size: 20px;
    }

    .sidebar li .icon,
    .sidebar li .text {
      color: var(--text-colour);
      transition: var(--tran-02);
    }

    .sidebar header {
      position: relative;
    }

    .sidebar .image-text img {
      width: 40px;
    }

    .sidebar header .image-text {
      display: flex;
      align-items: center;
    }

    header .image-text .header-text {
      display: flex;
      flex-direction: column;
    }

    .header-text .name {
      font-weight: 600;
    }

    .sidebar header .toggle {
      position: absolute;
      top: 50%;
      right: -25px;
      transform: translateY(-50%) rotate(180deg);
      height: 25px;
      width: 25px;
      background: var(--primary-colour);
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      color: var(--sidebar-colour);
      font-size: 22px;
      transition: var(--tran-03);
    }

    .sidebar.close header .toggle {
      transform: translateY(-50%);
    }

    .sidebar .menu {
      margin-top: 35px;
    }
    .sidebar li a {
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      text-decoration: none;
      border-radius: 6px;
      transition: var(--tran-04);
    }

    .sidebar li a:hover {
      background: var(--primary-colour);
    }

    .sidebar li a:hover .icon,
    .sidebar li a:hover .text {
      color: var(--sidebar-colour);
    }

    .sidebar .menu-bar {
      height: calc(100% - 50px);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    input:focus {
      outline: none;
    }

    form#search input[type="search"] {
      -webkit-border-radius: 60px 0 0 60px;
      -moz-border-radius: 60px 0 0 60px;
      border-radius: 60px 0 0 60px;
      border: 1px solid #ccc;
      height: 3em;
      padding-left: 20px;
      position: absolute;
      right: 6em;
      top: 1em;
      width: 250px;
      font-weight: bold;
    }

    #create {
      width: 60%;
      margin: 120px auto;
    }

    fieldset {
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      margin-bottom: 20px;
      border: 2px solid;
    }

    legend {
      text-align: right;
      font-weight: bold;
      font-size: 2em;
    }

    /* center legend in IE */
    fieldset > legend {
      display: table;
      float: none;
      margin: 0 auto;
    }

    #create #basics input {
      width: 60%;
      display: block;
      padding: 5px 0 5px 10px;
      margin-bottom: 10px;
    }

    #name {
      font-size: 1em;
    }

    #basics label,
    #options .grplabel {
      width: 100px;
      text-align: right;
      float: left;
      clear: left;
      margin: 0 15px 20px 0;
      font-weight: bolder;
      font-size: 1.2em;
    }

    .grplabel.date-ps {
      position: absolute;
      right: 150px;
      float: bottom;
      margin-top: 25px;
    }

    #options div {
      width: 250px;
      float: left;
    }

    #options div label {
      display: block;
      margin-bottom: 5px;
    }

    #create input[type="submit"] {
      padding: 5px 20px;
      height: 3em;
      text-align: center;
      background-color: #5cb4f2;
      cursor: pointer;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      float: right;
      border-style: none;
      margin-top: -0.5em;
      font-weight: bold;
      font-size: 1.1em;
    }

    .container {
      max-width: 1760px;
      margin-left: 100px;
      text-align: center;
      padding: 20px;

      background-color: #fff;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    }
    h1 {
      text-align: center;
    }
    .status-icon {
      font-size: 24px;
      color: #e1e8e1;
      margin-right: 10px;
    }
    .status-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .status-item {
      display: flex;
      align-items: center;
      background-color: #7bb4e3;
      padding: 10px 20px;
      border-radius: 5px;
      margin-bottom: 10px;
      width: calc(20% - 10px);
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .status-item:hover {
      background-color: #c5c7c5;
    }
    .status-icon {
      font-size: 24px;
      color: #e1e8e1;
      margin-right: 10px;
    }
    .status-text {
      font-size: 18px;
      color: #333;
    }

    #pay-img {
      max-width: 500px;
      max-height: 200px;
      margin: 0 auto;
      display: block;
      background-color: transparent;
    }
    p {
      text-align: center;
      vertical-align: middle;
      font-size: 20px;
      color: #666;
      margin-top: 10px;
    }
  </style>
  <body>

    <x-card class="mx-auto mt-5 mr-5 items-center rounded-5 p-20 h-1010 shadow-lg " style="width: 1760px; display:inline-block; margin-left: 85px">  
      @unless($orders->isEmpty())
        @foreach($orders as $order)

        @php
        $images = json_decode($order->images);
        $imagePath = !empty($images) ? asset('storage/' . $images[0]) : asset('/images/logo-crop.png');
        @endphp


        <table class="m-12 p-4" style="margin-left: 50px; padding:15px; width: 95%; align-items: center;">
          <tbody>
            <tr>
              <td rowspan="3"><img style="max-height: 30vh;" class="w-30" src="{{ $imagePath }}"
                alt="Product Image"></td>
              <td style="width: 70%; font-size: 25px; font-weight: 700;">Product Name: {{$order->product_name}} </td>
              <td rowspan="3" style="font-size: 20px; font-weight: 700;">Price: {{$order->price * $order->quantity}}</td>
            </tr>
            <tr>
              <td style="width: 70% font-size: 20px; font-weight: 700;">Product Variant: {{$order->variant}}</td>
            </tr>
            <tr>
              <td style="width: 70% font-size: 20px; font-weight: 700;">Quantity: {{$order->quantity}}</td>
            </tr>
          </tbody>
          <div class="border border-solid"></div>
        </table>

        @endforeach

        <div class="total-price" style="margin-left: 90%">
          <h2>Total Price: RM{{ $totalPrice }}</h2>
        </div>

      {{-- <form action="toyyibpay" method="GET">

        @csrf --}}
        <button style="background: green; color: white; padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.5rem; padding-right: 0.5rem; border-radius: 0.25rem; margin-top: 0.5rem; margin-left: 1600px">Pay Now</button>
      {{-- </form> --}}
        @else

          <div class="to-pay">
            <img src="images/pay-per-click.gif" id="pay-img"> 
            <p>No Orders Yet</p>
          </div>

      @endunless


    </x-card>

    <script>
      const body = document.querySelector("body"),
        sidebar = body.querySelector(".sidebar"),
        toggle = body.querySelector(".toggle");

      toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
      });
    </script>
    
  </body>
</html>
