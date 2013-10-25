<?php
namespace NGS;

abstract class Login
{
    private static $token;
    private static $KEY = null;

    public static function readPassword($string = '') {
        echo $string;

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            system('stty -echo');
            $psw = fgets(STDIN);
            system('stty echo');
        } else {
            if (file_exists(__DIR__.'/FemtoPass.exe'))
                $psw = shell_exec(__DIR__.'/FemtoPass.exe');
            else
                $psw = fgets(STDIN);
        }

        echo PHP_EOL;
        return rtrim($psw, PHP_EOL);
    }

    public static function init()
    {
        self::$KEY = '_dsl_platform_login_' . Project::$ID;

        if (self::$token !== null)
            return self::$token;

        $token = Cache::get(self::$KEY);
        if ($token !== null)
            return self::$token = $token;

        if (PHP_SAPI === 'cli')
            return self::$token = self::fromCLI();

        if (isset($_POST[self::$KEY]))
            return self::setCredentials($_POST['username'], $_POST['password']);

        self::showLoginForm('Please enter your credentials');
    }

    public static function setCredentials($username, $password)
    {
        return self::$token = 'Basic '.base64_encode($username.':'.$password);
    }

    public static function setToken($token)
    {
        if ($token === null) {
            Cache::delete(self::$KEY);
        }
        else {
            Cache::set(self::$KEY, self::$token = $token);
        }

        self::$token = $token;
    }

    public static function logout()
    {
        self::setToken (null);
    }

    public static function getToken()
    {
        return self::$token;
    }

    public static function showLoginForm($error)
    {
        self::logout();
        if (PHP_SAPI !== 'cli') {
            $username = Project::$username;
            if (isset($_POST['username'])) $username = $_POST['username'];
            \Bootstrap::remotePredefinedError('login',  urlencode($username). '/' . urlencode(self::$KEY), false);
            echo ("<pre style=\"color: #990000; margin-top: 30px; font-weight: bold; text-align: center;\">$error</pre>");
            exit(255);
        } else
            echo $error, PHP_EOL;
    }

    public static function fromCLI()
    {
        echo 'Username [' . Project::$username . ']: ';
        $username = rtrim (fgets(STDIN), "\r\n");
        if ($username === '')
            $username = Project::$username;

        $password = self::readPassword('Password: ');

        echo PHP_EOL;
        return self::setCredentials($username, $password);
    }

    public static function inProcess()
    {
        if (PHP_SAPI === 'cli')
            return self::$token === null;

        return array_key_exists(self::$KEY, $_POST) || (
            !array_key_exists('_dsl_platform_confirm_unsafe', $_POST)
            && !array_key_exists('_dsl_platform_ignore_diff', $_POST)
            && !array_key_exists('_dsl_platform_confirm_diff', $_POST)
        );
    }

    public static function needReload()
    {
       return Config::$html && (array_key_exists(self::$KEY, $_POST)
                || array_key_exists('_dsl_platform_confirm_unsafe', $_POST)
                || array_key_exists('_dsl_platform_ignore_diff', $_POST)
                || array_key_exists('_dsl_platform_confirm_diff', $_POST)
       );
    }
}
