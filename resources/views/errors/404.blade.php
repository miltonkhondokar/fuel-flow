<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>404 Page Not Found</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style type="text/css">
    /*======================
        404 page
    =======================*/

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f8fa;
    }

    .page_404 {
        padding: 40px 0;
        background: #fff;
    }

    .page_404 img {
        width: 100%;
    }

    .four_zero_four_bg {
        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        height: 400px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

    .four_zero_four_bg h1 {
        font-size: 100px;
        font-weight: 700;
        color: #39ac31;
        margin-top: 30px;
    }

    .contant_box_404 {
        margin-top: -50px;
    }

    .contant_box_404 h3 {
        font-size: 30px;
        font-weight: 600;
        color: #333;
    }

    .contant_box_404 p {
        font-size: 16px;
        color: #777;
    }

    .link_404 {
        color: #fff !important;
        padding: 10px 25px;
        background: #39ac31;
        margin: 20px 0;
        display: inline-block;
        border-radius: 5px;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 16px;
    }

    .link_404:hover {
        background: #2c7a24;
        text-decoration: none;
    }

    .btn-go-back {
        cursor: pointer;
    }

  </style>
</head>
<body>

<!-- 404 Page -->
<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-10 col-sm-offset-1 text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center">404</h1>
                    </div>

                    <div class="contant_box_404">
                        <h3 class="h2">Looks like you're lost</h3>
                        <p>The page you are looking for is not available!</p>
                        <a class="link_404 btn-go-back" onclick="goBack()">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
