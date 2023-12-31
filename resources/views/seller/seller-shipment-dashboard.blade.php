@include('partials._tailwind')

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Shipement Dashboard</title>
  </head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Alex+Brush&family=Poppins:wght@300;400;700&display=swap");

    * {
      margin: 0;
      padding: 0;
      border: none;
      outline: none;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: flex;
    }

    .sidebar {
      position: sticky;
      top: 0;
      left: 0;
      bottom: 0;
      width: 110px;
      height: 100vh;
      padding: 0 1.7rem;
      color: #fff;
      overflow: hidden;
      transition: all 0.5s ease-out;
      background: rgba(46, 142, 148, 0.33);
    }
    .sidebar:hover {
      width: 255px;
      transition: 0.5s;
    }

    .menu {
      height: 88%;
      position: relative;
      list-style: none;
      padding: 0;
    }
    .menu li {
      padding: 1rem;
      margin: 8px 0;
      border-radius: 10px;
      transition: all 0.5 ease-in-out;
    }
    .menu li:hover,
    .active {
      background: rgba(80, 220, 153, 0.4);
    }
    .menu a {
      color: #fff;
      font-size: 14px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }
    .menu a span {
      overflow: hidden;
    }
    .menu a i {
      font-size: 1.2rem;
    }
    .logout {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
    }
    .main--content {
      position: relative;
      background: #ffffff;
      width: 100%;
      padding: 1rem;
    }

    .header--wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      background: #d1eaf0;
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
    }
    .header--title {
      color: #000000;
    }

    .status-section {
      position: relative;
      background-color: #d1eaf0;
      width: 100%;
      padding: 1rem;
    }

    .status-list {
      list-style: none;
      display: flex; /* Change from 'block' to 'flex' */
      align-items: center;
      justify-content: space-around; /* To distribute items horizontally */
      padding: 0;
    }
    .status-list li {
      position: relative;
      cursor: pointer;
      background: transparent;
    }
    .status-list li span {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px; /* Height and color of the line */
      background-color: #000000; /* Blue color for the line */
      transition: width 0.3s; /* Transition effect for the line width */
    }

    .status-list li.active span {
      width: 100%; /* Make the line cover the full width when the item is active (clicked) */
    }

    .date-section {
      margin-top: 30px;
      display: flex;
      align-items: center;
    }

    .date-section span {
      position: relative;
    }

    table {
      width: 100%;
      margin-top: 20px; /* Adjust the margin as needed */
      border-collapse: collapse;
    }

    th {
      background: #eeeeee;
      padding: 10px;
      text-align: center;
      border: 1px solid #000000;
    }
    td {
      padding: 10px;
      text-align: left;
      border: 1px solid #000000;
    }

    /* Custom button styles */
    button {
      padding: 5px 10px;
      border: none;
      cursor: pointer;
    }

    /* Edit button */
    button.edit {
      background-color: blue;
      color: white;
    }

    /* Delete button */
    button.delete {
      background-color: red;
      color: white;
    }
  </style>

  <body>
    <div class="sidebar">
      <ul class="menu">

        <li class="active">
          <a href="/sellers/dashboard/{seller}/product">
            <i class="fa-solid fa-bag-shopping"></i>
            <span>Products</span>
          </a>
        </li>

        <li class="active">
          <a href="/sellers/dashboard/{seller}/shipment">
            <i class="fa-solid fa-truck-fast"></i>
            <span>Shipment</span>
          </a>
        </li>

        <li class="active">
          <a href="/sellers/dashboard/{seller}/finance">
            <i class="fa-solid fa-wallet"></i>
            <span>Finance</span>
          </a>
        </li>

        <li class="logout">
          <a href="/profile">
            <i class="fas fa-sign-out-alt"></i>
            <span>Back</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="main--content">
      <div class="header--wrapper">
        <div class="header--title">
          <span>Seller</span>
          <h2>{{$seller->sellerName}}'s Shipment Dashboard</h2>
        </div>
      </div>

      <div class="status-section">

        <table>
          <tr>
            <th>Recipient</th>
            <th>Address</th>
            <th>Product</th>
            <th>Order Total</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
          @foreach($orders as $order)
          <tr>
            <td>{{$order->recipient}}</td>
            <td>{{$order->user->block}}-{{$order->user->unit}}</td>
            <td>{{$order->product_name}}</td>
            <td>RM{{$order->totalPrice}}</td>
            <td>{{$order->status}}</td>
            <td>
              <form action="/sellers/dashboard/{seller}/shipment" method="GET">

                @if($order->status == 'Received')
                <h1>Product has been received</h1>

                @elseif($order->status == 'Cancelled')
                <h1>Product has been cancelled</h1>

                @elseif($order->status == 'Shipped')
                <h1>Product has been shipped</h1>
                
                @else
                  <button class="bg-blue-500 text-white rounded w-30 h-10 py-2 px-4 hover:bg-black font-bold">Ship Product</button>
                  <input type="hidden" name="group_id" value="{{$order->group_id}}">
                @endif
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    <script>
      // Get all status list items
      const statusItems = document.querySelectorAll(".status-list li");

      // Add a click event listener to each list item
      statusItems.forEach((item) => {
        item.addEventListener("click", () => {
          // Remove the 'active' class from all items
          statusItems.forEach((item) => item.classList.remove("active"));
          // Add the 'active' class to the clicked item
          item.classList.add("active");
        });
      });
    </script>

  <x-flash-message />

  </body>
</html>
