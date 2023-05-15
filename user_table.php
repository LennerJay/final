<?php
    include "admin/header.php";
    $app = "<script src='Server-side/Javascript/dashboard.js'></script>";
?>
<div id="dashboard-app">
  <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog">
      <!--Edit Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
          <form @submit="fnUpdateUser($event)">
            <div class="input-field">
              <label for="name">Username</label>
              <input type="text" class="form-control" name="username" id="username" v-model="username">
            </div>
            <div class="input-field">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" v-model="email">
            </div>
            <div class="input-field">
              <label for="fname">Firstname</label>
              <input type="text" class="form-control" name="fname" id="fname" v-model="firstname">
            </div>
            <div class="input-field">
              <label for="lname">Lastname</label>
              <input type="text" class="form-control" name="lname" id="lname" v-model="lastname">
            </div>
            <div class="input-field">
              <label for="street">Street</label>
              <input type="text" class="form-control" name="street" id="street" v-model="street">
            </div>
            <div class="input-field">
              <label for="city">City</label>
              <input type="text" class="form-control" name="city" id="city" v-model="city">
            </div>
            <div class="input-field">
              <label for="state">State</label>
              <input type="text" class="form-control" name="state" id="state" v-model="state">
            </div>
            <div class="input-field">
              <label for="zipcode">Zipcode</label>
              <input type="text" class="form-control" name="zipcode" id="zipcode" v-model="zipcode">
            </div>
            <div class="input-field">
              <label for="Gender">Gender</label>
              <select id="gender" name="gender" class="form-control" v-model="gender">
                <option value="" disabled selected hidden >Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
              </select>
            </div>
            <div class="input-field">
              <label for="brand">Roles</label>
              <input type="text" class="form-control" name="roles" id="roles" v-model="role">
            </div>
            <div class="input-field">
              <label for="brand">Status</label>
              <input type="text" class="form-control" name="status" id="status" v-model="status">
            </div>
            <div class="input-field">
              <label for="brand">isActive</label>
              <input type="text" class="form-control" name="isactive" id="isactive" v-model="isactive">
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
    <div class="dash-content">
      <div class="overview">
        <div class="title">
          <i class="uil-user-square"></i>
          <span class="text">User Table</span>
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
                    <div class="data email">
                      <th class="data-title">Fullname</th></span>
                    </div>
                    <div class="data email">
                      <th class="data-title">Address</th></span>
                    </div>
                    <div class="data email">
                      <th class="data-title">Zipcode</th></span>
                    </div>
                    <div class="data email">
                      <th class="data-title">Gender</th></span>
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
                    <div class="data action">
                      <th class="data-title">Action</th></span>
                    </div>
                  </tr>
                </thead>
                <tbody id="tbl_Data">
                  <tr v-for="user in users">
                    <td>{{  user.username }}</td>
                    <td>{{  user.email }}</td>
                    <td>{{  user.firstname }} {{user.lastname}}</td>
                    <td>{{  user.street }},{{user.city}},{{user.state}}</td>
                    <td>{{  user.zipcode }}</td>
                    <td>{{  user.gender }}</td>
                    <td>{{  user.date_created }}</td>
                    <td>{{  user.role }}</td>
                    <td>{{  user.status }}</td>
                    <td>
                      <button class="form-control btn btn-default" data-toggle="modal" data-target="#edit" @click="fnGetUser(user.userid)">Edit</button>
                    </td>
                  </tr>
                </tbody>
              </div>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
    include "admin/footer.php";
?>