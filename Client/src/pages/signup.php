<?php

require (dirname(__DIR__, 2)) . "/vendor/autoload.php";

use App\Form\Form;
use \App\Form\FormValidation;

ob_start();
$title = "Signin | Youtube";

$validation = new FormValidation();
$validation
    ->check("Username", "Username is required")->exists()->sanitize()->isLength(["min" => 2, "max" => 25])
    ->check("Password", "Password is required")->exists()->sanitize()->isLength(["min" => 8, "max" => 25])
?>

<div class="signInContainer">
    <div class="column">
        <div class="header">
            <img src="static/assets/youtube.svg" alt="youtube logo">
            <h3>Sign Up</h3>
            <span>to continue to YouTube</span>
        </div>

        <div class="loginForm">
            <?php
            $form = new Form();
            $form->startForm("/signup", "POST")
                ->myInput("text", "Username", "myUsername")
                ->myInput("text", "First Name", "myFirstName")
                ->myInput("text", "Last Name", "myLastName")
                ->myInput("email", "Email", "myEmail")
                ->myInput("email", "Confirm Email", "myConfirmEmail")
                ->myInput("password", "Password", "myPassword")
                ->myInput("password", "Confirm Password", "myConfirmPassword")
                ->mySubmit("myButton")
                ->endForm();
            ?>
        </div>

        <a href="signin" class="signinMessage">Already got an account ? Signin</a>
    </div>
</div>


<?php
$js = '';

$content = ob_get_clean();
require dirname(__DIR__) . "/layout/layout.php";