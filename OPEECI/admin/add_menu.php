<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

// Logique de suppression
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM menu_element WHERE product_id = ?");
    $stmt->execute([$delete_id]);
    header('location:' . basename(__FILE__));
    exit();
}

// Initialiser le message d'erreur
$message = '';

// Vérifier si le formulaire a été soumis pour ajouter un nouveau menu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_menu'])) {
    // Récupérer les données du formulaire
    $date = $_POST['menu_date'];
    $name = $_POST['menu_name'];
    $visibility = $_POST['visibility']; // Ajout de la visibilité
    $repas = $_POST['product'];
    $quantities = $_POST['quantity'];

    // Vérifier si la date est antérieure à aujourd'hui
    if ($date < date('Y-m-d')) {
        $message = "La date du menu ne peut pas être antérieure à aujourd'hui !";
    } else {
        // Insérer le menu dans la table 'menus'
        $stmt = $conn->prepare("INSERT INTO menus (date, name, visibility) VALUES (?, ?, ?)");
        $stmt->execute([$date, $name, $visibility]);
        $menu_id = $conn->lastInsertId(); // Récupérer l'ID du dernier menu inséré

        $unique_repas = [];
        for ($i = 0; $i < count($repas); $i++) {
            $product_id = $repas[$i];
            if (!in_array($product_id, $unique_repas)) {
                $unique_repas[] = $product_id;
                $quantity = $quantities[$i];
                $stmt = $conn->prepare("INSERT INTO menu_element (menu_id, product_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$menu_id, $product_id, $quantity]);
            } else {
                $message = "Le plat ID $product_id a été ignoré car il est en double.";
            }
        }
    }

    // Rediriger vers la page actuelle pour éviter la soumission multiple
    header('location:' . basename(__FILE__));
    exit();
}

// Vérifier si le formulaire a été soumis pour ajouter un plat à un menu existant
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product_to_menu'])) {
    $menu_id = $_POST['menu_id'];
    $product_id = $_POST['product'];
    $quantity = $_POST['quantity'];

    // Vérifier si le plat existe déjà dans le menu
    $stmt = $conn->prepare("SELECT * FROM menu_element WHERE menu_id = ? AND product_id = ?");
    $stmt->execute([$menu_id, $product_id]);
    if ($stmt->rowCount() > 0) {
        // Le plat existe déjà dans le menu
        $message = "Ce plat est déjà ajouté au menu.";
    } else {
        // Insérer le nouvel élément de menu dans la table 'menu_element'
        $stmt = $conn->prepare("INSERT INTO menu_element (menu_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$menu_id, $product_id, $quantity]);
    }

    // Rediriger vers la page actuelle pour éviter la soumission multiple
    header('location:' . basename(__FILE__));
    exit();
}

// Vérifier si le formulaire pour supprimer un menu a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_menu'])) {
    $menu_id = $_POST['menu_id'];
    // Supprimer les éléments de menu associés à ce menu
    $stmt = $conn->prepare("DELETE FROM menu_element WHERE menu_id = ?");
    $stmt->execute([$menu_id]);
    // Supprimer le menu lui-même
    $stmt = $conn->prepare("DELETE FROM menus WHERE id = ?");
    $stmt->execute([$menu_id]);
    // Rediriger vers la page actuelle pour éviter la soumission multiple
    header('location:' . basename(__FILE__));
    exit();
}

// Vérifier si le formulaire pour mettre à jour la quantité d'un plat dans un menu a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $menu_id = $_POST['menu_id'];
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];

    // Mettre à jour la quantité du plat dans la table 'menu_element'
    $stmt = $conn->prepare("UPDATE menu_element SET quantity = ? WHERE menu_id = ? AND product_id = ?");
    $stmt->execute([$new_quantity, $menu_id, $product_id]);

    // Rediriger vers la page actuelle pour éviter la soumission multiple
    header('location:' . basename(__FILE__));
    exit();
}

// Vérifier si le formulaire pour activer ou désactiver la visibilité d'un menu a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_visibility'])) {
    $menu_id = $_POST['menu_id'];
    
    //
// Récupérer l'état de visibilité actuel du menu sélectionné
$stmt_visibility = $conn->prepare("SELECT visibility FROM menus WHERE id = ?");
$stmt_visibility->execute([$menu_id]);
$visibility = $stmt_visibility->fetchColumn();

// Si le menu est déjà visible, on le rend non visible
// Sinon, on le rend visible et on rend tous les autres menus non visibles
if ($visibility == 1) {
    $stmt = $conn->prepare("UPDATE menus SET visibility = 0 WHERE id = ?");
    $stmt->execute([$menu_id]);
} else {
    // Désactiver la visibilité de tous les autres menus
    $stmt_disable_visibility = $conn->prepare("UPDATE menus SET visibility = 0 WHERE id != ?");
    $stmt_disable_visibility->execute([$menu_id]);

    // Activer la visibilité du menu sélectionné
    $stmt = $conn->prepare("UPDATE menus SET visibility = 1 WHERE id = ?");
    $stmt->execute([$menu_id]);
}

// Rediriger vers la page actuelle pour éviter la soumission multiple
header('location:' . basename(__FILE__));
exit();
}

// Récupérer la liste des plats disponibles et visibles
$repas = $conn->prepare("SELECT * FROM repas WHERE visibility = 1");
$repas->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un menu</title>
    <!-- Vos liens CSS et JavaScript -->
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="icon" href="../images/poulet.png" type="image/png">
    <style>
        .message-banner {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            text-align: center;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>
    <?php if (!empty($message)): ?>
    <div class="message-banner"><?= $message; ?></div>
<?php endif; ?>

<section class="add-products">
    <form action="" method="POST" enctype="multipart/form-data" id="menu-form">
        <h3>Créer menu</h3>
        <input type="date" required name="menu_date" id="menu_date" class="box" min="<?= date('Y-m-d') ?>">
        <input type="text" required placeholder="Nom du menu" name="menu_name" class="box">
        <!-- Ajout du champ de visibilité -->
        <select name="visibility" class="box" required>
            <option value="0">Non visible</option>
            <option value="1">Visible</option>
        </select>
        <div id="menu-items">
            <div class="menu-item">
                <select name="product[]" class="box" required>
                    <option value="" disabled selected>Sélectionner un plat --*</option>
                    <?php
                    while ($row = $repas->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
                <input type="number" min="1" name="quantity[]" required placeholder="Quantité*" class="box">
            </div>
        </div>
        <button type="button" id="add-item-btn" class="btn" >Ajouter un plat au menu</button>
        <input type="submit" value="Créer menu" name="add_menu" class="btn">
    </form>
</section>

<section class="show-products" style="padding-top: 0;">
    <div class="box-container" style="display: flex; flex-wrap: nowrap; overflow-x: auto;">
        <?php
        $show_menus = $conn->prepare("SELECT * FROM `menus`");
        $show_menus->execute();
        if ($show_menus->rowCount() > 0) {
            while ($fetch_menus = $show_menus->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box" style="flex: 0 0 auto; margin-right: 20px;">
                    <h2>Date: <?= $fetch_menus['date']; ?></h2>
                    <h2>Nom du menu: <?= $fetch_menus['name']; ?></h2>
                    <h2>Plats:</h2>
                    <?php
                    $menu_id = $fetch_menus['id'];
                    $show_menu_items = $conn->prepare("SELECT menu_element.quantity, repas.name, repas.price, repas.image, repas.id FROM menu_element INNER JOIN repas ON menu_element.product_id = repas.id WHERE menu_element.menu_id = ?");
                    $show_menu_items->execute([$menu_id]);
                    while  ($fetch_menu_items = $show_menu_items->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="box" style="margin-bottom: 20px;">
                            <img src="../uploaded_img/<?= $fetch_menu_items['image']; ?>" alt="">
                            <div class="flex">
                                <div class="price"><span>FCFA </span><?= $fetch_menu_items['price']; ?><span>/-</span></div>
                                <form action="" method="POST" class="update-quantity-form">
                                    <input type="hidden" name="menu_id" value="<?= $menu_id; ?>">
                                    <input type="hidden" name="product_id" value="<?= $fetch_menu_items['id']; ?>">
                                    <input type="number" min="1" name="new_quantity" value="<?= $fetch_menu_items['quantity']; ?>" required class="box quantity-input">
                                    <input type="submit" value="Mettre à jour" name="update_quantity" class="btn">
                                </form>
                            </div>
                            <div class="name"><?= $fetch_menu_items['name']; ?></div>
                            <div class="flex-btn">
                                <a href="<?= basename(__FILE__) ?>?delete=<?= $fetch_menu_items['id']; ?>" class="delete-btn" onclick="return confirm('Supprimer ce plat ?');">Supprimer</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!-- Formulaire pour ajouter un plat au menu -->
                    <form action="" method="POST" class="add-product-form">
                        <input type="hidden" name="menu_id" value="<?= $menu_id; ?>">
                        <select name="product" class="box" required>
                            <option value="" disabled selected>Sélectionner un plat --*</option>
                            <?php
                            $repas->execute();
                            while ($row = $repas->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="number" min="1" name="quantity" required placeholder="Quantité*" class="box">
                        <input type="submit" value="Ajouter au menu" name="add_product_to_menu" class="btn">
                    </form>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">Aucun menu disponible !</p>';
        }
        ?>
    </div>
</section>

<!-- Formulaire pour supprimer un menu -->
<section class="delete-menu-form">
    <h3>Supprimer un menu</h3>
    <form action="" method="POST">
        <select name="menu_id" class="box" required>
            <option value="" disabled selected>Sélectionner un menu à supprimer --*</option>
            <?php
            $show_menus = $conn->prepare("SELECT * FROM `menus`");
            $show_menus->execute();
            while ($fetch_menus = $show_menus->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $fetch_menus['id'] . '">' . $fetch_menus['name'] . ' - ' . $fetch_menus['date'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Supprimer" name="delete_menu" class="btn delete-btn">
    </form>
</section>
<!-- Formulaire pour activer ou désactiver la visibilité d'un menu -->
<section class="visibility-form">
    <h3>Activer/Désactiver la visibilité d'un menu</h3>
    <form action="" method="POST">
        <select name="menu_id" class="box" required>
            <option value="" disabled selected>Sélectionner un menu --*</option>
            <?php
            $show_menus = $conn->prepare("SELECT * FROM `menus`");
            $show_menus->execute();
            while ($fetch_menus = $show_menus->fetch(PDO::FETCH_ASSOC)) {
                $visibility_label = $fetch_menus['visibility'] == 1 ? 'Visible' : 'Non visible';
                echo '<option value="' . $fetch_menus['id'] . '">' . $fetch_menus['name'] . ' - ' . $fetch_menus['date'] . ' - ' . $visibility_label . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Activer/Désactiver" name="toggle_visibility" class="btn">
    </form>
</section>
<script>
    // Récupérer les produits disponibles pour la boucle JavaScript
    var repas = [
        <?php
        $repas->execute();
        while ($row = $repas->fetch(PDO::FETCH_ASSOC)) {
            echo '{ id: ' . $row['id'] . ', name: "' . $row['name'] . '" },';
        }
        ?>
    ];

    document.getElementById('add-item-btn').addEventListener('click', function () {
        var newItem = document.createElement('div');
        newItem.classList.add('menu-item');
        var selectHTML = '<select name="product[]" class="box" required>';
        selectHTML += '<option value="" disabled selected>Sélectionner un plat --*</option>';
        for (var i = 0; i < repas.length; i++) {
            selectHTML += '<option value="' + repas[i].id + '">' + repas[i].name + '</option>';
        }
        selectHTML += '</select>';
        newItem.innerHTML = selectHTML + '<input type="number" min="1" name="quantity[]" required placeholder="Quantité*" class="box">';
        document.getElementById('menu-items').appendChild(newItem);
    });
</script>

<script src="../js/admin_script.js"></script>
</body>
</html>
