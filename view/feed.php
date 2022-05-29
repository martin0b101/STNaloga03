

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/1944e29fed.js" crossorigin="anonymous"></script>
    <!-- js
    <script src="script-feed.js"></script> -->
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
                <?php if ($_SESSION["userEmail"]):?>
                    <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL . "feed/add"?>">
                                <!-- add post -->
                                <i class="fa-solid fa-circle-plus fa-xl"></i>
                            </a>
                        </li>
                    <?php else:?>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="<?= BASE_URL . "feed/add"?>">
                                <!-- add post -->
                                <i class="fa-solid fa-circle-plus fa-xl"></i>
                            </a>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . "feed"?>">
                        <!-- home -->
                            <i class="fa-solid fa-house fa-xl"></i>
                        </a></li>
                    <li class="nav-item">
                        
                        <?php if (isset($_SESSION['userEmail'])): ?>
                            <div class="btn-group">
                                <a href="<?= BASE_URL . "feed/profile"?>" ><button type="button" class="btn btn-secondary">Profile</button></a>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= BASE_URL . "feed/logout"?>">Log out</a></li>
                                </ul>
                            </div>
                            
                        <?php else: ?>
                        <a class="nav-link" href="<?= BASE_URL . "feed/profile"?>">Profile</a>
                        <?php endif; ?>
                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 p-4 bg-light">
    <!-- Gallery -->
    
        <div class="row" id="photoGrid">
            
            <?php foreach ($posts as $post):?>

            <!--just image
                
            
            card-->

            <?php if (isset($_SESSION["userEmail"])) :?>
            <div class="card m-3" style="width: 18rem;">
                <img src="<?="data:image/jpg;charset=utf8;base64," . base64_encode($post["media"])?>" class="card-img-top" alt="<?=$post["description"]?>">
                <div class="card-body">
                    <h5 class="card-title"><?=$post["description"]?></h5>
                </div>
                <div class="card-footer">
                    <form action="<?= BASE_URL . "like"?>" method="post">
                    <button type="submit" name="post_id" value="<?=$post["post_id"];?>" class="btn btn-dark"><i class="fa-regular fa-heart fa-xl"></i></button> 
                    </form>
                    
                    <button data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" type="submit" id="show-likes" value="<?=$post["post_id"]?>" class="btn btn-light mt-2">Show likes</button>
                    
                    <p class="likes"></p>
                </div>
            </div>
            <?php else:?>
                <div class="card m-3" style="width: 18rem;">
                <div class="card-header">Featured</div>
                <img src="<?="data:image/jpg;charset=utf8;base64," . base64_encode($post["media"])?>" class="card-img-top" alt="<?=$post["description"]?>">
                <div class="card-body">
                    <h5 class="card-title"><?=$post["description"]?></h5>
                </div>
                
            </div>
            <?php endif;?>

            <?php endforeach; ?>
        </div>
        <!-- Gallery -->
    </div>





<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>


$(document).ready(function(){
    $(".btn-light").click(function(){
        //console.log($(this).val());
        let button = $(this);
        let url = "<?=BASE_URL?>" + "api/show-likes?postId=" + $(this).val();
        $.getJSON(url, function(data){
            alert(data.likes);
            
        });
    });
            

       
        
});


</script>




</body>
</html>