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

<!-- components/navbar.php -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
    <a href="index.php" class="navbar-brand bg-primary d-flex align-items-center px-4 px-lg-5">
        <!-- Logo Image -->
        <img src="img/opeeci.jpg" alt="Logo" style="height: 60px; margin-right: 10px;">
        <h2 class="mb-2 text-white">OPEECI</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link active">Accueil</a>
            <div class="nav-item dropdown">
                <a href="vision.php" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    QU'EST CE QUE L'OPEECI?</a>
                <div class="dropdown-menu fade-up m-0" aria-labelledby="navbarDropdown">
                    <a href="vision.php#vision" class="dropdown-item">Notre vision</a>
                    <a href="vision.php#mission" class="dropdown-item">Notre mission</a>
                    <a href="vision.php#valeur" class="dropdown-item">Nos valeurs</a>
                    <a href="vision.php#organisation" class="dropdown-item">Notre organisation</a>
                </div>
            </div>
            <a href="service.php" class="nav-item nav-link">Activités</a>
            <form class="d-flex ms-3 me-3" role="search" action="search_results.html" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Rechercher des sections" aria-label="Search" style="width: 228px; height: 35px; border-radius: 15px; margin-top: 18px;">
                <button class="btn btn-outline-success" type="submit" style="border-radius: 15px; padding: 2px 10px; height: 30px; margin-top: 22px;">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
        <div class="d-flex pt-2 navbar-social ">
            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/Aka.claude12?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</nav>
