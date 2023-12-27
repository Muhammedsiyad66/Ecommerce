  <?php
  session_start();

  if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: adminlogin.php");
    exit();
  }

  // Include the database connection file and other necessary includes
  include('connection.php');

  // Retrieve data for the dashboard metrics
  // (rest of your existing code)
  ?>
  <!-- rest of your HTML code -->
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');

      body {
        font-family: 'Barlow', sans-serif;
      }

      a:hover {
        text-decoration: none;
      }

      .border-left {
        border-left: 2px solid var(--primary) !important;
      }

      .sidebar {
        top: 0;
        left: 0;
        z-index: 100;
        overflow-y: auto;
      }

      .overlay {
        background-color: rgb(0 0 0 / 45%);
        z-index: 99;
      }

      /* sidebar for small screens */
      @media screen and (max-width: 767px) {
        .sidebar {
          max-width: 18rem;
          transform: translateX(-100%);
          transition: transform 0.4s ease-out;
        }

        .sidebar.active {
          transform: translateX(0);
        }
      }
    </style>
  </head>

  <body>
    <!-- overlay -->
    <div id="sidebar-overlay" class="overlay w-100 vh-100 position-fixed d-none"></div>

    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
      <img id="logo" style="width:200px;" src="logo.png" alt="">
      <div class="list-group rounded-0">
        <a href="dashboard.php" class="list-group-item list-group-item-action  border-0 d-flex align-items-center">
          <span class="bi bi-border-all"></span>
          <span class="ml-2">Dashboard</span>
        </a>
        <a href="customer.php" id="add-pro" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-box"></span>
          <span class="ml-2">Customers</span>
        </a>
        <a href="oreders.php" id="add-pro" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-cart-plus"></span>
          <span class="ml-2">Orders</span>
        </a>


        <a class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#sale-collapse">
          <div>
            <span class="bi bi-cart-dash"></span>
            <span class="ml-2">Products</span>
          </div>
          <span class="bi bi-chevron-down small"></span>
        </a>
        <div class="collapse" id="sale-collapse" data-parent="#sidebar">
          <div class="list-group">
            <a href="add-product.php" class="list-group-item list-group-item-action border-0 pl-5">add product</a>
            <a href="table.php" class="list-group-item list-group-item-action border-0 pl-5">update/delete Products</a>
          </div>
        </div>


      </div>
    </div>

    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
      <!-- top nav -->
      <nav id="nav-log" class="w-100 d-flex px-4 py-2 mb-4 shadow-sm"> 
        <!-- close sidebar -->
        <button class="btn py-0 d-lg-none" id="open-sidebar">
          <span class="bi bi-list text-primary h3"></span>
        </button>
        <div class="dropdown ml-auto">
          <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button>
          </a>
        </div>
      </nav>


      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
      <script>
        $(document).ready(() => {
          $('#open-sidebar').click(() => {
            $('#sidebar').addClass('active');
            $('#sidebar-overlay').removeClass('d-none');
          });

          $('#sidebar-overlay').click(function() {
            $('#sidebar').removeClass('active');
            $(this).addClass('d-none');
          });
        });
      </script>
  </body>

  </html>