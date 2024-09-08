<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `repas` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'nom de plat déjà existant!';
   }else{
      if($image_size > 2000000){
         $message[] = 'Image trop volumineux';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `repas`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'Nouveau plat ajouté!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `repas` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `repas` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `panier` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products');

}

if(isset($_GET['toggle_visibility'])){

   $toggle_id = $_GET['toggle_visibility'];
   $toggle_product_visibility = $conn->prepare("UPDATE `repas` SET visibility = NOT visibility WHERE id = ?");
   $toggle_product_visibility->execute([$toggle_id]);
   header('location:products');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plats</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="icon" href="../images/poulet.png" type="image/png">


</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Création de plat</h3>
      <input type="text" required placeholder="nom du plat*" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="prix*" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>Choisir catégorie --*</option>
         <option value="plats principaux">Plats principaux</option>
         <option value="Fast food">Fast food</option>
         <option value="Boissons">Boissons</option>
         <option value="Desserts">Desserts</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="ajouter plat" name="add_product" class="btn">
   </form>

   <!-- Bouton pour être dirigé vers menu.php -->
   <button onclick="window.location.href='add_menu'" class="btn">Créer un menu</button>
</section>


</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `repas`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){
   ?>
<div class="box">
    <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
    <div class="flex">
        <div class="price"><span>FCFA </span><?= $fetch_products['price']; ?><span>/-</span></div>
        <div class="category"><?= $fetch_products['category']; ?></div>
    </div>
    <div class="name"><?= $fetch_products['name']; ?></div>
    <div class="flex-btn" style="text-align: center;">
        <a href="products?toggle_visibility=<?= $fetch_products['id']; ?>" class="option-btn" style="max-width: 110px; text-align: center; padding-left: 13px;"><?= $fetch_products['visibility'] ? 'Masquer' : 'Afficher'; ?> </a>
        <a href="update_product?update=<?= $fetch_products['id']; ?>" class="option-btn" style="max-width: 110px; text-align: center; padding-left: 15px;">Modifier</a>
        <a href="products?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Supprimer ce plat ?');" style="max-width: 40px; text-align: center; padding-left: 16px;"><i class="fas fa-times" style="color: black;"></i></a>
    </div>
</div>


   <?php
         }
      }else{
         echo '<p class="empty">Aucun plat disponible !</p>';
      }
   ?>

   </div>

</section>




<!-- show products section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
