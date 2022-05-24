
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/1944e29fed.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container col-8 col-md-6 col-lg-4 mt-5 pt-5">
        <form class="form-signin" action="<?= BASE_URL . "feed/signin"?>" method="post">
            <div class="text-center mb-3">
                <img src="https://cdn3.iconfinder.com/data/icons/glypho-social-and-other-logos/64/logo-share-512.png" alt="" width="72" height="72">
                <h1>Welcome to Sharing</h1>
                <p>Login to continue</p>
            </div>
            <div class="form-label-group mb-3">
                <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            </div>
            <div class="form-label-group mb-3">
                <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required="">
            </div>
            <div class="mx-auto">
                <button class="btn btn-dark btn-block">Sign in</button>
            </div>
        </form>
    </div>
</body>
</html>