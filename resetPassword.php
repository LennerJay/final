<?php 
    require("./dbCon/backend.php");
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:index.php");
    }
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
                    <a href="">
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
                    <a href="">
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
                <h1>Reset Password</h1>
            </div>
            <div class="settings-wrapper">
                <form id="fill-form" @submit="updateUserPassword($event)">
                    <div class="form-content">
                        <div class="row-1-content">
                            <h2>Reset password</h2>
                            <div class="row-1">
                                <div class="col-1">
                                    <input type="hidden" id="userid" name="userid" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">
                                    <label for="usern">Email address</label>
                                    <input type="email" id="email" name="email" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="old_password">Old password</label>
                                    <input type="password" id="old_password" name="old_password" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row-4-content">
                            <div class="row-2">
                                <div class="col-1">
                                    <label for="new_password">New password</label>
                                    <input type="password" id="new_password" name="new_password" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" disabled>
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
        <script src="Server-side/Javascript/profile.js"></script>

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

                let inputs = document.getElementsByTagName("input"); 
                for (let x = 0; x < inputs.length; x++) { 
                    inputs[x].disabled = false;
                } 
            });

            cancel.addEventListener("click", function(){
                edit.style.display = "inline";
                update.style.display = "none";

                let inputs = document.getElementsByTagName("input"); 
                for (let x = 0; x < inputs.length; x++) { 
                    inputs[x].disabled = true;
                } 
            });
        </script>

	</body>
</html>