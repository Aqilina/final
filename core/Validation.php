<?php


namespace app\core;



// this is a class to validate different inputs and data

use app\model\AuthModel;

class Validation
{
    private $password;

    public function ifEmptyArr($arr)
    {
        // check if all values of array is empty
        foreach ($arr as $errorValue) {
            if (!empty($errorValue)) {
                return false;
            }
        }
        return true;
    }

    /**
     * check if given sting is empty returns message if empty.
     *
     * @param string $field
     * @param string $msg
     * @return string
     */
    public function validateEmpty($field, $msg)
    {
        return empty($field) ? $msg : '';
    }

    /**
     * if field is empty we return message, else we return empty string.
     *
     * @param string $field
     * @return string
     */
    public function validateName($field)
    {
        // Validate Name
        if (empty($field)) return "Please enter your Name";
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Name must only contain latin characters";
        return '';
    }

    public function validateLastname($field)
    {
        if (empty($field)) return "Please enter your Lastname";
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Lastname must only contain latin characters";
        return '';
    }


    public function validateEmail($field, &$userModel = null)
    {
        // validate empty
        if (empty($field)) return "Please enter Your Email";
        // check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";
        if ($userModel !== null) {
            // if email already exists
            if ($userModel->findUserByEmail($field)) return 'Email already taken';
        }
        return '';
    }

    /**
     * Validate rules and test for Email in login
     *
     * @param string $field
     * @param AuthModel $authModel
     * @return string
     */
    public function validateLoginEmail($field, &$authModel)
    {
        // validate empty
        if (empty($field)) return "Please enter Your Email";

        // check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        // if email already exists
        if (!$authModel->findUserByEmail($field)) return 'Email not found';

        return '';
    }

    public function validatePassword($passField, $min, $max)
    {
        // validate empty
        if (empty($passField)) return "Please enter a password";

        $this->password = $passField;
        // if pass length is les then min
        if (strlen($passField) < $min) return "Password must be more than $min characters length";
        // if pass length is more then max
        if (strlen($passField) > $max) return "Password must be less than $max characters length";

        // check password strength
//        if (!preg_match("#[0-9]+#", $passField)) return "Password must contain at least one number";

        return '';
    }

    public function confirmPassword($repeatField)
    {
        // validate empty
        if (empty($repeatField)) return "Please repeat a password";
        if (!$this->password) return 'no password saved';
        if ($repeatField !== $this->password) return "Password must match";
        return '';
    }
}
