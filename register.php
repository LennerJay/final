<?php
    include "client/registerHeader.php";
    $app = "<script src='js/login-reg-form.js'></script>";

?>
<div id="app-form" class="bg-container">
    <div class="container">
        <div class="form-content">
            <form id="fill-out-form" @submit="fnRegister($event)">
                <h1 class="title">Registration</h1>

                <div class="row-1-content">
                    <div class="row-1">
                        <label for="username">Username</label>
                        <div class="col-1">
                            <input type="text" name="username" id="username" placeholder="Enter your username" required>
                        </div>
                    </div>

                    <div class="row-1">
                        <label for="firstname">Firstname</label>
                        <div class="col-2">
                            <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname" required>
                        </div>
                    </div>
                </div>

                <div class="row-2-content">
                    <div class="row-2">
                        <label for="lastname">Lastname</label>
                        <div class="col-1">
                            <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname" required>
                        </div>
                    </div>

                    <div class="row-2">
                        <label for="street">Street</label>
                        <div class="col-2">
                            <input type="text" name="street" id="street" placeholder="Enter your street" required>
                        </div>
                    </div>
                </div>

                <div class="row-3-content">
                    <div class="row-3">
                        <label for="city">City</label>
                        <div class="col-1">
                            <input type="text" name="city" id="city" placeholder="Enter your city" required>
                        </div>
                    </div>

                    <div class="row-3">
                        <label for="state">State</label>
                        <div class="col-2">
                            <input type="text" name="state" id="state" placeholder="Enter your state" required>
                        </div>
                    </div>
                </div>

                <div class="row-4-content">
                    <div class="row-4">
                        <label for="zip-code">Zipcode</label>
                        <div class="col-1">
                            <input type="number" name="zipcode" id="zip-code" placeholder="Enter your zip-code" required>
                        </div>
                    </div>

                    <div class="row-4">
                        <label for="age">Age</label>
                        <div class="col-2">
                            <input type="number" name="age" id="age" placeholder="Enter your age" required>
                        </div>
                    </div>
                </div>

                <div class="row-5-content">
                    <div class="row-5">
                        <label for="gender">Gender</label>
                        <div class="col-1">
                            <!-- <input type="text" name="gender" id="gender" placeholder="Enter your gender" required> -->
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected hidden>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row-5">
                        <label for="email">Email</label>
                        <div class="col-2">
                            <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                </div>

                <div class="row-6-content">
                    <div class="row-6">
                        <label for="password">Password</label>
                        <div class="col-1">
                            <i class="uil uil-lock icon"></i>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                    </div>

                    <div class="row-6">
                        <label for="confirm-pass">Confirm Password</label>
                        <div class="col-2">
                            <i class="uil uil-lock icon"></i>
                            <input type="password" name="cpassword" id="confirm-pass" placeholder="Confirm password" required>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                    </div>
                </div>

                <div class="row-7-content">
                    <div class="row-7">
                        <label id="upload-pic" for="profile-picture">Upload Picture</label>
                        <div class="col-1">
                            <input type="file" name="profile_picture" id="profile-picture" class="images">
                        </div>
                    </div>
                    <div class="empty">
                        
                    </div>
                </div>

                <button type="submit" id="register" value="submit">Register</button>

                <div class="already-have-account">
                    <span class="text">Already have an account?
                        <a href="login.php" class="text signin-link">Login</a>
                    </span>
                </div>
            </form>
            <!-- End of form tag -->
        </div>
        <!-- End of form content -->
    </div>
</div>
<?php
    include "client/footer.php";
?>