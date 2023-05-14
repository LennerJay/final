<?php
    include "admin/header.php";
    $app = "<script src='Server-side/Javascript/dashboard.js'></script>";
?>

<div id="dashboard-app">
  <!----MODAL VIEW PURCHASED! -->
  <div class="modal fade" id="view-product" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Product Purchased!</h4>
        </div>
        <div class="modal-body">
        <div class="row" v-for="item in items">
              <div class="col-md-3">
                <img class="img-fluid" :src="'images/'+ item.product_category +'/' + item.product_images" style="height:100px; width:100px; object-fit: cover;">
              </div>
              <div class="col-md-9">
                <p>Product Brand: {{  item.product_brand }}</p>
                <p>Product Name: {{  item.product_name }}</p>
                <p>Product Description: {{  item.product_description }}</p>
                <p>Product Specification: {{  item.product_spec }}</p>
                <p>Product Price: {{  item.product_price }}</p>
                <p>Product Variant: {{  item.product_variant }}</p>
                <p>Product New Price: {{  item.product_newPrice }}</p>
                <p>Product Category: {{  item.product_category }}</p>
                <label for="Status">Status</label>
                <select name="" id="" class="form-control btn btn-default">
                  <option value="1" name="pending">Pending</option>
                  <option value="2" name="on_delivery">On Delivery</option>
                  <option value="3" name="complete">Complete</option>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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
            <a href="#">
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
              <a href="#" onclick="logout()">
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
      <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
      </div>

      <div class="dash-content">
        <div class="overview">
          <div class="title">
            <i class="uil-shopping-cart-alt"></i>
            <span class="text">Purchase Table</span>
            </div>
              <div class="activity">
                <div style="overflow-x:auto;">
                  <table class="datas" id="myDataTable">
                    <div class="activity-data">
                      <thead>
                        <tr>
                            <div class="data names">
                                <th class="data-title">First Name</th></span>
                            </div>
                            <div class="data names">
                                <th class="data-title">Last Name</th></span>
                            </div>
                            <div class="data email">
                                <th class="data-title">Street</th></span>
                            </div>
                            <div class="data joined">
                                <th class="data-title">City</th>
                            </div>
                            <div class="data type">
                                <th class="data-title">State</th></span>
                            </div>
                            <div class="data type">
                                <th class="data-title">Zipcode</th></span>
                            </div>
                            <div class="data type">
                                <th class="data-title">Gender</th></span>
                            </div>
                            <div class="data status">
                                <th class="data-title">Email</th></span>
                            </div>
                            <div class="data status">
                                <th class="data-title">View Purchased</th></span>
                            </div>
                        </tr>
                      </thead>
                        <tbody id="tbl_Data">
                            <tr>
                                <td>Ranel</td>
                                <td>Soliano</td>
                                <td>Atabay</td>
                                <td>Lapu Lapu City</td>
                                <td>Philippines</td>
                                <td>6016</td>
                                <td>Male</td>
                                <td>ranel.soliano@gmail.com</td>
                                <td><button class="form-control" data-toggle="modal" data-target="#view-product">View</button></td>
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