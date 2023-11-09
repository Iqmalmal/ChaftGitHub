@include('partials._tailwind')

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>Address</title>
  </head>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Alex+Brush&family=Poppins:wght@300;400;700&display=swap");

    * {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --body-color: #e4e9f7;
      --sidebar-color: #fff;
      --primary-color: #7bb4e3;
      --primary-color-light: #bbd2ec;
      --toggle-color: #ddd;
      --text-color: #707070;

      --trans-02: all 0.2s ease;
      --trans-03: all 0.3s ease;
      --trans-04: all 0.4s ease;
      --trans-05: all 0.5s ease;
    }
    body {
      height: 100vh;
      background: var(--body-color);
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%; /* Make the sidebar full width */
        left: -100%; /* Hide the sidebar off-screen */
        transition: left 0.3s ease-in-out;
      }

      .sidebar.active {
        left: 0; /* Slide in the sidebar */
      }

      .sidebar header .toggle {
        left: 10px; /* Adjust toggle button position */
      }
    }

    .sidebar .text {
      font-size: 16px;
      font-weight: 500;
      color: var(--text-color);
    }

    .sidebar .image {
      min-width: 60px;
      display: flex;
      align-items: center;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 250px;
      padding: 10px 14px;
      background: var(--sidebar-color);
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
      color: var(--text-color);
      transition: var(--trans-02);
    }

    .sidebar header {
      position: relative;
    }

    .sidebar .image-text img {
      width: 40px;
      border-radius: 6px;
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
      left: 225px;
      transform: translateY(-50%);
      height: 25px;
      width: 25px;
      background: var(--primary-color);
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      color: var(--sidebar-color);
      font-size: 22px;
    }

    .sidebar .search-box {
      background: var(--primary-color-light);
    }

    .search-box input {
      height: 100%;
      width: 100%;
      outline: none;
      border: none;
      border-radius: 6px;
      background: var(--primary-color-light);
    }

    .sidebar li a {
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      text-decoration: none;
      border-radius: 6px;
      transition: var(--trans-04);
    }

    .sidebar li a:hover {
      background: var(--primary-color);
    }

    .sidebar li a:hover .icon,
    .sidebar li a:hover .text {
      color: var(--sidebar-color);
    }

    .sidebar .menu-bar {
      height: calc(100% - 50px);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .bottom-content li {
      margin-top: 505px;
      padding: 5px 0;
      border-top: 1px solid #ddd;
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

    label::after {
      content: " *";
      color: red;
    }

    /* FF only */
    @media screen and (-moz-images-in-menus: 0) {
      fieldset {
        position: relative;
      }
      fieldset > legend {
        position: absolute;
        left: 80%;
        top: -20px; /* depends on font size and border */
        transform: translate(-50%, 0);
      }
    }

    .container {
      width: 100%;
      height: auto;
    }
  </style>

  <body>
    <section>
      <form id="create" action="/profile/update" method="POST">
        @csrf
        <fieldset id="basics">
          <legend id="basic">Shipping Address</legend>
          <label for="name">Block</label>
          <input
            type="text"
            name="block"
            id="name"
            placeholder="Example: A2, A3, A4"
            value="{{$user->block}}"
            required
            autofocus
          />

          @error('block')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror

          <label for="unit">Unit No.</label>
          <input type="unit" name="unit" id="unit" required autofocus max="3" placeholder="Example: 6-4, 5-1" value="{{$user->unit}}"/>

          @error('unit')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror

          {{-- <label for="phone">Phone</label>
          <input
            type="tel"
            id="phone"
            name="phone"
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
          /> --}}
        </fieldset>

        <button type="submit" value="Save" class="bg-sky-600 text-black rounded py-4 px-4 mt-2 hover:bg-sky-400 inline-block"><b>Update</b></button>
      </form>
    </section>

    
    <x-profile-nav />
    
    <script>
      const toggleButton = document.querySelector(".toggle");
      const sidebar = document.querySelector(".sidebar");

      toggleButton.addEventListener("click", () => {
        sidebar.classList.toggle("active");
      });
    </script>
  </body>
</html>
