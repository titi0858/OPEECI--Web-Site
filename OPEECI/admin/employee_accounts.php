<?php

include '../components/connect.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login');
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_employee = $conn->prepare("DELETE FROM `employee` WHERE id = ?");
   $delete_employee->execute([$delete_id]);
   header('location:employee_accounts');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Compte employés</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/employee_style.css">
   <link rel="icon" href="../images/poulet.png" type="image/png">


</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- employees accounts section starts  -->

   <section class="accounts">

      <h1 class="heading">Compte employés</h1>

      <div class="box-container">

         <div class="box">
            <p>Nouvel employé</p>
            <a href="register_employee" class="option-btn">Inscription</a>
         </div>

         <?php
         $select_account = $conn->prepare("SELECT * FROM `employee`");
         $select_account->execute();
         if ($select_account->rowCount() > 0) {
            while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> id employé : <span><?= $fetch_accounts['id']; ?></span> </p>
                  <p> utilisateur : <span><?= $fetch_accounts['name']; ?></span> </p>
                  <div class="flex-btn">
                     <a href="employee_accounts?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Supprimer ce compte?');">Supprimer</a>
                     <a href="update_profile_emp?id=<?= $fetch_accounts['id']; ?>" class="option-btn">Modifier</a>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Pas de compte disponible</p>';
         }
         ?>

      </div>

   </section>

   <!-- employees accounts section ends -->


   <!-- custom js file link  -->
   <script src="../js/employee_script.js"></script>

</body>

</html>