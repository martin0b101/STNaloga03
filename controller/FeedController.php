<?php

require_once("model/SocialNetworkDB.php");
require_once("ViewHelper.php");
require_once("index.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class FeedController {

    public static function index() {
        
        ViewHelper::render("view/feed.php", ["posts" => SocialNetworkDB::getAllFeedPost()]);
        
    }

   

    public static function signIn() {
        if (SocialNetworkDB::signInUser($_POST["inputEmail"], $_POST["inputPassword"])) {
            session_start();
            $_SESSION["userEmail"] = $_POST["inputEmail"];
            $_SESSION["userId"] = SocialNetworkDB::getUserIdFromEmail($_POST["inputEmail"]);
            $_SESSION["fullName"] = SocialNetworkDB::getUserName($_POST["inputEmail"]);
            ViewHelper::render("view/feed.php", ["posts" => SocialNetworkDB::getAllFeedPost()]);
        }else{
            ViewHelper::render("view/login.php");
        }
    }
    public static function logout(){
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userId"]);
        unset($_SESSION["fullName"]);
        session_destroy();
        ViewHelper::render("view/feed.php", ["posts" => SocialNetworkDB::getAllFeedPost()]);
        
    }


    public static function profile() {
        if (isset($_SESSION['userEmail'])) {
            ViewHelper::render("view/profile.php", ["posts" => SocialNetworkDB::getAllPostFromUser((int) $_SESSION["userId"]["user_id"])]);
            # code...
        } else {
            ViewHelper::render("view/login.php");
        }
    }
    public static function addForm() {
        ViewHelper::render("view/add.php");
    }

    public static function add() {
        $validData = !empty($_FILES["mediaFile"]) && isset($_POST["description"]) && !empty($_POST["description"]);
        
        if ($validData) {
            // get user id $_SESSION["id"] pomoje neki takega
            $media = $_FILES['mediaFile']['tmp_name'];
            $imageContent = file_get_contents($media);
            
            SocialNetworkDB::insert($imageContent, $_POST["description"], (int) $_SESSION["userId"]["user_id"]);
            ViewHelper::redirect(BASE_URL . "feed");
        }else{
            ViewHelper::render("view/add.php");
        }
    }

    public static function signUp() {
        $validData = isset($_POST["inputEmail"]) && !empty($_POST["inputEmail"]) &&
            isset($_POST["inputFullName"]) && !empty($_POST["inputFullName"]) &&
            isset($_POST["inputPassword"]) && !empty($_POST["inputPassword"]) &&
            isset($_POST["inputPasswordRepeat"]) && !empty($_POST["inputPasswordRepeat"]);
        
        $passwordEqual = $_POST["inputPassword"] == $_POST["inputPasswordRepeat"];
        
        $userExist = SocialNetworkDB::checkIfUsernameExist($_POST["inputEmail"]);
        //var_dump(filter_val($_POST["inputEmail"], FILTER_VALIDATE_EMAIL));
        if ($validData && $passwordEqual  && $userExist == 0) {
            // insert into users new user
            SocialNetworkDB::signUpUser($_POST["inputEmail"], $_POST["inputFullName"], $_POST["inputPassword"]);
            // logiran
            $_SESSION["user"] = $_POST["inputEmail"];
            ViewHelper::redirect(BASE_URL . "feed");
        }else{
            ViewHelper::render("view/register.php");
        }

    }

    

    

    
}