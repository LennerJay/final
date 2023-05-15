<?php
    include "admin/header.php";
    $app = "<script src='Server-side/Javascript/dashboard.js?".time()."'></script>";
?>
<div id="dashboard-app">
  <div class="modal fade" id="add" role="dialog">
    <div class="modal-dialog">
      <!--Add Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
          <form @submit="fnAddProduct($event)">
          	<div class="input-field">
              <label for="name">Product Name</label>
              <input type="text" class="form-control" name="product_name" id="product_name">
            </div>
            <div class="input-field">
              <label for="price">Product Price</label>
              <input type="text" class="form-control" name="price" id="price" >
            </div>
            <div class="input-field">
              <input type="hidden" class="form-control" name="new_price" id="new_price" >
            </div>
            <div class="input-field">
              <label for="brand">Product Brand</label>
              <input type="text" class="form-control" name="brand" id="brand">
            </div>
            <div class="input-field">
              <label for="brand">Product Variant</label>
              <input type="text" class="form-control" name="color" id="color">
            </div>
            <div class="input-field">
              <label for="brand">Variant Stock</label>
              <input type="text" class="form-control" name="vstock" id="vstock">
            </div>
            <div class="input-field">
              <label for="brand">Product Specification</label>
              <textarea class="form-control" name="product_spec" id="product_spec"></textarea>
            </div>
            <div class="input-field">
              <label for="description">Product Description</label>
              <textarea class="form-control" name="product_description" id="product_description"></textarea>
            </div>
            <div class="input-field">
              <label for="brand">Product Category</label>
              <select name="product_category" class="form-control" style="text-align: center; width: 50%;">
                <option value="computer">Computer</option>
                <option value="mobile">Mobile</option>
                <option value="television">Television</option>
                <option value="hardware">Hardware</option>
                <option value="software">Software</option>
                <option value="electronic">Electronic</option>
              </select>
            </div>
            <div class="input-field">
              <label for="brand">Product Picture</label>
              <input type="file" class="form-control" name="product_picture" id="product_picture" style="text-align: center; width: 50%;">
            </div><br>
            <div class="input-field">
              <button type="submit" class="form-control btn btn-default">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog">
      <!--Edit Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
        <form @submit="fnAddProduct($event)">
          	<div class="input-field">
              <label for="name">Product Name</label>
              <input type="text" class="form-control" name="product_name" id="product_name" v-model="product_name">
            </div>
            <div class="input-field">
            <label for="price">Product Old Price</label>
              <input type="text" class="form-control" name="price" id="price" v-model="product_price">
            </div>
            <div class="input-field">
              <label for="new_price">Product New Price</label>
              <input type="text" class="form-control" name="new_price" id="new_price">
            </div>
            <div class="input-field">
              <label for="brand">Product Brand</label>
              <input type="text" class="form-control" name="brand" id="brand" v-model="product_brand">
            </div>
            <div class="input-field">
              <label for="brand">Product Variant</label>
              <input type="text" class="form-control" name="color" id="color" v-model="product_variant">
            </div>
            <div class="input-field">
              <label for="brand">Variant Stock</label>
              <input type="text" class="form-control" name="vstock" id="vstock" v-model="product_stock">
            </div>
            <div class="input-field">
              <label for="brand">Product Specification</label>
              <textarea class="form-control" name="product_spec" id="product_spec" v-model="product_spec"></textarea>
            </div>
            <div class="input-field">
              <label for="description">Product Description</label>
              <textarea class="form-control" name="product_description" id="product_description" v-model="product_description"></textarea>
            </div>
            <div class="input-field">
              <label for="brand">Product Category</label>
              <select name="product_category" class="form-control" style="text-align: center; width: 50%;" v-model="product_category">
                <option value="computer">Computer</option>
                <option value="mobile">Mobile</option>
                <option value="television">Television</option>
                <option value="hardware">Hardware</option>
                <option value="software">Software</option>
                <option value="electronic">Electronic</option>
              </select>
            </div>
            <div class="input-field">
              <label for="brand">Product Picture</label>
              <input type="file" class="form-control" name="product_picture" id="product_picture" style="text-align: center; width: 50%;" v-model="product_images">
            </div><br>
            <div class="input-field">
              <button type="submit" class="form-control btn btn-default">Submit</button>
            </div>
          </form>
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
    <div>
      <div class="dash-content">
        <div class="overview">
          <div class="title">
            <i class="uil-shopping-cart-alt"></i>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add">Add Product</button>
          </div>
        </div>
        <div class="activity">
          <div style="overflow-x:auto;">
            <div class="row" v-for="item in items">
              <div class="col-md-4">
                <img class="img-fluid" :src="'images/'+ item.product_category +'/' + item.product_images" style="height:250px; width:250px; object-fit: cover;">
              </div>
              <div class="col-md-7">
                <p>Product Brand: {{  item.product_brand }}</p>
                <p>Product Name: {{  item.product_name }}</p>
                <p>Product Description: {{  item.product_description }}</p>
                <p>Product Specification: {{  item.product_spec }}</p>
                <p>Product Price: {{  item.product_price }}</p>
                <p>Product Variant: {{  item.product_variant }}</p>
                <p>Product New Price: {{  item.product_newPrice }}</p>
                <p>Product Stock: {{  item.product_stock }}</p>
                <p>Product Sold: {{  item.product_sold }}</p>
                <p>Product Category: {{  item.product_category }}</p>
              </div>
              <div class="col-md-1">
                <div class="input-field">
                  <button type="submit" class="form-control btn btn-default" data-toggle="modal" data-target="#edit" @click="fnGetItems(item.product_id)">Edit</button>
                  <button type="submit" class="form-control btn btn-default"  @click="fnDeleteItem(item.product_id)">Delete</button>
                </div>
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