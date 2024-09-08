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
 <!-- Page Header Start -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown" id="vision">Notre vision</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#"> QU'EST CE QUE L'OPEECI?</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Notre vision</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- vision Start -->
<div class="container-fluid overflow-hidden py-5 px-lg-0" >
    <div class="container about py-5 px-lg-0">
        <div class="row g-5 mx-lg-0">
            <div class="col-lg-6 ps-lg-0 wow fadeInLeft" data-wow-delay="0.1s" style="min-height: 400px; min-width: 400PX;">
                <div class="position-relative h-100" style="margin-top: -90px";>
                    <img class="position-absolute img-fluid w-400 h-400" src="img/carousel-2.jpg" style="object-fit: cover;" alt="OPEECI">
                </div>
            </div>
            <div class="col-lg-6 about-text wow fadeInUp" data-wow-delay="0.3s"  style="margin-top: -50px";>
                <h4 class="text-secondary text-uppercase mb-3">La vision de l'OPEECI</h4>
                <h1 class="mb-5">L'Organisation  des Parents d'Élèves  et Étudiants de Côte d'Ivoire</h1>
                <p class="mb-5"> L'Organisation des Parents d'Élèves et Étudiants de Côte d'Ivoire (OPEECI) est née de 
                la volonté de parents, tuteurs, correspondants, et responsables d'élèves et d'étudiants de collaborer
                pour assurer une éducation de qualité à nos jeunes. Conscients du rôle crucial que nous jouons dans
                le développement de notre société, nous nous engageons à être des partenaires actifs dans le système
                 socio-éducatif ivoirien, pour le bien-être et l'avenir de la jeunesse. </p>
                <div class="row g-4 mb-5">
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-globe fa-3x text-primary mb-3"></i>
                        <h5>Couverture Nationale</h5>
                        <p class="m-0">Nous travaillons à travers toute la Côte d'Ivoire pour assurer que chaque voix soit entendue et chaque besoin soit satisfait.</p>
                    </div>
                    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                        <i class="fa fa-heart fa-3x text-primary mb-3"></i>
                        <h5>Engagement Communautaire</h5>
                        <p class="m-0">Nous organisons des événements et des initiatives pour renforcer la communauté éducative et offrir un soutien pratique aux familles.</p>
                    </div>
                </div>
                <a href="#" class="btn btn-primary py-3 px-5">En Savoir Plus</a>
            </div>
        </div>
    </div>
</div>
<!-- vision  End -->


<!-- mission Start -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;" style="margin-top: -70px;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown" id="mission">Notre mission</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#"> QU'EST CE QUE L'OPEECI?</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Notre mission</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl py-50">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -20px;">
                <h4 class="text-secondary text-uppercase mb-3"> La mission de l'OPEECI</h4>
                <h1 class="mb-5"> L'OPEECI a pour mission de :</h1>
                <p class="mb-5"><strong>Regrouper</strong> tous les parents, tuteurs, correspondants et responsables d'élèves 
                    et d'étudiants, sans distinction d'origine, de race, de sexe, de profession, de religion ou de 
                    statut social, dans un esprit de paix et de solidarité.</p>
                <p class="mb-5"><strong>Défendre</strong> les intérêts de nos membres, de leurs enfants et pupilles, en tenant compte des aspirations de tous les 
                    partenaires du système socio-éducatif.</p>
                <p class="mb-5"><strong>Alléger</strong> les charges sociales des familles à travers la création de coopératives d'achat et de vente de fournitures scolaires 
                    et universitaires, ainsi que de mutuelles d'assurance.</p>
                    <p class="mb-5"><strong>Contribuer</strong> à l'amélioration du système socio-éducatif en formant des personnes compétentes, intègres,
                         et dévouées au progrès des jeunes et de l'humanité.</p>

                
            </div>
            
        </div>
    </div>
</div>
<!-- mission End -->


<!-- valeurs Start -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;" style="margin-top: -40px";>
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown" id="valeur">Nos valeurs</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#"> QU'EST CE QUE L'OPEECI?</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Nos valeurs </li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-fluid overflow-hidden py-5 px-lg-0">
    <div class="container feature py-5 px-lg-0">
        <div class="row g-5 mx-lg-0">
            <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -50px">
                <h4 class="text-secondary text-uppercase mb-3" >Nos valeurs </h4>
                <h1 class="mb-5">Nous nous engageons en Côte d'Ivoire Depuis 2010 à :</h1>
                <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                    <i class="fas fa-peace text-primary fa-3x flex-shrink-0"></i>
                    <div class="ms-4">
                        <h5>Neutralité et apolitique </h5>
                        <p class="mb-0">Maintenir une autonomie vis-à-vis des partis politiques
                        et des confessions religieuses.</p>
                        
                    </div>
                </div>
                <div class="d-flex mb-5 wow fadeIn" data-wow-delay="0.5s">
                    <i class="fas fa-users text-primary fa-3x flex-shrink-0"></i>
                    <div class="ms-4">
                        <h5>Collaboration participative et active</h5>
                        <p class="mb-0"> Participer activement aux débats concernant l'avenir du système socio-éducatif en
                             Côte d'Ivoire et à l'échelle internationale. Nous collaborons avec des écoles, des institutions et des 
                            partenaires pour maximiser notre impact.</p>
                    </div>
                </div>
                <div class="d-flex mb-0 wow fadeInUp" data-wow-delay="0.7s">
                    <i class="fas fa-file-alt text-primary fa-3x flex-shrink-0"></i>
                    <div class="ms-4">
                        <h5>Transparence et responsabilité</h5>
                        <p class="mb-0">Promouvoir la transparence, la responsabilité, et la lutte
                         contre la désinformation. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100" style="margin-top: -90px ">
                    <img class="position-absolute img-fluid w-100 h-100" src="img/feature.jpg" style="object-fit: cover;" alt="OPEECI Features" >
                </div>
            </div>
        </div>
    </div>
</div>
<!-- valeurs  End -->


<!--organisation Start -->
<div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown" id="organisation">Notre organisation</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#"> QU'EST CE QUE L'OPEECI?</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Notre organisation</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s"  style="margin-top: -120px">
            <h4 class="text-secondary text-uppercase" >Notre organisation</h4>
            <h1 class="mb-5">Les instances de l'OPEECI </h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4">
                    <div class="overflow-hidden mb-4">
                        <i class="fas fa-users-cog text-primary fa-3x flex-shrink-0"></i>
                    </div>
                    <p ><i style="color: rgb(6, 207, 107);"> <strong>L'Assemblée Générale</i> </strong> </p>
                    <p><strong>L'Assemblée Générale (AG),</strong> est l'organe suprême de décision, qui se réunit annuellement 
                    pour définir la politique générale et élire les membres du Bureau Exécutif National (B.E.N).</p>

                    <div class="btn-slide mt-1">
                        <i class="fa fa-share"></i>
                        <span>
                            <a href="#"><i class="fas fa-plus"></i></a>
                            
                             
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4">
                    <div class="overflow-hidden mb-4">
                        <i class="fas fa-users-cog text-primary fa-3x flex-shrink-0"></i>
                    </div>
                    <p> <i style="color: rgb(6, 207, 107);">Le Bureau Exécutif National (B.E.N) </i></p>
                              
                    <p><strong>Le Bureau Exécutif National (B.E.N),</strong> est chargé de la gestion quotidienne et de la mise en œuvre des décisions de l'Assemblée Générale.</p>

                    <div class="btn-slide mt-1">
                        <i class="fa fa-share"></i>
                        <span>
                            <a href="#"><i class="fas fa-plus"></i></a>
                           
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item p-4">
                    <div class="overflow-hidden mb-4">
                        <i class="fas fa-users-cog text-primary fa-3x flex-shrink-0"></i>
                    </div>
                    <p><i style="color: rgb(6, 207, 107);">Le commissariat aux comptes </i></p>
                    
                    
                    <p><strong>Le Commissariat aux Comptes,</strong> est le garant de la transparence financière de l'organisation.</p>
                    <div class="btn-slide mt-1">
                        <i class="fa fa-share"></i>
                        <span>
                            <a href="#"><i class="fas fa-plus"></i></a>
                           
                        </span>
                    </div>
                </div>
            </div>
        </div>
            <!-- Répétez les blocs ci-dessus pour les autres membres de l'équipe -->
        </div>
    </div>
</div>
<!-- organisation End -->

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