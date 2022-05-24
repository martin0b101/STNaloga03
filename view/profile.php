<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/1944e29fed.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sharing</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . "feed/add"?>">
                            <!-- add post -->
                            <i class="fa-solid fa-circle-plus fa-xl"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . "feed"?>">
                        <!-- home -->
                            <i class="fa-solid fa-house fa-xl"></i>
                        </a></li>
                    <li class="nav-item">
                        
                        <?php if (isset($user)): ?>
                            <a class="nav-link" href="<?= BASE_URL . "feed/profile/"?>"><?=$user?></a>
                        <?php endif; ?>
                        <a class="nav-link" href="<?= BASE_URL . "feed/profile/"?>">Profile</a>
                        
                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-2"></div>
    <div class="container mt-5 p-4 bg-dark text-white text-center rounded"><?=$_SESSION["fullName"]["full_name"]?></div>
    <div class="container mt-2 p-4 bg-light">
    <!-- Gallery -->
    
        <div class="row">
        <?php foreach ($posts as $post):?>
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <img
                src="<?="data:image/jpg;charset=utf8;base64," . base64_encode($post["media"])?>"
                class="w-100 shadow-1-strong rounded mb-4"
                alt="<?=$post["description"]?>"
                />
            </div>
            <?php endforeach; ?>
           
        </div>
        <!-- Gallery -->
    </div>

    
</body>
</html>