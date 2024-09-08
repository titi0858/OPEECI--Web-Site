<?php
// Inclure le fichier de connexion à la base de données
include('components/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>OPEECI - Association des Parents d'Élèves et Étudiants de Côte d'Ivoire</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

<!-- Favicon -->
<link href="img/opeeci.jpg" rel="icon" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <!-- Spinner End -->


<!-- Navbar Start -->
<?php include('components/navbar.php'); ?>
    <!-- Navbar End -->
<!-- Début du Flash Info -->
<div class="news-ticker bg-light py-2">
        <div class="container d-flex align-items-center">
            <div class="ticker-title text-white bg-success px-3 py-1 me-3">FLASH INFO</div>
            <marquee class="ticker-content d-flex align-items-center" behanor="scroll" direction="left" scrollamount="6">
                <?php foreach ($messages as $message): ?>
                    <span class="text-<?php echo htmlspecialchars($message['type']);?> mx-3">
                       <?php echo htmlspecialchars($message['texte']); ?>
                    </span>
                <?php endforeach; ?>
            </marquee>
        </div>
    </div>
    <!-- Fin du Flash Info -->
<!-- Fin du Flash Info -->
<!-- En-tête de Page Début -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Nos Activités</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Nos Activités</li>
            </ol>
        </nav>
    </div>
</div>
<!-- En-tête de Page Fin -->
<!-- Activités Start -->
<div class="container-xxl py-5" style="margin-top: -50px">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Nos Activités</h6>
                <h1 class="mb-5">Découvrez Nos Initiatives</h1>
            </div>
            <div class="row g-4">
                <?php foreach ($activites as $activite): ?>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="<?php echo htmlspecialchars($activite['image']); ?>" alt="<?php echo htmlspecialchars($activite['titre']); ?>">
                            </div>
                            <h4 class="mb-3"><?php echo htmlspecialchars($activite['titre']); ?></h4>
                            <p><?php echo htmlspecialchars($activite['description']); ?></p>
                            <a class="btn-slide mt-2" href="<?php echo htmlspecialchars($activite['lien']); ?>"><i class="fa fa-arrow-right"></i><span>En savoir plus</span></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Activités End -->
<!-- Témoignages Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -50px">
    <div class="container py-5">
        <div class="text-center">
            <h6 class="text-secondary text-uppercase">Témoignages</h6>
            <h1 class="mb-0">Ce que disent nos membres !</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($temoignages as $temoignage): ?>
                <div class="testimonial-item p-4 my-5">
                    <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                    <div class="d-flex align-items-end mb-4">
                        <img class="img-fluid flex-shrink-0" src="<?php echo htmlspecialchars($temoignage['image_src']); ?>" style="width: 80px; height: 80px;">
                        <div class="ms-4">
                            <h5 class="mb-1"><?php echo htmlspecialchars($temoignage['nom']); ?></h5>
                            <p class="m-0"><?php echo htmlspecialchars($temoignage['role']); ?></p>
                        </div>
                    </div>
                    <p class="mb-0"><?php echo htmlspecialchars($temoignage['message']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Témoignages End -->


<!-- footer -->
<?php include('components/footer.php'); ?>
    <!-- footer -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>