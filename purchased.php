<?php
    include "admin/header.php";
    $app = "<script src='Server-side/Javascript/dashboard.js?".time()."'></script>";
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
          <form @submit="fnUpdateSales($event)">
            <div class="row" v-for="purchased in purchasedItems">
              <div class="col-md-3">
                <img class="img-fluid" :src="'images/'+ purchased.product_category +'/' + purchased.product_images" style="height:100px; width:100px; object-fit: cover;">
              </div>
              <div class="col-md-9">
                <input type="hidden" name="product_id" v-model="purchased.product_id">
                <p>Product Brand: {{  purchased.product_brand }}</p>
                <p>Product Name: {{  purchased.product_name }}</p>
                <p>Product Description: {{  purchased.product_description }}</p>
                <p>Product Specification: {{  purchased.product_specification }}</p>
                <p>Quantity: {{  purchased.quantity }}</p>
                <input type="hidden" name="quantity" v-model="purchased.quantity">
                <p>Total Price: {{  purchased.product_oldPrice }}</p>
                <input type="hidden" name="tprice" v-model="purchased.product_oldPrice">
                <p>Product Variant: {{  purchased.product_variant }}</p>
                <!-- <p>Product New Price: {{  purchased.product_newPrice }}</p> -->
                <p>Product Category: {{  purchased.product_category }}</p>
                <div class="input-field" style="padding-bottom: 20px;">
                  <label for="Status">Status</label>
                  <select name="status" id="status" class="form-control btn btn-default">
                    <option value="Pending">Pending</option>
                    <option value="Approve">Approve</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="input-field" style="padding-top: 20px;">
              <button type="submit" class="form-control btn btn-default" style="background-color:blue; color:white;">Submit</button>
            </div>
          <form>       
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
        <span class="logo_name">Tactical Minds</span>
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
                                <th class="data-title">Customer Name</th></span>
                            </div>
                            <div class="data email">
                                <th class="data-title">Address</th></span>
                            </div>
                            <div class="data joined">
                                <th class="data-title">Zipcode</th>
                            </div>
                            <div class="data type">
                                <th class="data-title">Gender</th></span>
                            </div>
                            <div class="data type">
                                <th class="data-title">Email</th></span>
                            </div>  
                            <div class="data status">
                                <th class="data-title">View Purchased</th></span>
                            </div>
                        </tr>
                      </thead>
                        <tbody id="tbl_Data">
                            <tr v-for="costumer in customers">            
                                <td>{{ costumer.fullname }}</td>
                                <td>{{ costumer.address }}</td>
                                <td>{{ costumer.zipcode }}</td>
                                <td>{{ costumer.gender }}</td>
                                <td>{{ costumer.email }}</td>
                                <td><button class="form-control" data-toggle="modal" data-target="#view-product" @click="fnGetCustomerPurchased(costumer.userid)">View</button></td>
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