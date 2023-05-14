<?php
    include "admin/header.php";
    $app = "<script src='Server-side/Javascript/dashboard.js'></script>";
?>

<div id="dashboard-app">
    <nav>
      <div class="logo-name">
        <div class="logo-image">
          <img src="images/1.png" alt="">
        </div>

        <span class="logo_name">E-C PC</span>
      </div>

      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="dashboard.php">
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
            <a href="#">
              <i class="uil-user-minus"></i>
              <span class="link-name">Disabled User</span>
            </a>
          </li>
          <ul class="logout-mode">
            <li>
              <a href="#" onclick="logout()">
                <i class="uil uil-signout"></i>
                <span class="link-name">Logout</span>
              </a>
            </li>
            <div class="mode-toggle">
            </div>
          </ul>
        </ul>
      </div>
    </nav>
    <section class="dashboard">
      <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
      </div>

      <div class="dash-content">
        <div class="overview">
          <div class="title">
            <i class="uil-user-square"></i>
            <span class="text">Disable User</span>
            </div>
              <div class="activity">
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
                                <th class="data-title">isDisable</th></span>
                            </div>
                            <div class="data type">
                                <th class="data-title">Date Disabled</th></span>
                            </div>
                            <div class="data action">
                                <th class="data-title">Action</th></span>
                            </div>
                        </tr>
                      </thead>
                        <tbody id="tbl_Data">
                          <tr v-for="duser in disuser">
                            <td>{{  duser.username }}</td>
                            <td>{{  duser.email }}</td>
                            <td>{{  duser.date_created }}</td>
                            <td>{{  duser.isactive }}</td>
                            <td>{{  duser.date_disabled }}</td>
                            <td>
                              <button class="form-control btn btn-default">Edit</button>
                              <button class="form-control btn btn-default">Delete</button>
                            </td>
                          </tr>
                        </tbody>
                    </div>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<?php
    include "admin/footer.php";
?>