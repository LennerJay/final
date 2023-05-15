<?php
    session_start();
    include "client/loginHeader.php";
    $app = "<script src='js/login-reg-form.js'></script>";
?>
<div id="app-form" class="bg-container">
    <div class="container">
        <div class="form-content">
            <h2>Login</h2>
            <form id="fill-out-form" @submit.prevent="fnLogIn($event)">
                <div class="input-field">
                    <i class="fa-sharp fa-solid fa-envelope"></i>
                    <input type="text" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" class="password" placeholder="Enter your password" required>
                    <i class="fa-solid fa-eye-slash"></i>
                </div>

                <div class="forgot-password">
                    <a href="fpassword.php" class="text">Forgot password?</a>
                </div>

                <div class="button">
                    <button type="submit" id="login" value="login">Login</button>
                </div>

            </form>
            <br>
            <div class="need-an-account">
                <span class="text">Need an account?
                    <a href="register.php" id="register">Register</a>
                </span>
            </div>
        </div>
    </div>
</div>
<?php
    include "client/footer.php";
?>