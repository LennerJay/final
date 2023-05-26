<!DOCTYPE html>

<html lang="en-PH">
    <head>
        <meta charset="UTF-8">
        <title>E-Commerce | Profile Settings</title>

        <meta name="author" content="Group Tactical Minds">
        <meta name="description" content="E-Commerce's Profile Settings">
        <meta name="keywords" content="E-Commerce, Profile Settings">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="designs/profUserStyle.css">
        <link rel="stylesheet" href="Font-awesome/css/all.min.css">
    </head>
    <body>
        
        <section id="main-section">
            <div class="section-content">
                <nav id="main-nav">
                    <div class="nav-content">
                        <button type="button" id="user-cred" value="user"><i class="fa-solid fa-user user"></i>User</button>
                        <button type="button" id="user-cart" value="user"><i class="fa-solid fa-cart-shopping"></i>Cart</button>
                        <button type="button" id="user-purchased" value="user"><i class="fa-sharp fa-solid fa-bag-shopping"></i>Purchased</button>
                        <button type="button" id="user-email" value="user"><i class="fa-solid fa-envelope reset-email"></i>Email</button>
                        <button type="button" id="user-password" value="user"><i class="fa-solid fa-key reset-password"></i>Password</button>
                        <button type="button" id="user-logout" value="user"><i class="fa-solid fa-right-from-bracket logout"></i>Logout</button>
                    </div>
                </nav>
                <!-- End of main nav -->
                <div id="user-infos">
                    <div class="user-infos-content">
                        <form id="fill-out-form" method="post">

                            <div class="flex">
                                <div class="username">
                                    <label for="username">Username</label>
                                    <div class="content">
                                        <input type="text" id="username" name="username">
                                    </div>
                                </div>

                                <div class="firstname">
                                    <label for="firstname">Firstname</label>
                                    <div class="content">
                                        <input type="text" id="firstname" name="firstname">
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="lastname">
                                    <label for="lastname">Lastname</label>
                                    <div class="content">
                                        <input type="text" id="lastname" name="lastname">
                                    </div>
                                </div>

                                <div class="age">
                                    <label for="age">Age</label>
                                    <div class="content">
                                        <input type="number" id="age" name="age">
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="gender">
                                    <div class="content">
                                        <input type="radio" id="male" name="gender" value="Male">
                                        <label for="male">Male</label>

                                        <input type="radio" id="female" name="gender" value="Female">
                                        <label for="female">Female</label>

                                        <input type="radio" id="others" name="gender" value="Others">
                                        <label for="others">Others</label>
                                    </div>
                                </div>
                                <div class="empty">
                                    <!-- No statements here -->
                                </div>
                            </div>

                            <div class="flex">
                                <div class="street">
                                    <label for="street">Street</label>
                                    <div class="content">
                                        <input type="text" id="street" name="street">
                                    </div>
                                </div>

                                <div class="city">
                                    <label for="city">City</label>
                                    <div class="content">
                                        <input type="text" id="city" name="city">
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="state">
                                    <label for="state">State</label>
                                    <div class="content">
                                        <input type="text" id="state" name="state">
                                    </div>
                                </div>

                                <div class="zipcode">
                                    <label for="zipcode">Zipcode</label>
                                    <div class="content">
                                        <input type="number" id="zipcode" name="zipcode">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of user infos -->
            </div>
            <!-- End of section content -->
        </section>
        <!-- End of main section -->

    </body>
    <!-- End of body tag -->
</html>
<!-- End of html tag -->