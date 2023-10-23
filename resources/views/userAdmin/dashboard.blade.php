@php
    use App\Models\User;
    use App\Http\Controllers\UserController;
@endphp

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
    <title>Document</title>
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
      width: 240px;
      transition: 0.5s;
    }
    .logo {
      height: 80px;
      padding: 16px;
      display: flex;
      justify-content: center;
      align-items: center;
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
      background: #ebe9e9;
      width: 100%;
      padding: 1rem;
    }
    /* .header--wrapper img {
      width: 50px;
      height: 50px;
      cursor: pointer;
      border-radius: 50%;
    } */
    .header--wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      background: #fff;
      border-radius: 10px;
      padding: 10px 2rem;
      margin-bottom: 1rem;
    }
    .header--title {
      color: rgba(18, 170, 162, 0.582);
    }
    .user--info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: rgba(37, 223, 213, 0.582);
      color: white;
    }
  </style>
  <body>
    <div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li class="active">
          <a href="#">
            <i class="fas fa-tachometer-alt"></i>
            <span>Data</span>
          </a>
        </li>

        <li class="active">
          <a href="#">
            <i class="fa fa-chart-pie"></i>
            <span>Chat</span>
          </a>
        </li>

        <li class="logout">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                <!-- Add any additional form fields if needed -->
                @csrf <!-- Include CSRF token for Laravel -->
              </form>
        </li>
      </ul>
    </div>

    <div class="main--content">
      <div class="header--wrapper">
        <div class="header--title">
          <span>Admin</span>
          <h2>Dashboard</h2>
        </div>

        <!-- <img src="amal.jpeg" alt="" /> -->
      </div>
      <h2>Chaft Seller List</h2>

      <table>
        <tr>
          <th>ID</th>
          <th>Seller Name</th>
          <th>Email</th>
          <th>View Seller Page</th>
          <th>-</th>
        </tr>
        @foreach ($seller as $sellers)
        <tr>
          <td>{{$sellers->id}}</td>
          <td>{{$sellers->sellerName}}</td>
          {{-- <td>{{$user->email}}</td> --}}
          <td>{{-- <a href="/sellers/{{$sellerListings->id ?? ''}}"><p class="product-short-des">View --}} Seller Page{{-- </p></a> --}}</td>
          <td>123 Main St, City, State, 12345</td>
        </tr>
        @endforeach
        <!-- Add more rows for each user -->
      </table>
    </div>
  </body>
</html>
