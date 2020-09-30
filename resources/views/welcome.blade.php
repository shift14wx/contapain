<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Tivo is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>ContaPainLess T</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="css/tivo/bootstrap.css" rel="stylesheet">
    <link href="css/tivo/fontawesome-all.css" rel="stylesheet">
    <link href="css/tivo/swiper.css" rel="stylesheet">
    <link href="css/tivo/magnific-popup.css" rel="stylesheet">
    <link href="css/tivo/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="images/tivo/favicon.png">
</head>
<body data-spy="scroll" data-target=".fixed-top">

<!-- Preloader -->
<div class="spinner-wrapper">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- end of preloader -->


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">

        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

        <!-- Image Logo -->
            <a class="navbar-brand" href="#"><img width="200px" src="images/tivo/logo.png"
                                                             alt="alternative"></a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">INICIO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#features">CUALIDADES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#details">DETALLES</a>
                </li>

                <!-- Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#pricing">PRECIOS</a>
                </li>
            </ul>

            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <span class="nav-item">
                <a href="{{ url('/dashboard') }}" class="btn-outline-sm">Dashboard</a>
                </span>
                @else
                <span class="nav-item">
                    <a class="btn-outline-sm" href="{{ route('login') }}">INICIAR SESION</a>
                </span>

                @if (Route::has('register'))
                <span class="nav-item">
                <a href="{{ route('register') }}" class="btn-outline-sm">Register</a>
                </span>
                @endif
                @endif
            </div>
            @endif


        </div>
    </div> <!-- end of container -->
</nav> <!-- end of navbar -->
<!-- end of navigation -->


<!-- Header -->
<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h1>Contabilidad sin dolor</h1>
                        <p class="p-large">Concentrate en lo que te hace crecer</p>
                        @auth
                        <a href="{{ url('/dashboard') }}" class="btn-solid-lg page-scroll">Dashboard</a>
                        @else
                        <a class="btn-solid-lg page-scroll" href="{{ route('register') }}">CREA UNA CUENTA AHORA!</a>
                        @endif
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <div class="img-wrapper">
                            <img class="img-fluid" src="images/tivo/header-software-app.png" alt="alternative">
                        </div> <!-- end of img-wrapper -->
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->
<svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310"><defs><style>.cls-1{fill:#5f4def;}</style></defs><title>header-frame</title><path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z"/></svg>
<!-- end of header -->


<!-- Customers -->
<div class="slider-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Image Slider -->
                <div class="slider-container">
                    <div class="swiper-container image-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="img-fluid" src="images/tivo/customer-logo-1.png" alt="alternative">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-fluid" src="images/tivo/customer-logo-2.png" alt="alternative">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-fluid" src="images/tivo/customer-logo-3.png" alt="alternative">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-fluid" src="images/tivo/customer-logo-4.png" alt="alternative">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-fluid" src="images/tivo/customer-logo-5.png" alt="alternative">
                            </div>
                            <div class="swiper-slide">
                                <img class="img-fluid" src="images/tivo/customer-logo-6.png" alt="alternative">
                            </div>
                        </div> <!-- end of swiper-wrapper -->
                    </div> <!-- end of swiper container -->
                </div> <!-- end of slider-container -->
                <!-- end of image slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider-1 -->
<!-- end of customers -->


<!-- Description -->
<div class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="above-heading">Descripción</div>
                <h2 class="h2-heading">Solucion para pequeñas empresas que hacen su trabajo excelente</h2>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid" src="images/tivo/description-1.png" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Solucion en la nube</h4>
                        <p>Solo crea una cuenta y potencia tu rendimiento</p>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid" src="images/tivo/description-2.png" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Interfaz intuitiva</h4>
                        <p>Molesto de ver esas interfaces cansadas y tan explotadas de los programas de contabilidad
                            de tradicionales, ContaPainLess T es moderno como tu negocio
                        </p>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img class="img-fluid" src="images/tivo/description-3.png" alt="alternative">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Trabajo en equipo</h4>
                        <p>ContaPainLess T, sabe que tan importante es trabajar en equipo, por ello estamos
                            trabajando para hacer esto realidad ( muy pronto )</p>
                    </div>
                </div>
                <!-- end of card -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
<!-- end of description -->


<!-- Features -->
<div id="features" class="tabs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="above-heading">CUALIDADES</div>
                <h2 class="h2-heading">ADIOS A LAS HORAS LARGAS</h2>
                <p class="p-heading"><b>¿Cansado de que las cuentas no cuadren?</b>, no te preocupes <b>contapainless
                        T</b>, hace el
                    trabajo por ti!
                </p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Tabs Links -->
                <ul class="nav nav-tabs" id="argoTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                           aria-controls="tab-1" aria-selected="true"><i class="fas fa-list"></i>Calculos
                            automatizados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                           aria-controls="tab-2" aria-selected="false"><i class="fas
                           fa-envelope-open-text"></i>Catalogo de cuentas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                           aria-controls="tab-3" aria-selected="false"><i class="fas fa-chart-bar"></i>Una
                            experciencia familiar</a>
                    </li>
                </ul>
                <!-- end of tabs links -->

                <!-- Tabs Content -->
                <div class="tab-content" id="argoTabsContent">

                    <!-- Tab -->
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image-container">
                                    <img class="img-fluid" src="images/tivo/features-1.png" alt="alternative">
                                </div> <!-- end of image-container -->
                            </div> <!-- end of col -->
                            <div class="col-lg-6">
                                <div class="text-container">
                                    <h3>Puedes dejar de lado un rato el calculador</h3>
                                    <p>Tan facil como dejar que nuestro programa haga todos los calculos de una vez,
                                        es automatizado para tu trabajo
                                    </p>
                                    <ul class="list-unstyled li-space-lg">
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Automatizado</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Facil de usar</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Calculos correctos</div>
                                        </li>
                                    </ul>
                                    <a class="btn-solid-reg " href="{{ route('register') }}">CREA UNA CUENTA AHORA!</a>
                                </div> <!-- end of text-container -->
                            </div> <!-- end of col -->
                        </div> <!-- end of row -->
                    </div> <!-- end of tab-pane -->
                    <!-- end of tab -->

                    <!-- Tab -->
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image-container">
                                    <img class="img-fluid" src="images/tivo/features-2.png" alt="alternative">
                                </div> <!-- end of image-container -->
                            </div> <!-- end of col -->
                            <div class="col-lg-6">
                                <div class="text-container">
                                    <h3>Catalogo de cuentas ordenado</h3>
                                    <p>¿No puedes recordar ese codigo necesario del rubro en el que estas
                                        trabajando?</p>
                                    <ul class="list-unstyled li-space-lg">
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">ContaPainLess T te provee de un buscador para
                                                dar con el codigo necesario</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Solo busca un numero de catalogo y
                                                contaPainLess T hara mucho por ti y tu trabajo</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Puedes ver tambien El catalogo de cuentas</div>
                                        </li>
                                    </ul>
                                    <a class="btn-solid-reg " href="{{ route('register') }}">CREA UNA CUENTA AHORA!</a>
                                </div> <!-- end of text-container -->
                            </div> <!-- end of col -->
                        </div> <!-- end of row -->
                    </div> <!-- end of tab-pane -->
                    <!-- end of tab -->

                    <!-- Tab -->
                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image-container">
                                    <img class="img-fluid" src="images/tivo/features-3.png" alt="alternative">
                                </div> <!-- end of image-container -->
                            </div> <!-- end of col -->
                            <div class="col-lg-6">
                                <div class="text-container">
                                    <h3>ContaPainLess T, tan familiar como tu cuardeno de cuentas</h3>
                                    <p>Hay demasidas soluciones para contabilidad pero ninguna que se adapte a tus
                                        reglamentos</p>
                                    <ul class="list-unstyled li-space-lg">
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Basados en el catalogo de cuentas de El
                                                Salvador</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Con interfaces mucho mas agradables</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-square"></i>
                                            <div class="media-body">Construido y pensado para ti, ContaPainLess T,
                                                cuenta con ello </div>
                                        </li>
                                    </ul>
                                    <a class="btn-solid-reg " href="{{ route('register') }}">CREA UNA CUENTA AHORA!</a>
                                </div> <!-- end of text-container -->
                            </div> <!-- end of col -->
                        </div> <!-- end of row -->
                    </div> <!-- end of tab-pane -->
                    <!-- end of tab -->

                </div> <!-- end of tab content -->
                <!-- end of tabs content -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of tabs -->
<!-- end of features -->


<!-- Details Lightboxes -->
<!-- Details Lightbox 1 -->
<div id="details-lightbox-1" class="lightbox-basic zoom-anim-dialog mfp-hide">
    <div class="container">
        <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8">
                <div class="image-container">
                    <img class="img-fluid" src="images/tivo/details-lightbox.png" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-4">
                <h3>List Building</h3>
                <hr>
                <h5>Core service</h5>
                <p>It's very easy to start using Tivo. You just need to fill out and submit the Sign Up Form and you will receive access to the app.</p>
                <ul class="list-unstyled li-space-lg">
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">List building framework</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Easy database browsing</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">User administration</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Automate user signup</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Quick formatting tools</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Fast email checking</div>
                    </li>
                </ul>
                <a class="btn-solid-reg mfp-close" href="sign-up.html">SIGN UP</a> <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of lightbox-basic -->
<!-- end of details lightbox 1 -->

<!-- Details Lightbox 2 -->
<div id="details-lightbox-2" class="lightbox-basic zoom-anim-dialog mfp-hide">
    <div class="container">
        <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8">
                <div class="image-container">
                    <img class="img-fluid" src="images/tivo/details-lightbox.png" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-4">
                <h3>Campaign Monitoring</h3>
                <hr>
                <h5>Core service</h5>
                <p>It's very easy to start using Tivo. You just need to fill out and submit the Sign Up Form and you will receive access to the app.</p>
                <ul class="list-unstyled li-space-lg">
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">List building framework</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Easy database browsing</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">User administration</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Automate user signup</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Quick formatting tools</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Fast email checking</div>
                    </li>
                </ul>
                <a class="btn-solid-reg mfp-close" href="sign-up.html">SIGN UP</a> <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of lightbox-basic -->
<!-- end of details lightbox 2 -->

<!-- Details Lightbox 3 -->
<div id="details-lightbox-3" class="lightbox-basic zoom-anim-dialog mfp-hide">
    <div class="container">
        <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8">
                <div class="image-container">
                    <img class="img-fluid" src="images/tivo/details-lightbox.png" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-4">
                <h3>Analytics Tools</h3>
                <hr>
                <h5>Core service</h5>
                <p>It's very easy to start using Tivo. You just need to fill out and submit the Sign Up Form and you will receive access to the app.</p>
                <ul class="list-unstyled li-space-lg">
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">List building framework</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Easy database browsing</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">User administration</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Automate user signup</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Quick formatting tools</div>
                    </li>
                    <li class="media">
                        <i class="fas fa-square"></i><div class="media-body">Fast email checking</div>
                    </li>
                </ul>
                <a class="btn-solid-reg mfp-close" href="sign-up.html">SIGN UP</a> <a class="btn-outline-reg mfp-close as-button" href="#screenshots">BACK</a>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of lightbox-basic -->
<!-- end of details lightbox 3 -->
<!-- end of details lightboxes -->


<!-- Details -->
<div id="details" class="basic-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h2>Ahora es el momento para hacerle una actualizacion a tu forma de trabajar!</h2>
                    <p>Piensa en grande, deja el trabajo molesto en nuestras manos enfocate en lo que necesitas
                    </p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Crea una cuenta y deja de trabajar mejor disfruta de tu
                                trabajo</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Es gratis</div>
                        </li>
                    </ul>
                    <a class="btn-solid-lg page-scroll" href="{{ route('register') }}">CREA UNA CUENTA AHORA!</a>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid" src="images/tivo/details.png" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of basic-1 -->
<!-- end of details -->


<!--VIDEO-->


<!-- Pricing -->
<div id="pricing" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="above-heading">Precios</div>
                <h2 class="h2-heading">Precios</h2>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Card-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">BASICO</div>
                        <div class="price"><span class="currency">$</span><span class="value">Gratis</span></div>
                        <div class="frequency">Siempre gratis</div>
                        <div class="divider"></div>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Creacion de asientos</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Creacion de registros</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Acceso al catalogo de cuentas</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-times"></i><div class="media-body">Dashboard Personalizado</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-times"></i><div class="media-body">Exportar a PDF</div>
                            </li>
                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-lg page-scroll" href="{{ route('register') }}">CREAR CUENTA</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

                <!-- Card-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">AVANZADO</div>
                        <div class="price"><span class="currency">$</span><span class="value">5.99</span></div>
                        <div class="frequency">Pago Mensual</div>
                        <div class="divider"></div>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Creacion de asientos</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Creacion de registros</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Acceso al catalogo de cuentas</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Dashboard Personalizado</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-times"></i><div class="media-body">Exportar a PDF</div>
                            </li>
                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-reg page-scroll" href="sign-up.html">SIGN UP</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

                <!-- Card-->
                <div class="card">
                    <!--<div class="label">
                        <p class="best-value">Best Value</p>
                    </div> -->
                    <div class="card-body">
                        <div class="card-title">COMPLETO</div>
                        <div class="price"><span class="currency">$</span><span class="value">10.99</span></div>
                        <div class="frequency">Pago Mensual</div>
                        <div class="divider"></div>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Creacion de asientos</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Creacion de registros</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Acceso al catalogo de cuentas</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Dashboard Personalizado</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-check"></i><div class="media-body">Exportar a PDF</div>
                            </li>
                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-reg page-scroll" href="sign-up.html">SIGN UP</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-2 -->
<!-- end of pricing -->


<!-- Testimonials -->
<div class="slider-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Text Slider -->
                <div class="slider-container">
                    <div class="swiper-container text-slider">
                        <div class="swiper-wrapper">

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="images/tivo/testimonial-1.jpg" alt="alternative">
                                </div> <!-- end of image-wrapper -->
                                <div class="text-wrapper">
                                    <div class="testimonial-text">I started to use Tivo with the free trial about a year ago and never stopped since then. It does all the repeating marketing tasks and allows me to focus on core development activities like new product research and design. I love it and recommend it to everyone.</div>
                                    <div class="testimonial-author">Jude Thorn - Online Marketer</div>
                                </div> <!-- end of text-wrapper -->
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="images/tivo/testimonial-2.jpg" alt="alternative">
                                </div> <!-- end of image-wrapper -->
                                <div class="text-wrapper">
                                    <div class="testimonial-text">Awesome features for the money. I never thought such a low ammount of money would bring me so many leads per month. Before Tivo I used the services of an agency which cost 10x more and delivered far less. Highly recommended to marketers focused on results.</div>
                                    <div class="testimonial-author">Roy Smith - Developer</div>
                                </div> <!-- end of text-wrapper -->
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="images/tivo/testimonial-3.jpg" alt="alternative">
                                </div> <!-- end of image-wrapper -->
                                <div class="text-wrapper">
                                    <div class="testimonial-text">Tivo is the best marketing automation app for small and medium sized business. It understands the mindset of young entrepreneurs and provides the necessary data for wise marketing decisions. Just give it a try and you will definitely not regret spending your time.</div>
                                    <div class="testimonial-author">Marsha Singer - Online Marketer</div>
                                </div> <!-- end of text-wrapper -->
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <div class="image-wrapper">
                                    <img class="img-fluid" src="images/tivo/testimonial-4.jpg" alt="alternative">
                                </div> <!-- end of image-wrapper -->
                                <div class="text-wrapper">
                                    <div class="testimonial-text">Tivo is one of the greatest marketing automation apps out there. I especially love the Reporting Tools module because it gives me such a great amount of information based on little amounts of input gathered in just few weeks of light weight usage. Recommended!</div>
                                    <div class="testimonial-author">Ronda Louis - Online Marketer</div>
                                </div> <!-- end of text-wrapper -->
                            </div> <!-- end of swiper-slide -->
                            <!-- end of slide -->

                        </div> <!-- end of swiper-wrapper -->

                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- end of add arrows -->

                    </div> <!-- end of swiper-container -->
                </div> <!-- end of slider-container -->
                <!-- end of text slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider-2 -->
<!-- end of testimonials -->


<!-- Newsletter -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <div class="above-heading">CONTACTO</div>
                    <h2>¿Necesitas mas información acerca de ContaPainLess T?</h2>

                    <!-- Newsletter Form -->
                    <form id="newsletterForm" data-toggle="validator" data-focus="false">
                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">Contactar</button>
                        </div>
                        <div class="form-message">
                            <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                        </div>
                    </form>
                    <!-- end of newsletter form -->

                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="icon-container">
                        <span class="fa-stack">
                            <a href="https://www.facebook.com/diego.cortesmoreno.1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="https://www.facebook.com/diego.cortesmoreno.1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="https://www.facebook.com/diego.cortesmoreno.1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-pinterest-p fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="https://www.facebook.com/diego.cortesmoreno.1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                    <span class="fa-stack">
                            <a href="https://www.facebook.com/diego.cortesmoreno.1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
                </div> <!-- end of col -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form -->
<!-- end of newsletter -->


<!-- Footer -->
<svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79"><defs><style>.cls-2{fill:#5f4def;}</style></defs><title>footer-frame</title><path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)"/></svg>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-col first">
                    <h4>Acerca de ContaPainLess T</h4>
                    <p class="p-small">Somos unos seres sobreexplotados por Diego Córtez, CEO de ContaPainLess</p>
                </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
                <div class="footer-col middle">
                    <h4>Enlaces de importancia</h4>
                    <ul class="list-unstyled li-space-lg p-small">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">Si desea donar ya que nuestro compañero <a class="white"
                                                                                          href="https://www.facebook
                                                                                          .com/raul.penate
                                                                                          .39108">Raul Peñate</a>
                                Sufrio de un derrame de vesicula cuando se encontraba laborando, Diego Cortez
                                nuestro CEO no quizo pagarle la quincena debido a que mancho equipo de la empresa</div>
                        </li>

                    </ul>
                </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
                <div class="footer-col last">
                    <h4>Contacto</h4>
                    <ul class="list-unstyled li-space-lg p-small">
                        <li class="media">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="media-body">Col las amarguras</div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of footer -->
<!-- end of footer -->


<!-- Copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="p-small">Copyright © 2020 <a href="https://inovatik.com">Somos Diego Cortez</a></p>
            </div> <!-- end of col -->
        </div> <!-- enf of row -->
    </div> <!-- end of container -->
</div> <!-- end of copyright -->
<!-- end of copyright -->


<!-- Scripts -->
<script src="js/tivo/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="js/tivo/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
<script src="js/tivo/bootstrap.min.js"></script> <!-- Bootstrap framework -->
<script src="js/tivo/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
<script src="js/tivo/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
<script src="js/tivo/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
<script src="js/tivo/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="js/tivo/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>
