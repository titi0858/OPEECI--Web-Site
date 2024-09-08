<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->

   <link rel="stylesheet" href="../css/admin_style.css">
      <link rel="icon" href="../images/poulet.png" type="image/png">



</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- admin dashboard section starts  -->

   <section class="dashboard">

      <h1 class="heading">Tableau de bord</h1>

      <div class="box-container">

         <div class="box">
            <h3>Bienvenue!</h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile" class="btn">Modifier profile</a>
         </div>

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `commande` WHERE payment_status = ?");
            $select_pendings->execute(['en attente']);
            while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
               $total_pendings += $fetch_pendings['total_price'];
            }
            ?>
            <h3><span>FCFA </span><?= $total_pendings; ?><span>/-</span></h3>
            <p>Total en attente</p>
            <a href="placed_orders?status=pendings" class="btn">attente</a>
         </div>

         <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `commande` WHERE payment_status = ?");
            $select_completes->execute(['terminé']);
            while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
               $total_completes += $fetch_completes['total_price'];
            }
            ?>
            <h3><span>FCFA </span><?= $total_completes; ?><span>/-</span></h3>
            <p>Total terminé</p>
            <a href="placed_orders?status=completes" class="btn">terminés</a>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `commande`");
            $select_orders->execute();
            $numbers_of_orders = $select_orders->rowCount();
            ?>
            <h3><?= $numbers_of_orders; ?></h3>
            <p>Total commandes</p>
            <a href="placed_orders" class="btn">commandes</a>
         </div>

         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `repas`");
            $select_products->execute();
            $numbers_of_products = $select_products->rowCount();
            ?>
            <h3><?= $numbers_of_products; ?></h3>
            <p>Plat ajouté</p>
            <a href="products" class="btn">Voir plats</a>
         </div>

         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `etudiant`");
            $select_users->execute();
            $numbers_of_users = $select_users->rowCount();
            ?>
            <h3><?= $numbers_of_users; ?></h3>
            <p>Compte utilisateurs</p>
            <a href="users_accounts" class="btn">Voir utilisateurs</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admin`");
            $select_admins->execute();
            $numbers_of_admins = $select_admins->rowCount();
            ?>
            <h3><?= $numbers_of_admins; ?></h3>
            <p>Administrateur</p>
            <a href="admin_accounts" class="btn">Voir administrateurs</a>
         </div>

         <div class="box">
            <?php
            $select_employees = $conn->prepare("SELECT * FROM `employee`");
            $select_employees->execute();
            $numbers_of_employees = $select_employees->rowCount();
            ?>
            <h3><?= $numbers_of_employees; ?></h3>
            <p>Employé</p>
            <a href="employee_accounts" class="btn">Voir employés</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $numbers_of_messages = $select_messages->rowCount();
            ?>
            <h3><?= $numbers_of_messages; ?></h3>
            <p>Nouveau messages</p>
            <a href="messages" class="btn">Voir messages</a>
         </div>

      </div>

   </section>

   <!-- admin dashboard section ends -->


   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>

</html>