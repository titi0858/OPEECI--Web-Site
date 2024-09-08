<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `etudiant` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `commande` WHERE user_id = ?");
   $delete_order->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `panier` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   header('location:users_accounts');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Comptes utilisateur</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="icon" href="../images/poulet.png" type="image/png">


</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- user accounts section starts  -->

<section class="accounts">

   <h1 class="heading">Comptes utilisateur</h1>

   <div class="box-container">

   <?php
      $select_account = $conn->prepare("SELECT * FROM `etudiant`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> id utilisateur : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> matricule : <span><?= $fetch_accounts['matricule']; ?></span> </p>
      <p> nom : <span><?= $fetch_accounts['name']; ?></span> </p>
      <p> prénoms : <span><?= $fetch_accounts['surname']; ?></span> </p>
      <p> email : <span><?= $fetch_accounts['email']; ?></span> </p>
      <p> numéro : <span>+225 <?= $fetch_accounts['number']; ?></span> </p>
      <a href="users_accounts?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Supprimer ce compte ?');">Supprimer</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Aucun compte disponible</p>';
   }
   ?>

   </div>

</section>

<!-- user accounts section ends -->


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>