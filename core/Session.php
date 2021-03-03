<?php


namespace app\core;


/**
 * Class Session
 * @package app\core
 */
class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Checks if user is logged in.
     * @return bool
     */
    public static function isUserLoggedIn(): bool
    {
        if (isset($_SESSION['user_id'])) return true;

        return false;
    }
}