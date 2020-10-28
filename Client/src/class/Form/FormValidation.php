<?php

namespace App\Form;

require (dirname(__DIR__, 3)) . "/vendor/autoload.php";

use App\Error\RequestValidationError;

class FormValidation
{
    public $field;

    public function check(string $field, string $message)
    {
        try {

            if ($_FILES[$field] === [] || !$_POST[$field]) {
                throw new RequestValidationError($message);
            }

            $this->field = $_POST[$field];
            return $this;
        } catch (RequestValidationError $error) {
            echo $error->message;
        }
    }

    public function sanitize()
    {
        $this->field = trim($this->field);
        $this->field = strtolower($this->field);
        $this->field = strip_tags($this->field);
        $this->field = htmlentities($this->field);
        $this->field = stripslashes($this->field);
        $this->field = htmlspecialchars($this->field);
        return $this;
    }

    public function exists()
    {
        try {
            if (!isset($this->field)) {
                throw new RequestValidationError("doesn't exists");
            }
            isset($this->field);
        } catch (RequestValidationError $error) {
            echo $error->message;
        }
        return $this;
    }

    public function isEmail()
    {
        try {
            $email = $this->field;
            $regex = "/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";

            if (!preg_match($regex, $email)) {
                throw new RequestValidationError("Email is not valid");
            }
        } catch (RequestValidationError $error) {
            echo $error->message;
        }
        return $this;
    }

    public function isLength($length)
    {
        try {
            $min = $length['min'];
            $max = $length['max'];
            $field = strlen($this->field);
            $thisField = $this->field;

            if ($field < $min || $field > $max) {
                throw new RequestValidationError("Field $thisField has a length of $field, should not be less than $min or higher than $max");
            }
        } catch (RequestValidationError $error) {
            echo $error->message;
        }

        return $this;
    }
}