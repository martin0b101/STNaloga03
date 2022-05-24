<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
     <!-- Latest compiled and minified CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/1944e29fed.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container form-floating">
        <form action="<?= BASE_URL . "feed/add" ?>" method="post" enctype="multipart/form-data">
            <div class="mt-5 pt-5 bg-dark text-white rounded">
                <h5 class="text-center">Add new post</h5>
                <div class="">
                    <input class="form-control p-5" type="file" id="mediaFile" name="mediaFile" >
                </div>
                <div>
                    <textarea class="form-control" name="description" id="postDescription" rows="3"></textarea>
                </div>
                <div>
                    <button class="btn btn-light">Post</button>
                </div>
            </div>
        </form>
    </div>

    
</body>
</html>