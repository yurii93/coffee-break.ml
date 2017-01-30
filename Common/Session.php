<?php

namespace Common;

abstract class Session
{
    /*
     * Set session value by key
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /*
     * Read session value by key
     */
    public static function get($key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    /*
     * Checks is session exists
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /*
     * Delete session by key
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /*
     * Delete all sessions
     */
    public static function destroy()
    {
        session_destroy();
    }
}