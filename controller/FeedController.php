<?php

require_once("model/SocialNetworkDB.php");
require_once("ViewHelper.php");
require_once("index.php");


/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

class FeedController {

    public static function index($likes = "") {        
        ViewHelper::render("view/feed.php", ["posts" => SocialNetworkDB::getAllFeedPost(), "likes" => $likes]);
        
    }

   

    public static function signIn() {
        if (SocialNetworkDB::signInUser($_POST["inputEmail"], $_POST["inputPassword"])) {
            session_destroy();
            session_start();
            $_SESSION["userEmail"] = $_POST["inputEmail"];
            $_SESSION["userId"] = SocialNetworkDB::getUserIdFromEmail($_POST["inputEmail"]);
            $_SESSION["fullName"] = SocialNetworkDB::getUserName($_POST["inputEmail"]);
            self::index();
        }else{
            ViewHelper::render("view/login.php", ["errorMessage" => "Invalid username or password."]);
        }
    }
    public static function logout(){
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userId"]);
        unset($_SESSION["fullName"]);
        session_destroy();
        self::index();
        
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
        
            
            
        if ($validData) {
            $userExist = SocialNetworkDB::checkIfUsernameExist($_POST["inputEmail"]);
            $passwordEqual = $_POST["inputPassword"] == $_POST["inputPasswordRepeat"];
            
            
            if ($userExist && $passwordEqual) {
                // insert into users new user
                SocialNetworkDB::signUpUser($_POST["inputEmail"], $_POST["inputFullName"], $_POST["inputPassword"]);
                // logiran
            
                $_SESSION["userEmail"] = $_POST["inputEmail"];
                $_SESSION["userId"] = SocialNetworkDB::getUserIdFromEmail($_POST["inputEmail"]);
                $_SESSION["fullName"] = SocialNetworkDB::getUserName($_POST["inputEmail"]);
                ViewHelper::render("view/feed.php", ["posts" => SocialNetworkDB::getAllFeedPost()]);
            }
            else{
                if ($userExist) {
                    ViewHelper::render("view/register.php", ["errorMessage" => "User alredy exist"]);
                }
                else if (!$passwordEqual) {
                    ViewHelper::render("view/register.php", ["errorMessage" => "Password are not equal"]);
                }
                
            }
        }else{
            ViewHelper::render("view/register.php");
        }

    }
    
    public static function getPhoto() {
        $postId = $_POST["post_id"];
        $img = $_POST["media"];
        $userId = $_POST["user_id"];
        //$userId = $_POST["user_id"];
        var_dump($img);
        $vars = [
            "img" => $img
        ];
        
        ViewHelper::render("view/model.php", $vars);
        
    }
    public static function likePost(){
        // get user
        $userId = $_SESSION["userId"]["user_id"];
        $postId = $_POST["post_id"];
        // add like to database
        SocialNetworkDB::likePost($userId, $postId);
        self::index();

    }

    public static function deletePost(){
        $post_id = $_POST["select-to-delete"];
        SocialNetworkDB::deletePostWithPostId((int) $post_id);
        self::profile();

    }


    public static function showLikes(){
        $post_id = $_GET["postId"];
        $user_id = $_SESSION["userId"]["user_id"];
        $likes = SocialNetworkDB::getLikeFromPostId($post_id, $user_id);

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($likes);
        
        
    }

   
    

    

    
}