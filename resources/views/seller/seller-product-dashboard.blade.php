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
    <title>Product Dashboard</title>
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

    .add-section {
      position: relative;
      background-color: #d1eaf0;
      width: 100%;
      padding: 1rem;
      margin-bottom: 2rem;
    }

    .add-section span {
      display: block;
      font-size: 16px; /* Match the font size of the adjacent span */
      font-family: "Poppins", sans-serif; /* Match the font family */
    }

    .add-section input[type="text"] {
      border: none; /* Remove the border */
      border-bottom: 1px solid #000; /* Add a bottom line */
      background: transparent;
      padding: 5px;
      width: 10rem;
      height: 40px;
      font-size: 16px; /* Match the font size of the adjacent span */
      font-family: "Poppins", sans-serif; /* Match the font family */
    }

    .wrapper {
      width: 200px;
      margin-top: 2rem;
      background-color: transparent;
    }

    .select-btn,
    .options li {
      display: flex;
      cursor: pointer;
      align-items: center;
    }

    .select-btn {
      height: 2.3rem;
      font-size: 22px;
      padding: 0 15px;
      border-radius: 8px;
      background: #ffffff;
      justify-content: space-between;
    }

    .select-btn i {
      font-size: 1rem; /* You can adjust the size as needed */
      transition: transform 0.3s linear;
    }

    .wrapper.active .select-btn i {
      transform: rotate(-180deg);
    }

    .content {
      display: none;
      padding: 1.5rem;
      margin-top: 0.5rem;
      border-radius: 8px;
      background: #ffffff;
    }

    .wrapper.active .content {
      display: block;
    }

    .content .options {
      margin-top: 0.3rem;
      max-height: 250px;
      overflow-y: auto;
      padding-right: 7px;
    }

    .options::-webkit-scrollbar {
      width: 7px;
    }

    .options::-webkit-scrollbar-track {
      background: #d1eaf0;
      border-radius: 25px;
    }

    .options::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 25px;
    }

    .options li {
      height: 40px;
      padding: 0 13px;
      font-size: 15px;
      border-radius: 7px;
    }

    .options li:hover,
    li.selected {
      background-color: #aca8a8;
    }

    .pStock {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .pStock .stock {
      display: flex;
    }

    .stock span {
      padding: 0.9rem 2rem;
    }

    .stock input[type="number"] {
      border: none;
      border-bottom: 1px solid #000;
      background: transparent;
      padding: 5px;
      margin-right: 10px;
      width: 10rem;
      height: 40px;
      font-size: 16px;
      font-family: "Poppins", sans-serif;
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
          <h2>{{$seller->sellerName}}'s Product Dashboard</h2>
        </div>
      </div>

      <div class="status-section">
        <ul class="status-list">
          <li><span></span>All</li>
          <li><span></span>Sold Out</li>

          <li><span></span>Delisted</li>
        </ul>

        <table>
          <tr>
            <th>Product Name</th>
            <th>Variations</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
          </tr>

          @if($listings->isEmpty())
            <tr>
                <td colspan="6">N/A</td>
            </tr>
          @else
              @foreach($listings as $listing)
                  <tr>
                      <td>{{$listing->product_name}}</td>
                      <td>{{$listing->description}}</td>
                      <td>RM {{$listing->price}}</td>
                      <td>{{$listing->stock}}</td>
                      <td>
                        <form action="/listings/{{$listing->id}}/edit">
                          <button class="edit">Edit</button>
                        </form>
                        <br>
                        <form method="POST" action="/listings/{{$listing->id}}">
                          @csrf
                            @method('DELETE')
                            <button class="delete">Delete</button>
                        </form>
                      </td>
                  </tr>
              @endforeach
          @endif
          
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
    <script>
      const wrapper = document.querySelector(".wrapper"),
        selectBtn = wrapper.querySelector(".select-btn"),
        options = wrapper.querySelector(".options");

      // array the categories list that available
      let categories = [
        "Food",
        "Fashion",
        "Gadget",
        "Automotive",
        "Food",
        "Fashion",
        "Gadget",
        "Automotive",
      ];

      function addCategories(selectedCategory) {
        categories.forEach((categories) => {
          // if selected country  and country value is same
          let isSelected = categories == selectedCategory ? "selected" : "";
          // adding each country inside li and inserting all li inside options tag
          let li = `<li onclick = "updateType(this)" class="$(isSelected )">${categories}</li>`;
          options.insertAdjacentHTML("beforeend", li);
        });
      }

      addCategories();

      function updateType(selectedLi) {
        addCategories(selectedLi.innerText);
        wrapper.classList.remove("active");
        selectBtn.firstElementChild.innerText = selectedLi.innerText;
      }

      selectBtn.addEventListener("click", () => {
        wrapper.classList.toggle("active");
      });
    </script>
  </body>
</html>
