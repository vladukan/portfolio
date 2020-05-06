<!DOCTYPE html>
<html lang="en" ng-app="MainSite">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Сайт Портфолио</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!--<link href="vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">-->
    <!--<link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/ui-bootstrap-custom-2.5.0-csp.css">
    <link href="css/stylish-portfolio.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="vendor/fullpage/jquery.fullPage.css">
    <link rel="stylesheet" href="vendor/angular-1.6.6/angular-material.css">

    <script src="vendor/angular-1.6.6/angular.js"></script>
    <script src="vendor/angular-1.6.6/angular-animate.js"></script>
    <script src="vendor/angular-1.6.6/angular-aria.js"></script>
    <script src="vendor/angular-1.6.6/angular-messages.js"></script>
    <script src="vendor/angular-1.6.6/angular-material.min.js"></script>
    <script src="vendor/angular-1.6.6/ui-bootstrap-custom-2.5.0.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/site.js"></script>
    <link rel="stylesheet" href="vendor/font-awesome-4.2.0/css/font-awesome.min.css">


</head>

<body id="page-top" ng-controller="MainCtrl" ng-cloak>

<!-- Navigation -->
<a class="menu-toggle rounded" href="#">
    <i class="fa fa-bars"></i>
</a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav" id="navigation">

        <li class="sidebar-nav-item" data-menuanchor="home">
            <a class="js-scroll-trigger" href="#home">Главная</a>
        </li>
        <li class="sidebar-nav-item" data-menuanchor="portfolio">
            <a class="js-scroll-trigger" href="#portfolio">Портфолио</a>
        </li>
        <li class="sidebar-nav-item" data-menuanchor="article">
            <a class="js-scroll-trigger" href="#article">Статьи</a>
        </li>
        <li class="sidebar-nav-item" data-menuanchor="contact">
            <a class="js-scroll-trigger" href="#contact">Контакты</a>
        </li>
        <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="admin.php" target="_blank">Вход</a>
        </li>
    </ul>
</nav>

<div id="fullpage">
    <!-- Header -->
    <header class="masthead d-flex section" data-anchor="home">
        <div class="container text-center my-auto">
            <h1 class="mb-1 animated fadeInLeft">Блог фотографа</h1>
            <h3 class="mb-5 animated fadeInRight">
                <em>Наши фото будут всегда радовать вас</em>
            </h3>
            <a class="btn btn-primary btn-xl js-scroll-trigger animated fadeInRight" href="#portfolio">Наши
                работы</a>
        </div>
        <div class="overlay"></div>
    </header>

    <section class="content section" ng-cloak data-anchor="portfolio">

        <div class="container" ng-hide="portfolio_albums">
            <div class="row">

                <div class="col-md-12 col-xs-12">
                    <h1 class="mb-1" style="text-align: center;color: yellow;">Портфолио</h1>
                </div>
                <div class="portfolio animated fadeInLeft">
                    <div class="col-md-12 col-xs-12" ng-repeat="item in albums| filter: {id: search[select_album]}" ng-if="$index<1">
                        <div class="title" style="cursor: pointer" ng-click="Click_album(item.id,item.name)">{{item.name}}</div>
                        <div class="albums animated fadeInRight">
                            <img class="img-fluid" ng-style="{height: height_window+'px', width: width_window+'px'}" src="{{item.picture}}" alt="" md-swipe-left="next_album()" md-swipe-right="prev_album()" ng-click="Click_album(item.id,item.name)">
                        </div>
                        <div class="next" ng-click="next_album()" ng-show="show_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                        <div class="prev" ng-click="prev_album()" ng-show="show_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                        <div class="navigation">{{select_album+1}} / {{count_table}}</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container" ng-hide="portfolio_fotos" >
            <div class="row">
                <div class="portfolio">
                    <div class="col-md-12 col-xs-12">
                    <div class="animated fadeInLeft" style="text-align: center">
                        <a class="btn btn-primary btn-xl js-scroll-trigger" ng-click="back_albums()">К альбомам</a>
                        <h1 class="text-secondary mb-0" style="margin: 10px 0 10px 0">{{title1}}</h1>
                    </div>
                    </div>
                    <div class="col-md-12" ng-show="empty_fotos">

                        <h1 class="mb-1 animated fadeInUpBig" style="margin: 50px 0 50px 0; color: white">Нет фотографий</h1>

                    </div>
                    <div ng-show="full_fotos">
                    <div class="col-md-12 col-xs-12"  ng-repeat="item in fotos| filter: {id: search_foto[select_foto]}" ng-if="$index<1">
                        <div class="albums animated fadeInRight">
                            <img class="img-fluid" ng-style="{height: height_window+'px', width: width_window+'px'}" src="{{item.url}}" alt="" md-swipe-left="next_foto()" md-swipe-right="prev_foto()">
                            <div class="view" style="float: left;margin-left: 30px"><i class="fa fa-eye" aria-hidden="true"></i> <b style="padding-left: 10px">{{views_sum}}</b></div>
                            <div class="like" ng-click="click_likes(item.id)" style="float: right;margin-right: 30px"><i class="fa fa-heart" aria-hidden="true"></i> <b style="padding-left: 10px">{{likes_sum}}</b></div>
                        </div>
                    </div>
                    <div class="next" ng-click="next_foto(id_album,name_album)" ng-show="show_next_foto"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                    <div class="prev" ng-click="prev_foto(id_album,name_album)" ng-show="show_prev_foto"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                    <div class="navigation animated fadeInLeft">{{select_foto+1}} / {{count_table_foto}}</div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <section class="article section" ng-cloak data-anchor="article">

        <div class="container" ng-hide="list_articles">
            <div class="row">

                <div class="col-md-12 col-xs-12">
                    <h1 class="mb-1" style="text-align: center;color: yellow;">Статьи</h1>
                </div>
                <div class="portfolio animated fadeInLeft">
                    <div class="col-md-12 col-xs-12" ng-repeat="item in articles| filter: {id: search[select_article]}" ng-if="$index<1">
                        <div class="title" style="cursor: pointer" ng-click="Click_album(item.id,item.name)">{{item.name}}</div>
                        <div class="albums animated fadeInRight">
                            <img class="img-fluid" ng-style="{height: (height_window-150)+'px', width: (width_window-400)+'px'}" src="{{item.picture}}" alt="" md-swipe-left="next_album()" md-swipe-right="prev_album()" ng-click="Click_album(item.id,item.name)">
                        </div>
                        <div class="next" ng-click="next_art()" ng-show="next_article"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                        <div class="prev" ng-click="prev_art()" ng-show="prev_article"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                        <div class="navigation">{{select_article+1}} / {{count_articles}}</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container" ng-hide="portfolio_fotos" >
            <div class="row">
                <div class="portfolio">
                    <div class="col-md-12 col-xs-12">
                        <div class="animated fadeInLeft" style="text-align: center">
                            <a class="btn btn-primary btn-xl js-scroll-trigger" ng-click="back_albums()">К альбомам</a>
                            <h1 class="text-secondary mb-0" style="margin: 10px 0 10px 0">{{title1}}</h1>
                        </div>
                    </div>
                    <div class="col-md-12" ng-show="empty_fotos">

                        <h1 class="mb-1 animated fadeInUpBig" style="margin: 50px 0 50px 0; color: white">Нет фотографий</h1>

                    </div>
                    <div ng-show="full_fotos">
                        <div class="col-md-12 col-xs-12"  ng-repeat="item in fotos| filter: {id: search_foto[select_foto]}" ng-if="$index<1">
                            <div class="albums animated fadeInRight">
                                <img class="img-fluid" ng-style="{height: height_window+'px', width: width_window+'px'}" src="{{item.url}}" alt="" md-swipe-left="next_foto()" md-swipe-right="prev_foto()">
                                <div class="view" style="float: left;margin-left: 30px"><i class="fa fa-eye" aria-hidden="true"></i> <b style="padding-left: 10px">{{views_sum}}</b></div>
                                <div class="like" ng-click="click_likes(item.id)" style="float: right;margin-right: 30px"><i class="fa fa-heart" aria-hidden="true"></i> <b style="padding-left: 10px">{{likes_sum}}</b></div>
                            </div>
                        </div>
                        <div class="next" ng-click="next_foto(id_album,name_album)" ng-show="show_next_foto"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                        <div class="prev" ng-click="prev_foto(id_album,name_album)" ng-show="show_prev_foto"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                        <div class="navigation animated fadeInLeft">{{select_foto+1}} / {{count_table_foto}}</div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- Footer -->
    <footer class="footer text-center section" data-anchor="contact">
        <div class="container">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#">
                        <i class="icon-social-facebook"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#">
                        <i class="icon-social-twitter"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" href="#">
                        <i class="icon-social-github"></i>
                    </a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; Your Website 2017</p>
        </div>
    </footer>
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript -->

<script src="vendor/owl-carousel/owl.carousel.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/fullpage/jquery.easings.min.js"></script>


<script src="vendor/fullpage/jquery.fullPage.min.js"></script>
<script src="vendor/fullpage/scrolloverflow.min.js"></script>
<!-- Custom scripts for this template -->
<script src="js/stylish-portfolio.js"></script>

<script>
    $(document).ready(
        function () {
            $('#fullpage').fullpage();
            // menu: '#navigation'
        });
</script>
</body>

</html>
