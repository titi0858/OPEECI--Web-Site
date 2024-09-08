<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login');
   exit();
}

if (isset($_POST['update_payment'])) {
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `commande` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'Le statut de paiement a été mis à jour!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   
   // Delete the associated records from commande_element table first
   $delete_order_items = $conn->prepare("DELETE FROM `commande_element` WHERE order_id = ?");
   $delete_order_items->execute([$delete_id]);

   // Now delete the record from commande table
   $delete_order = $conn->prepare("DELETE FROM `commande` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   
   header('location:placed_orders');
   exit(); // Ensure to exit after redirecting the user
}

$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT * FROM `commande`";

if ($status == 'pendings') {
   $sql .= " WHERE payment_status = 'en attente'";
} elseif ($status == 'completes') {
   $sql .= " WHERE payment_status = 'terminé'";
}

if (isset($_POST['search_btn']) && !empty($_POST['search_box'])) {
   $search_term = '%' . $_POST['search_box'] . '%';
   $sql .= ($status ? " AND" : " WHERE") . " command_number LIKE :search_term";
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);

if (isset($search_term)) {
   $stmt->bindParam(':search_term', $search_term);
}

$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/style.css">
   <link rel="icon" href="../images/poulet.png" type="image/png">
</head>
<body>

   <?php include '../components/admin_header.php' ?>

   <h1 style="font-size: 3rem; color: #333; margin-bottom: 40px; text-align: center; padding-top: 20px;">Commandes</h1>

   <!-- search form section starts  -->
   <section class="search-form">
      <form method="post" action="">
         <input type="text" name="search_box" placeholder="Rechercher ici..." class="box">
         <button type="submit" name="search_btn" class="fas fa-search"></button>
      </form>
   </section>
   <!-- search form section ends -->

   <section class="placed-orders">

      <div class="box-container">
         <?php if ($stmt->rowCount() > 0) : ?>
            <?php while ($fetch_orders = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
               <?php
               $select_account = $conn->prepare("SELECT * FROM `etudiant` WHERE id = ?");
               $select_account->execute([$fetch_orders['user_id']]);
               if($select_account->rowCount() > 0){
                  $fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC);
               ?>
               <div class="box">
                  <p>ID utilisateur : <span><?= htmlspecialchars($fetch_orders['user_id']); ?></span></p>
                  <p>Date : <span><?= htmlspecialchars($fetch_orders['placed_on']); ?></span></p>
                  <p>Numéro ticket : <span><?= htmlspecialchars($fetch_orders['command_number']); ?></span></p>
                  <p>Matricule : <span><?= htmlspecialchars($fetch_accounts['matricule']); ?></span> </p>
                  <p>Nom & prénoms : <span><?= htmlspecialchars($fetch_accounts['name']); ?> <?= htmlspecialchars($fetch_accounts['surname']); ?></span></p>
                  <p>Email : <span><?= htmlspecialchars($fetch_accounts['email']); ?></span></p>
                  <p>Numéro : <span>+225 <?= htmlspecialchars($fetch_accounts['number']); ?></span></p>
                  <p>Total plats : <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span></p>
                  <p>Total prix : <span>FCFA <?= htmlspecialchars($fetch_orders['total_price']); ?>/-</span></p>
                  <p>Méthode de paiement : <span><?= htmlspecialchars($fetch_orders['method']); ?></span></p>
                  <form action="" method="POST">
                     <input type="hidden" name="order_id" value="<?= htmlspecialchars($fetch_orders['id']); ?>">
                     <select name="payment_status" class="drop-down" required>
                        <option value="" selected disabled><?= htmlspecialchars($fetch_orders['payment_status']); ?></option>
                        <option value="en attente">En attente</option>
                        <option value="terminé">Terminé</option>
                     </select>
                     <div class="flex-btn">
                        <input type="submit" value="Modifier" class="btn" name="update_payment">
                        <a href="placed_orders?delete=<?= htmlspecialchars($fetch_orders['id']); ?>" class="delete-btn" onclick="return confirm('Supprimer cette commande?');">Supprimer</a>
                     </div>
                  </form>
               </div>
               <?php
               }
               ?>
            <?php endwhile; ?>
         <?php else : ?>
            <p class="empty">Aucune commande trouvée!</p>
         <?php endif; ?>
      </div>

   </section>

   <!-- custom js file link  -->
   <script src="../js/admin_script.js"></script>

</body>
</html>
