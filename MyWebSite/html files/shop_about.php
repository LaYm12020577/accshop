<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL & E_STRICT);
    $db = mysqli_connect('localhost', 'root', '', 'products') or header('location: ../html files/shop.html');
    $info = mysqli_query($db, "SELECT `id`, `name`, `price`, `image`, `about_product`, `sm-image1`, `sm-image2`, `sm-image3`, `sm-image4`, `sm-image5` FROM `product` WHERE 1");

    if(mysqli_num_rows($info) > 0){
        $right = mysqli_fetch_assoc($info);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/pa.css">
    <title>st-store</title>
</head>
<body>
    <div class="container">
        <div class="col">
            <div class="data">
                <img src="../imgs/<?php echo $right['image'];?>" class="main_img">
                    <div class="texts">
                        <div class="name_price" style="margin-bottom: 20px;">
                            <h1 style="margin-bottom: 10px; text-transform: uppercase;"><?php echo $right['name'];?></h1>
                            <b class="price">$<?php echo $right['price']; ?></b>
                            <p style="margin-bottom: 10px; margin-top: 10px;"><?php echo $right['about_product'];?></p>
                         </div>
                        <input type="button" value="BUY" class="button">
                        <input type="button" value="TO CART" class="button">
                        <div class="small_imgs">
                            <img src="../imgs/<?php echo $right['sm-image1'];?>">
                            <img src="../imgs/<?php echo $right['sm-image2'];?>">
                            <img src="../imgs/<?php echo $right['sm-image3'];?>">
                            <img src="../imgs/<?php echo $right['sm-image4'];?>">
                            <img src="../imgs/<?php echo $right['sm-image5'];?>">
                        </div>
                    </div>

            </div>
        </div>
    </div>
</body>
</html>