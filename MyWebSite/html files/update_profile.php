<?php
ini_set("display_errors", 1);
          error_reporting(E_ALL & E_STRICT);
include '../dbFiles/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_GET['gob'])){
  header('location: ../html files/profile.php');
}

if(isset($_POST['update_profile'])){

  $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
  $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

  mysqli_query($conn, "UPDATE `users` SET `name` = '$update_name', `email` = '$update_email' WHERE id = '$user_id'") or die('query failed');

  $old_pass = $_POST['old_pass'];
  $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
  $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
  $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

  if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
    if($update_pass != $old_pass){
      $message[] = 'old password not matched!';
    } elseif($new_pass != $confirm_pass){
        $message[] = 'Confirmed password does not match!';
      }else{
        mysqli_query($conn, "UPDATE `users` SET `password` = '$update_pass' WHERE id = '$user_id'") or die('query failed');
        $message[] = 'password updated successfully!';
      }
  }

  $update_image = $_FILES['update_image']['name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_folder = 'uploaded_img/'.$image;

  if(!empty($update_image)){
    if($update_image_size > 2000000){
      $message[] = 'image too large for profile!';
    } else{
     $image_update_query = mysqli_query($conn, "UPDATE `users` SET `image` = '$update_image' WHERE id = '$user_id'") or die('query failed');
      if($image_update_query){
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
      }
     $message[] = 'image updated successfully!';
    }
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>st:store</title>
    <link rel="stylesheet" href="../styles/upp.css">
</head>
<body style="background-color: #4dc00b;">
    <div class="update-profile">
        <?php
          ini_set("display_errors", 1);
          error_reporting(E_ALL & E_STRICT);
          $select = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
          }

         
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            
              <?php
                if($fetch['image'] == ''){
                  echo '<img src="../imgs/pacient-icon.png">';
                } else{
                  echo '<img src="../imgs/'.$fetch['image'].'">';
                }

                if(isset($message)){
                  foreach($message as $message){
                      echo '<div class="message">'.$message.'</div>';
                  }
                }
              ?>
               <div class="flex">
              <div class="inputBox">
                <span>username :</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']?>" class="box">
                <span>email :</span>
                <input type="text" name="update_email" value="<?php echo $fetch['email']?>" class="box">
                <span>update your picture :</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
              </div>
            
            <div class="inputBox">
              <input type="hidden" name="old_pass" value="<?php echo $fetch['password']?>">
              <span>old password</span>
              <input type="password" name="update_pass" placeholder="enter previous password" class="box">

              <input type="hidden" name="old_name" value="<?php echo $fetch['password']?>">
              <span>new password</span>
              <input type="password" name="new_pass" placeholder="enter new password" class="box">

              <input type="hidden" name="old_name" value="<?php echo $fetch['password']?>">
              <span>confirm password</span>
              <input type="password" name="confirm_pass" placeholder="confirm password" class="box">
            </div>
          </div>
          <input type="submit" value="Update Profile" name="update_profile" class=".btn">
          <!-- <a class="delete-btn" href="../html files/update_profile.php?gob=<?php echo $user_id; ?>">Back</a> -->
          <button class="delete-btn"><a href="../html files/update_profile.php?gob=<?php echo $user_id; ?>">BACK</a></button>
            
        </form>
    </div>
</body>
</html>