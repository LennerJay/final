<?php
    session_start();
    if($_SESSION['role'] != 2){
      header("location:index.php");
    }
    include "admin/header.php";
    $app = "<script src='Server-side/Javascript/dashboard.js'></script>";
?>
<div id="dashboard-app">
  <nav>
    <div class="logo-name">
      <div class="logo-image">
        <img src="images/1.png" alt="">
      </div>
      <span class="logo_name">Tactical Minds</span>
    </div>
    <div class="menu-items">
      <ul class="nav-links">
        <li>
          <a href="#">
            <i class="uil uil-estate"></i>
            <span class="link-name">Dahsboard</span>
          </a>
        </li>
        <li>
          <a href="user_table.php">
            <i class="uil-user-circle"></i>
            <span class="link-name">Users</span>
          </a>
        </li>
        <li>
          <a href="purchased.php">
            <i class="uil-shopping-cart-alt"></i>
            <span class="link-name">Purchased</span>
          </a>
        </li>
        <li>
          <a href="product.php">
            <i class="uil-shopping-cart-alt"></i>
            <span class="link-name">Product</span>
          </a>
        </li>
        <li>
          <a href="disable_user.php">
            <i class="uil-user-minus"></i>
            <span class="link-name">Disabled User</span>
          </a>
        </li>
        <ul class="logout-mode">
          <li>
            <a href="logout.php">
              <i class="uil uil-signout"></i>
              <span class="link-name">Logout</span>
            </a>
          </li>
          <!-- <div class="mode-toggle">
          </div> -->
        </ul>
      </ul>
    </div>
  </nav>

  <section class="dashboard">
    <div class="container">
        <div class="top">
        <i class="uil uil-bars sidebar-toggle" id="toggle-btn"></i>
      </div>
      
      <div class="dash-content">
        <div class="overview">
          <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Dashboard</span>
          </div>
          
          <div class="boxes">
            <div class="box box1">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              <span class="text">Total User</span>
              <span class="number">{{ users.length }}</span>
            </div>

            <div class="box box2">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="text">Total Sales</span>
                <span class="number">{{ totalSales}}</span>
            </div>

            <div class="box box3">
              <i class="fa fa-user-times" aria-hidden="true"></i>
              <span class="text">Disabled User</span>
              <span class="number">{{ disuser.length }}</span>
            </div>
          </div>
        </div>

        <div class="activity">
          <div class="title">
            <i class="uil uil-clock-three"></i>
            <span class="text">Recent Register</span>
          </div>

          <div style="overflow-x:auto;">
            <table class="datas" id="myDataTable">
              <div class="activity-data">
                <thead>
                  <tr>
                    <div class="data names">
                      <th class="data-title">Username</th></span>
                    </div>
                    <div class="data email">
                      <th class="data-title">Email</th></span>
                    </div>
                    <div class="data joined">
                      <th class="data-title">Date Joined</th>
                    </div>
                    <div class="data type">
                      <th class="data-title">Roles</th></span>
                    </div>
                    <div class="data status">
                      <th class="data-title">Status</th></span>
                    </div>
                  </tr>
                </thead>
                <tbody id="tbl_Data">
                  <tr v-for="user in users">
                    <td>{{  user.username }}</td>
                    <td>{{  user.email }}</td>
                    <td>{{  user.date_created }}</td>
                    <td>{{  user.role }}</td>
                    <td>{{  user.status }}</td>
                  </tr>
                </tbody>
              </div>
            </table>
          </div>
        </div>
      </div>
  </section>
</div>

<?php
    include "admin/footer.php";
?>