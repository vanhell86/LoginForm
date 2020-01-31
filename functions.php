<?php

use Core\Database;
use Core\Managers\AuthManager\AuthManager;
use Core\Managers\AuthManager\AuthManagerInterface;
use Core\Managers\ErrorManager\ErrorsManager;
use Core\Managers\ErrorManager\SessionErrorInterface;
use Core\Managers\FlashMessageManager\FlashMessage;
use Core\Managers\FlashMessageManager\FlashMessageInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


function dd($value)
{
    var_dump($value);
    die;
}

function view(string $path, array $vars = [])           //for getting necessary php file
{
    extract($vars);
    include(__DIR__ . '/app/Views/' . $path . '.php');
}

function redirect(string $location)             // redirecting helper function
{
    header('Location: ' . $location);
    exit;
}

function config(string $key, string $defaultValue = ''): string             // for getting necessary values from config files
{
    $defaultValue = !empty($defaultValue) ? $defaultValue : $key;
    [$fileName, $configKey] = explode('.', $key, 2);
    $config = include __DIR__ . '/config/' . $fileName . '.php';

    return $config[$configKey] ?? $defaultValue;
}

function database()             //returning Database instance
{
    return Database::$instance->connection();
}

function auth(): AuthManagerInterface
{
    return AuthManager::get();
}

function selectDataByEmail(string $email)   // getting data from DB by email
{
    return database()->get('users', ['id', 'name', 'email', 'password', 'token', 'tokenExpire'], ['email' => $email]);
}

function flashMessage(): FlashMessageInterface
{
    return FlashMessage::get();
}

function generateToken()        //generating ranoom token
{
    return bin2hex(random_bytes(20));

}

function sendMail(string $to, string $token = null, bool $welcome = false)
{
    $userInfo = selectDataByEmail($to);
    $mail = new PHPMailer(true);
    try {
        $mail->setFrom('MyPage@mypage.com');
    } catch (Exception $e) {
    }

    try {
        $mail->AddAddress($to);
    } catch (Exception $e) {
    }
    $mail->WordWrap = 70;

    if ($welcome) {
        $mail->Subject = "Welcome to MyPage";
        $mail->Body = "
        Hello {$userInfo['name']}!<br><br>
        
        Welcome to MyPage.com<br><br>
        
        Kind regards,<br>
        Maris    
    
    ";
    } else {
        $mail->Subject = "Reset Password";
        $mail->Body = "
        Hello {$userInfo['name']}!<br><br>
        
        In order to reset your password, please click on link below:<br>
        <a href='http://localhost:8000/auth/reset/$token'> http://localhost:8000/auth/reset/$token</a><br><br>
        
        Kind regards,<br>
        Maris    
    
    ";
    }

    $mail->IsHTML(TRUE);
    try {
        $mail->send();

    } catch (Exception $e) {

    }
}

function checkPasswStrength(string $password)   // for validating password
{
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    return (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8);
}