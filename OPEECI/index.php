<?php
// Inclure le fichier de connexion à la base de données
include('components/connect.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>OPEECI - Association des Parents d'Élèves et Étudiants de Côte d'Ivoire</title>
    <meta content="association, parents d'élèves, étudiants, Côte d'Ivoire" name="keywords">
    <meta content="Site officiel de l'OPEECI, l'Association des Parents d'Élèves et Étudiants de Côte d'Ivoire" name="description">

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
<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5">
    <div class="owl-carousel header-carousel position-relative mb-5">
        <?php foreach ($carrousels as $carrousel): ?>
            <div class="owl-carousel-item position-relative">
                <div class="carousel-image-container">
                    <img class="img-fluid" src="<?php echo htmlspecialchars($carrousel['image_src']); ?>" alt="">
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(6, 3, 21, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown"><?php echo htmlspecialchars($carrousel['titre']); ?></h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4"><?php echo htmlspecialchars($carrousel['sous_titre']); ?></h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2"><?php echo htmlspecialchars($carrousel['description']); ?></p>
                                <a href="<?php echo htmlspecialchars($carrousel['btn_url_1']); ?>" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft"><?php echo htmlspecialchars($carrousel['btn_texte_1']); ?></a>
                                <a href="<?php echo htmlspecialchars($carrousel['btn_url_2']); ?>" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight"><?php echo htmlspecialchars($carrousel['btn_texte_2']); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-fluid overflow-hidden py-5 px-lg-0" style="margin-top: -50px">
        <div class="container about py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 wow fadeInLeft" data-wow-delay="0.1s" style="min-height: 400px; min-width: 400px;">
                    <div class="position-relative h-100 ps-3">
                        <img class="position-absolute img-fluid w-400 h-400" src="<?php echo htmlspecialchars($a_propos['image_src']); ?>" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="text-secondary text-uppercase mb-3"><?php echo htmlspecialchars($a_propos['sous_titre']); ?></h6>
                    <h1 class="mb-5"><?php echo htmlspecialchars($a_propos['titre_section']); ?></h1>
                    <p class="mb-5"><?php echo htmlspecialchars($a_propos['description']); ?></p>
                    <div class="row g-4 mb-5">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                            <i class="fa <?php echo htmlspecialchars($a_propos['icone_1']); ?> fa-3x text-primary mb-3"></i>
                            <h5><?php echo htmlspecialchars($a_propos['titre_icone_1']); ?></h5>
                            <p class="m-0"><?php echo htmlspecialchars($a_propos['desc_icone_1']); ?></p>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                            <i class="fa <?php echo htmlspecialchars($a_propos['icone_2']); ?> fa-3x text-primary mb-3"></i>
                            <h5><?php echo htmlspecialchars($a_propos['titre_icone_2']); ?></h5>
                            <p class="m-0"><?php echo htmlspecialchars($a_propos['desc_icone_2']); ?></p>
                        </div>
                    </div>
                    <a href="<?php echo htmlspecialchars($a_propos['lien_bouton']); ?>" class="btn btn-primary py-3 px-5"><?php echo htmlspecialchars($a_propos['texte_bouton']); ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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

 <!-- Fact Start -->
<div class="container-xxl py-5" style="margin-top: -50px">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Section "Quelques faits" -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase mb-3">Quelques faits</h6>
                <h1 class="mb-5"><?php echo htmlspecialchars($faits[0]['titre_principal']); ?></h1>
                <p class="mb-5"><?php echo htmlspecialchars($faits[0]['description_contact']); ?></p>
                <div class="d-flex align-items-center">
                    <i class="fa <?php echo htmlspecialchars($faits[0]['icone_contact']); ?> fa-2x flex-shrink-0 bg-primary p-3 text-white"></i>
                    <div class="ps-4">
                        <h6><?php echo htmlspecialchars($faits[0]['titre_contact']); ?></h6>
                        <h3 class="text-primary m-0"><?php echo htmlspecialchars($faits[0]['contact_telephone']); ?></h3>
                    </div>
                </div>
            </div>

            <!-- Section des faits -->
            <div class="col-lg-6">
                <div class="row g-4 align-items-center">
                    <?php foreach ($faits as $fait): ?>
                        <div class="col-sm-6">
                            <div class="<?php echo htmlspecialchars($fait['classe']); ?> p-4 mb-4 wow fadeIn" data-wow-delay="0.3s">
                                <i class="fa <?php echo htmlspecialchars($fait['icone']); ?> fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up"><?php echo htmlspecialchars($fait['nombre']); ?></h2>
                                <p class="text-white mb-0"><?php echo htmlspecialchars($fait['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fact End -->
     
<!-- Feature Start -->
<div class="container-fluid overflow-hidden py-5 px-lg-0" style="margin-top: -50px">
    <div class="container feature py-5 px-lg-0">
        <div class="row g-5 mx-lg-0">
            <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase mb-3">Nos Objectifs</h6>
                <h1 class="mb-5">Nous Agissons pour l'Éducation et la Cohésion Sociale</h1>
                <?php foreach ($objectifs as $objectif): ?>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa <?php echo htmlspecialchars($objectif['icone']); ?> text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5><?php echo htmlspecialchars($objectif['titre']); ?></h5>
                            <p class="mb-0"><?php echo htmlspecialchars($objectif['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100" src="img/accueilobjectif.avif" style="object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->



<!-- Contact Start -->
<div class="container-xxl py-5" style="margin-top: -50px">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase mb-3"><?php echo htmlspecialchars($contact['titre_section']); ?></h6>
                <h1 class="mb-5"><?php echo htmlspecialchars($contact['description_section']); ?></h1>
                <div class="d-flex align-items-center">
                    <i class="fa <?php echo htmlspecialchars($contact['icone_contact']); ?> fa-2x flex-shrink-0 bg-primary p-3 text-white"></i>
                    <div class="ps-4">
                        <h6><?php echo htmlspecialchars($contact['titre_contact']); ?></h6>
                        <h3 class="text-primary m-0"><?php echo htmlspecialchars($contact['contact_telephone']); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="bg-light text-center p-5 wow fadeIn" data-wow-delay="0.5s">
                <form action="index.php" method="post">
    <div class="row g-3">
        <div class="col-12 col-sm-6">
            <input type="text" name="nom" class="form-control border-0" placeholder="Votre Nom" style="height: 55px;" required>
        </div>
        <div class="col-12 col-sm-6">
            <input type="email" name="email" class="form-control border-0" placeholder="Votre Email" style="height: 55px;" required>
        </div>
        <div class="col-12 col-sm-6">
            <input type="number" name="telephone" class="form-control border-0" placeholder="Votre Téléphone" style="height: 55px;">
        </div>
        <div class="col-12 col-sm-6">
            <select name="sujet" class="form-select border-0" style="height: 55px;" required>
                <option value="" selected disabled>Choisissez un sujet</option>
                <option value="Adhésion">Adhésion</option>
                <option value="Activités">Activités</option>
                <option value="Partenariat">Partenariat</option>
                <option value="Autres">Autres</option>
            </select>
        </div>
        <div class="col-12">
            <textarea name="message" class="form-control border-0" placeholder="Votre Message" required></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Envoyer</button>
        </div>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<!-- Adhésion Start -->
<div class="container-xxl py-5" style="margin-top: -50px">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Adhésion et Participation</h6>
            <h1 class="mb-5">Rejoignez-nous et Faites la Différence</h1>
        </div>
        <div class="row g-4">
            <?php foreach ($adhesions as $adhesion): ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="price-item">
                        <div class="border-bottom p-4 mb-4">
                            <h5 class="text-primary mb-1"><?php echo htmlspecialchars($adhesion['titre']); ?></h5>
                        </div>
                        <div class="p-4 pt-0">
                            <?php echo nl2br(htmlspecialchars($adhesion['description'])); ?>
                            <a class="btn-slide mt-2" href="<?php echo htmlspecialchars($adhesion['lien_bouton']); ?>">
                                <i class="fa fa-arrow-right"></i><span><?php echo htmlspecialchars($adhesion['bouton_texte']); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Adhésion End -->

<!-- Équipe Start -->
<div class="container-xxl py-5" style="margin-top: -50px">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Notre Équipe</h6>
            <h1 class="mb-5">Les Membres Clés de l'OPEECI</h1>
        </div>
        <div class="row g-4">
            <?php foreach ($equipe as $membre): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="<?php echo htmlspecialchars($membre['photo']); ?>" alt="<?php echo htmlspecialchars($membre['nom']); ?>">
                        </div>
                        <h5 class="mb-0"><?php echo htmlspecialchars($membre['nom']); ?></h5>
                        <p><?php echo htmlspecialchars($membre['poste']); ?></p>
                        <div class="btn-slide mt-1">
                            <i class="fa fa-share"></i>
                            <span>
                                <?php if ($membre['facebook']): ?><a href="<?php echo htmlspecialchars($membre['facebook']); ?>"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                                <?php if ($membre['twitter']): ?><a href="<?php echo htmlspecialchars($membre['twitter']); ?>"><i class="fab fa-twitter"></i></a><?php endif; ?>
                                <?php if ($membre['instagram']): ?><a href="<?php echo htmlspecialchars($membre['instagram']); ?>"><i class="fab fa-instagram"></i></a><?php endif; ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Équipe End -->



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