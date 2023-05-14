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
                    <a href="">
                        <i class='bx bxs-cart'></i>
                        <span class="nav-item">shopping Cart</span>
                    </a>
                    <span class="tool-tip">shopping Cart</span>
                </li>
                <li>
                    <a href="">
                        <i class='bx bxs-food-menu'></i>
                        <span class="nav-item">my orders</span>
                    </a>
                    <span class="tool-tip">my orders</span>
                </li>
                <li>
                    <a href="">
                        <i class='bx bxs-purchase-tag' ></i>
                        <span class="nav-item">my purchase</span>
                    </a>
                    <span class="tool-tip">my purchase</span>
                </li>
                <li>
                    <a href="">
                        <i class='bx bxs-message-dots' ></i>
                        <span class="nav-item">message</span>
                    </a>
                    <span class="tool-tip">message</span>
                </li>
                <li>
                    <a href="">
                        <i class='bx bxs-cog' ></i>
                        <span class="nav-item">settings</span>
                    </a>
                    <span class="tool-tip">settings</span>
                </li>
                <!-- <li>
                    <div class="logout-container">
                        <button type="button" class="nav-item logout">Logout</button>
                    </div>
                    <span class="tool-tip">logout</span>
                </li> -->
            </ul>
        </div>
        <!-- End of class sidebar -->

        <div class="main-container">
            <div class="main-heading">
                <h1>Account Settings</h1>
            </div>
            <div class="settings-wrapper">
                <form action="#" id="fill-form" method="post" enctype="multipart/form-data">
                    <div class="form-content">
                        <div class="row-1-content">
                            <h2>Personal Details</h2>
                            <div class="row-1">
                                <div class="col-1">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" name="firstname" placeholder="Enter firstname">
                                </div>

                                <div class="col-2">
                                    <label for="lastname">lastname</label>
                                    <input type="text" id="lastname" name="lastname" placeholder="Enter lastname">
                                </div>
                            </div>
                        </div>

                        <div class="row-2-content">
                            <h2>Address</h2>
                            <div class="row-2">
                                <div class="col-1">
                                    <label for="street">Street</label>
                                    <input type="text" id="street" name="street" placeholder="Enter street">
                                </div>

                                <div class="col-2">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" placeholder="Enter city">
                                </div>
                            </div>
                        </div>

                        <div class="row-3-content">
                            <div class="row-3">
                                <div class="col-1">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="Enter state">
                                </div>

                                <div class="col-2">
                                    <label for="zip-code">Zip Code</label>
                                    <input type="text" id="zip-code" name="zip-code" placeholder="Enter Zipcode">
                                </div>
                            </div>
                        </div>

                        <div class="row-4-content">
                            <div class="row-4">
                                <div class="col-1">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="Enter state">
                                </div>

                                <div class="col-2">
                                    <label for="zip-code">Zip Code</label>
                                    <input type="text" id="zip-code" name="zipcode" placeholder="Enter zipcode">
                                </div>
                            </div>
                        </div>

                        <div class="buttons">
                            <div class="empty">
                                <!-- No statement here -->
                            </div>
                            <div class="filled">
                                <button type="button" id="cancel" value="cancel">Cancel</button>
                                <button type="button" id="update" value="update">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End form tag -->
            </div>
        </div>
    </div>
        <!-- End of main container -->

        <script src="Server-side/Javascript/vue.v3.js"></script>
        <script src="Server-side/Javascript/axios.js"></script>
        <script src="Server-side/Javascript/profile.js"></script>

	</body>
</html>