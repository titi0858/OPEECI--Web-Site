<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login');
}

// Vérifiez si l'identifiant de l'employé est passé dans l'URL
if(isset($_GET['id'])) {
   $employee_id = $_GET['id'];

   $select_employee = $conn->prepare("SELECT name FROM `employee` WHERE id = ?");
   $select_employee->execute([$employee_id]);
   $employee_data = $select_employee->fetch(PDO::FETCH_ASSOC);
   $current_username = $employee_data['name'];

   // Traitez la mise à jour du profil de l'employé avec l'identifiant récupéré
   if(isset($_POST['submit'])){

      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
   
      if(!empty($name)){
         $select_name = $conn->prepare("SELECT * FROM `employee` WHERE name = ?");
         $select_name->execute([$name]);
         if($select_name->rowCount() > 0){
            $message[] = "Nom d'utilisateur déjà utilisé!";
         }else{
            $update_name = $conn->prepare("UPDATE `employee` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $employee_id]);
         }
      }
   
      $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
      $select_old_pass = $conn->prepare("SELECT password FROM `employee` WHERE id = ?");
      $select_old_pass->execute([$employee_id]);
      $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
      $prev_pass = $fetch_prev_pass['password'];
      $old_pass = sha1($_POST['old_pass']);
      $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
      $new_pass = sha1($_POST['new_pass']);
      $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
      $confirm_pass = sha1($_POST['confirm_pass']);
      $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
   
      if($old_pass != $empty_pass){
         if($old_pass != $prev_pass){
            $message[] = 'Mot de passe incorrect!';
         }elseif($new_pass != $confirm_pass){
            $message[] = 'Mot de passe de confirmation incorrect!';
         }else{
            if($new_pass != $empty_pass){
               $update_pass = $conn->prepare("UPDATE `employee` SET password = ? WHERE id = ?");
               $update_pass->execute([$confirm_pass, $employee_id]);
               $message[] = 'Mot de passe mis a jour avec success!';
            }else{
               $message[] = 'Entrer un nouveau mot de passe!';
            }
         }
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
   <title>profile update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/employee_style.css">
   <link rel="icon" href="../images/poulet.png" type="image/png">


</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- employee profile update section starts  -->

<section class="form-container">

   <form action="" method="POST">
      <h3>Modifier profile</h3>
      <input type="text" name="name" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= $current_username ?>">
      <input type="password" name="old_pass" maxlength="20" placeholder="Ancien mot de passe" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" maxlength="20" placeholder="Nouveau mot de passe" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" maxlength="20" placeholder="confirmer mot de passe" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Enregistrer" name="submit" class="btn">
   </form>

</section>

<!-- employee profile update section ends -->


<!-- custom js file link  -->
<script src="../js/employee_script.js"></script>

</body>
</html>
