<?php


namespace app\core;



use app\model\AuthModel;

/**
 * Class Validation
 * this is a class to validate different inputs and data
 * @package app\core
 */
class Validation
{
    /**
     * @var
     */
    private $password;

    /**
     * @param $arr
     * @return bool
     */
    public function ifEmptyArr($arr)
    {
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
        if (empty($field)) return "Please enter your Name";
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Name must only contain latin characters";
        if (strlen($field) > 40) return "Your name cannot exceed 40 characters";
        return '';
    }

    /**
     * @param $field
     * @return string
     */
    public function validateLastname($field)
    {
        if (empty($field)) return "Please enter your Lastname";
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Lastname must only contain latin characters";
        if (strlen($field) > 40) return "Your lastname cannot exceed 40 characters";
        return '';
    }


    /**
     * @param $field
     * @param null $userModel
     * @return string
     */
    public function validateEmail($field, &$userModel = null)
    {
        if (empty($field)) return "Please enter Your Email";
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";
        if ($userModel !== null) {
            if ($userModel->findUserByEmail($field)) return 'Email is already taken';
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
        if (empty($field)) return "Please enter Your Email";
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";
        if (!$authModel->findUserByEmail($field)) return 'Email not found';
        return '';
    }

    /**
     * @param $passField
     * @param $min
     * @param $max
     * @return string
     */
    public function validatePassword($passField, $min, $max)
    {
        if (empty($passField)) return "Please enter a password";
        $this->password = $passField;
        if (strlen($passField) < $min) return "Password must be more than $min characters length";
        if (strlen($passField) > $max) return "Password must be less than $max characters length";
        return '';
    }

    /**
     * @param $repeatField
     * @return string
     */
    public function confirmPassword($repeatField)
    {
        if (empty($repeatField)) return "Please repeat a password";
        if (!$this->password) return 'no password saved';
        if ($repeatField !== $this->password) return "Password must match";
        return '';
    }

    /**
     * @param $field
     * @return string
     */
    public function validateComment($field)
    {
        if (empty($field)) return "Please enter Your Comment";
        if (strlen($field) > 500) return "Your comment cannot exceed 500 characters";
    }
}
