<?php

session_start();

require_once("controller/FeedController.php");
require_once("controller/StoreController.php");



define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
//define("ASSETS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "assets/");
$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "feed" => function () {
        FeedController::index();
    },
    "feed/signin" => function () {
        FeedController::signIn();
    },
    "feed/register" => function () {
        FeedController::signUp();
    },
    "feed/profile" => function () {
        FeedController::profile();
    },
    "feed/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            
            FeedController::addForm();
        }else{
            FeedController::add();
        }
        
    },
    "feed/logout" => function () {
        FeedController::logout();
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "feed");
    },
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
} 
