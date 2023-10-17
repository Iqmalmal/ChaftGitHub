<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    
    <title>Cancelled

    </title>
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

    .container {
    max-width: 2200px;
        margin: 0 auto;
        text-align: center;
    padding: 20px;
    margin-left: 250px;
      background-color: #fff;
    box-shadow:  0 0 30px rgba(0, 0, 0, 0.2);
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
    max-width: 87%;
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

.box {
    background-color: white;
       margin: 0 auto;
    margin-top: 5px ;
    margin-right: 5px;
        align-items: center;
    border-radius: 5px;
    padding: 20px;
    width: 1640px;
    height: 1010px;
    box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5);
    
}

#cancelled-img {
  max-width: 400px;
  max-height: 400px;
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
@media (max-width: 768px) {
    .sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    background-color: #fff;
    transition: all 0.3s ease-in-out;
  }

  .sidebar .menu {
    display: block;
    width: 100%;
    padding: 0;
  }

  .sidebar .menu-links {
    display: block;
    width: 100%;
  }

  .sidebar .menu-links li {
    display: block;
    width: 100%;
  }

  .sidebar .menu-links li a {
    display: block;
    width: 100%;
    padding: 10px 15px;
  }

  .sidebar .menu-links li a .icon {
    display: inline-block;
   
    margin-right: 10px;
  }

  .sidebar .menu-links li a .text {
    display: inline-block;
   
  }

  .sidebar .bottom-content {
    display: none;
  }
  .container {
    max-width: 2200px;
  }

  .status-container {
    flex-direction: row;
  }

  .status-item {
    width: 420px;
  }
}
  </style>
  <body>
     
    <div class="container">
      <h1 style="margin-right: 260px;">Order Status</h1>
        @include('partials._myPurchase')
    </div>

    <div class="box">
      
        <div class="cancelled">
         <img src="images/cancelled.gif" id="cancelled-img"> 
         <p>No Orders Yet</p>
        </div>

    </div>
    
    <x-profile-nav />
    
</body>
</html>
