<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL & E_STRICT);
    $msql = mysqli_connect('localhost', 'root', '', 'products') or die('connection failed');
    session_start();
    $user_id = $_SESSION['user_id'];


    if(!isset($user_id)){
      header('location: ../html files/login.php');
    }


    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($msql, $_POST['name']); 
        $price = mysqli_real_escape_string($msql, $_POST['price']); 
        $a_p = mysqli_real_escape_string($msql, $_POST['about_product']); 
        $image = $_FILES['image']['name'];
        $sm_image1 = $_FILES['sm-image1']['name'];
        $sm_image2 = $_FILES['sm-image2']['name'];
        $sm_image3 = $_FILES['sm-image3']['name'];
        $sm_image4 = $_FILES['sm-image4']['name'];
        $sm_image5 = $_FILES['sm-image5']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        $select = mysqli_query($msql, "SELECT * FROM `product` WHERE `about_product` = '$a_p' AND `price` = '$price'");
        $insert = mysqli_query($msql, "INSERT INTO `product` (`name`, `price`, `about_product`, `image`, `sm-image1`, `sm-image2`, `sm-image3`,`sm-image4`, `sm-image5`)
         VALUES('$name', '$price', '$a_p', '$image', '$sm_image1', '$sm_image2', '$sm_image3', '$sm_image4', '$sm_image5')");
        if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location: ../html files/login.php');
        }
        header('location: ../html files/index.php');
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/adp.css">
    <title>st-store</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="inputBox">
                <h3 style="margin-top: 20px; color: #000; font-size: 25px;">ADD POST</h3>
              <input type="text" name="name" placeholder="product name" class="box" required />
              <input type="text" name="price" placeholder="product price" class="box" required />
              <textarea name="about_product" placeholder="about product" class="box" required ></textarea>
              <input type="file" name="image" class="box" accept="image/*"/>
              <input type="file" name="sm-image1" class="box" accept="image/*"/>
              <input type="file" name="sm-image2" class="box" accept="image/*"/>
              <input type="file" name="sm-image3" class="box" accept="image/*"/>
              <input type="file" name="sm-image4" class="box" accept="image/*"/>
              <input type="file" name="sm-image5" class="box" accept="image/*"/>
              <input type="submit" name="submit" value="CREATE POST">
            </div>
        </form>
    </div>
</body>
</html>