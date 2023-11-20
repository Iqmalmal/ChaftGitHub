<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
  </style>
  <body>
    <nav class="sidebar close">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="/images/logo.png" alt="logo" />
          </span>

          <div class="text header-text">
            <span class="name">GMI CHAFT</span>
          </div>
        </div>

        <i class="bx bx-chevron-right toggle"></i>
      </header>

      <div class="menu-bar">
        <div class="menu">
          <ul class="menu-links">
            <li class="nav-link">
                <a href="/">
                  <i class="bx bx-arrow-back icon"></i>
                  <span class="text nav-text"> &nbsp;  Back</span>
                </a>
              </li>

            <li class="nav-link">
              <a href="/profile">
                <i class="bx bx-home-alt icon"></i>
                <span class="text nav-text">Profile</span>
              </a>
            </li>

            <li class="nav-link">
              <a href="/address">
                <i class="bx bx-location-plus icon"></i>
                <span class="text nav-text">Address</span>
              </a>
            </li>

            <li class="nav-link">
              <a href="/mypurchase">
                <i class="bx bx-wallet icon"></i>
                <span class="text nav-text">My Purchase</span>
              </a>
            </li>

            <li class="nav-link">
              <a href="/sellers/dashboard/{seller}">
                <i class="bx bx-box icon"></i>
                <span class="text nav-text">Seller Center</span>
              </a>
            </li>

            <li class="nav-link">
              <a href="mailto:chaft@chaft.online">
                <i class="bx bx-support icon"></i>
                <span class="text nav-text">Contact Admin</span>
              </a>
            </li>

            <li class="nav-link">
            <a href="mailto:admin@example.com?subject=Reqeust%20for%20account%20deletion&amp;body=I%20reqeuest%20for%20account%20deletion.%0D%0AFull%20Name:%20%0D%0AStudent%20ID:%20 ">
                <i class="bx bx-trash icon"></i>
                <span class="text nav-text">Account Deletion</span>
              </a>
            </li>
          </ul>
        </div>

        <div class="bottom-content">
          <li class="">
            <a href="#">
              <i class="bx bx-log-out icon"></i>
              <span class="text nav-text">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </nav>

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
