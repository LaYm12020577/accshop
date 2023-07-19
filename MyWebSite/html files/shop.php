<?php
  ini_set("display_errors", 1);
  error_reporting(E_ALL & E_STRICT);
  session_start();
  $user_id = $_SESSION['user_id'];
  $db = mysqli_connect('localhost', 'root', '', 'products') or die('connection failed');
  $select = mysqli_query($db, "SELECT * FROM `product`");

  if(isset($_GET['shop_cart'])){
    header('location: ../html files/shop_about.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/shop.css" />
    <title>st-store</title>
  </head>
  <body>
    <div class="container">
      <div class="header">
    </div>
</div>
<section class="main">
    <h1 class="main-title">SHOP PAGE</h1>
    <div class="col">
    <?php
            while($info = mysqli_fetch_assoc($select)){?>
            <div class="elements">
                <img src="uploaded_img/<?php echo $info['image']  ?>">
                <h2 class="prixe">$<?php echo $info['price'] ?></h2>
                <a href="../html files/shop_about.php">PREVIEW</a>
                <a href="#">ADD TO CART</a>
            </div>
            <?php } ?>
      </div>
    </section>
  </body>
</html>
