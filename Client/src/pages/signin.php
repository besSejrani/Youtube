<?php

require (dirname(__DIR__, 2)) . "/vendor/autoload.php";

use \App\Form\Form;
use \App\Form\FormValidation;


ob_start();
$title = "Signup | Youtube";

$validation = new FormValidation();
$validation
    ->check("Username", "Username is required")->exists()->sanitize()->isLength(["min" => 2, "max" => 25])
    ->check("Password", "Password is required")->exists()->sanitize()->isLength(["min" => 8, "max" => 25])
?>

<div class="signInContainer">
    <div class="column">
        <div class="header">
            <img src="static/assets/youtube.svg" alt="youtube logo">
            <h3>Sign In</h3>
            <span>to continue to YouTube</span>
        </div>

        <div class="loginForm">
            <?php
            $form = new Form;
            $form->startForm("/signing", "POST")
                ->myInput("text", "Username", "myUsername")
                ->myInput("password", "Password", "myPassword")
                ->mySubmit("myButton")
                ->endForm();
            ?>

        </div>
        <a href="signup" class="signinMessage">Not a member yet ? Signup</a>
    </div>
</div>

<?php
$js = '';

$content = ob_get_clean();
require dirname(__DIR__) . "/layout/layout.php";