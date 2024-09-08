<?php
$dsn = 'mysql:host=localhost;dbname=opeeci;charset=utf8';
$username = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $username, $password);
    // Définir le mode d'erreur PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}


// Récupérer les informations de la section "Quelques faits"
$select_faits = $conn->prepare("SELECT * FROM fait"); // Ajuste la requête en fonction de tes besoins
$select_faits->execute();
$faits = $select_faits->fetchAll(PDO::FETCH_ASSOC);

// Préparer et exécuter la requête SQL pour récupérer les activités
$select_activites = $conn->prepare("SELECT id, titre, description, image, lien FROM activite ORDER BY id");
$select_activites->execute();
$activites = $select_activites->fetchAll(PDO::FETCH_ASSOC);

// Préparer et exécuter la requête SQL
$select_profile = $conn->prepare("SELECT texte, type FROM flash_info ORDER BY cree_le DESC");
$select_profile->execute();

// Récupérer les témoignages
$select_temoin = $conn->prepare("SELECT * FROM temoignages");
$select_temoin->execute();
$temoignages = $select_temoin->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations de la section "À propos de nous"
$select_a_propos = $conn->prepare("SELECT * FROM a_propos LIMIT 1");
$select_a_propos->execute();
$a_propos = $select_a_propos->fetch(PDO::FETCH_ASSOC);

// Récupérer les informations de la table équipe
$select_equipe = $conn->prepare("SELECT * FROM equipe");
$select_equipe->execute();
$equipe = $select_equipe->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations de la table adhésion
$select_adhesions = $conn->prepare("SELECT * FROM adhesion");
$select_adhesions->execute();
$adhesions = $select_adhesions->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations de contact
$select_contact = $conn->prepare("SELECT * FROM contact WHERE id = 1"); // Assurez-vous que vous avez une entrée avec ID 1
$select_contact->execute();
$contact = $select_contact->fetch(PDO::FETCH_ASSOC);

// Récupérer les objectifs
$select_objectifs = $conn->prepare("SELECT * FROM objectifs ORDER BY ordre ASC");
$select_objectifs->execute();
$objectifs = $select_objectifs->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les éléments du carrousel
$select_carrousel = $conn->prepare("SELECT * FROM carrousel ORDER BY ordre ASC");
$select_carrousel->execute();
$carrousels = $select_carrousel->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les messages
$messages = $select_profile->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    // Préparer la requête d'insertion
    $insert_message = $conn->prepare("INSERT INTO messages (nom, email, telephone, sujet, message) VALUES (?, ?, ?, ?, ?)");
    $insert_message->execute([$nom, $email, $telephone, $sujet, $message]);

    // Redirection ou message de succès
    echo "<script>alert('Votre message a été envoyé avec succès !');</script>";
}

?>
