<?php 
    require("./dbCon/backend.php");
    session_start();
?>

<!DOCTYPE html>

<html lang="en-PH">
    <head>
        <meta charset="UTF-8">
        <title>E-Commerce | User Profile Settings</title>

        <meta name="author" content="Group Tactical Minds">
        <meta name="description" content="E-Commerce User Profile Settings">
        <meta name="keywords" content="E-Commerce, User Profile, Settings">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="Styles/profile.css">
        <link rel="icon" type="image/x-icon" href="Icons/ecommercelogo.ico">
        <link rel="stylesheet" href="Font-awesome/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>

    <div id="profile-app">
        <div class="sidebar">
            <div class="menu">
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <div class="profile">
                <!-- <img src="images/AdminLogo2.png" alt="User Profile" id="profile-img"> -->
                <span id="username">User</span>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.php">
                    <i class="fa-solid fa-cart-shopping user"></i>
                        <span class="nav-item">Shopping</span>
                    </a>
                    <span class="tool-tip">Shopping</span>
                </li>
                <li>
                    <a href="settings.php">
                        <i class="fa-solid fa-user user"></i>
                        <span class="nav-item">User</span>
                    </a>
                    <span class="tool-tip">User</span>
                </li>
                <li>
                    <a href="userCart.php">
                        <i class='bx bxs-cart'></i>
                        <span class="nav-item">shopping Cart</span>
                    </a>
                    <span class="tool-tip">shopping Cart</span>
                </li>
                <li>
                    <a href="user_purchased.php">
                        <i class='bx bxs-purchase-tag' ></i>
                        <span class="nav-item">my purchase</span>
                    </a>
                    <span class="tool-tip">my purchase</span>
                </li>
                <li>
                    <a href="resetEmail.php">
                    <i class="fa-solid fa-envelope reset-email"></i>
                        <span class="nav-item">Reset email</span>
                    </a>
                    <span class="tool-tip">Reset email</span>
                </li>
                <li>
                    <a href="resetPassword.php">
                    <i class="fa-solid fa-key reset-password"></i>
                        <span class="nav-item">Reset password</span>
                    </a>
                    <span class="tool-tip">Reset password</span>
                </li>
                <li>
                    <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket logout"></i>
                        <span class="nav-item">Logout</span>
                    </a>
                    <span class="tool-tip">Logout</span>
                </li>
            </ul>
        </div>
        <!-- End of class sidebar -->

        <div class="main-container">
            <div class="main-heading">
                <h1>Account Settings</h1>
            </div>
            <div class="settings-wrapper">
                <form id="fill-form" @submit="updateUserInformation($event)">
                    <div class="form-content">
                        <div class="row-1-content">
                            <h2>Personal Details</h2>
                            <div class="row-1">
                                <div class="col-1">
                                    <input type="hidden" id="userid" name="userid" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">
                                    <label for="usern">Username</label>
                                    <input type="text" id="usern" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" name="firstname" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '' ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row-2-content">
                            <div class="row-2">
                                <div class="col-1">
                                    <label for="street">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '' ?>" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="age">Age</label>
                                    <input type="number" id="age" name="age" value="<?php echo isset($_SESSION['age']) ? $_SESSION['age'] : '' ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row-3-content">
                            <div class="row-2">
                                <div class="col-1">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" disabled>
                                        <option value="" selected disabled hidden>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row-5-content">
                            <h2>Address</h2>
                            <div class="row-2">
                                <div class="col-1">
                                    <label for="street">Street</label>
                                    <input type="text" id="street" name="street" value="<?php echo isset($_SESSION['street']) ? $_SESSION['street'] : '' ?>" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" value="<?php echo isset($_SESSION['city']) ? $_SESSION['city'] : '' ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row-6-content">
                            <div class="row-3">
                                <div class="col-1">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" value="<?php echo isset($_SESSION['state']) ? $_SESSION['state'] : '' ?>" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="zip-code">Zip Code</label>
                                    <input type="text" id="zip-code" name="zip-code" value="<?php echo isset($_SESSION['zipcode']) ? $_SESSION['zipcode'] : '' ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="buttons">
                            <div class="empty">
                                <!-- No statement here -->
                            </div>
                            <div class="filled">
                                <button type="button" id="cancel" value="cancel">Cancel</button>
                                <button type="button" id="edit" value="edit">Edit</button>
                                <button type="submit" id="update" value="update">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End form tag -->
            </div>
        </div>
    </div>
        <!-- End of profile app -->

        <script src="Server-side/Javascript/vue.v3.js"></script>
        <script src="Server-side/Javascript/axios.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

        <script>
            let sidebar = document.querySelector('.sidebar');
            let btn = document.querySelector('#btn');

            btn.addEventListener("click", function(){
                sidebar.classList.toggle('active');
            });

            document.getElementById("update").style.display = "none";

            let edit = document.getElementById("edit");
            let update = document.getElementById("update");
            let cancel = document.getElementById("cancel");

            edit.addEventListener("click", function(){
                edit.style.display = "none";
                update.style.display = "inline";
                
                let select = document.getElementsByTagName("select")[0].disabled = false;

                let inputs = document.getElementsByTagName("input"); 
                for (let x = 0; x < inputs.length; x++) { 
                    inputs[x].disabled = false;
                } 
            });

            cancel.addEventListener("click", function(){
                edit.style.display = "inline";
                update.style.display = "none";
                
                let select = document.getElementsByTagName("select")[0].disabled = true;

                let inputs = document.getElementsByTagName("input"); 
                for (let x = 0; x < inputs.length; x++) { 
                    inputs[x].disabled = true;
                } 
            });
        </script>

    </body>
</html>