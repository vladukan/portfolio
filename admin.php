<!DOCTYPE html>
<html lang="en" ng-app="MainSite">
<head ng-controller="MainCtrl">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700,100' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,700,900,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.7/typicons.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.structure.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.theme.css" type="text/css">


    <link rel="stylesheet" href="vendor/font-awesome-4.2.0/css/font-awesome.min.css">

    <script src="vendor/angular-1.6.6/angular.js"></script>
    <script src="vendor/angular-1.6.6/angular-animate.js"></script>
    <script src="vendor/jquery/jquery-3.3.1.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckfinder/ckfinder.js"></script>
    <script src="angular-ckeditor.js"></script>
    <script type="text/javascript" src="js/highstock.js"></script>
    <script type="text/javascript" src="js/offline-exporting.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/date.js"></script>


    <script src="js/admin.js"></script>
</head>
<body class="" ng-controller="MainCtrl" ng-cloak style="background: url('images/fon/background69.png'); background-repeat: repeat">


<div class="container">
    <div class="row">


        <!--ENTER-->
        <div class="col-md-6 col-md-offset-3 col-xs-12 text-center" style="margin-top: 10%" ng-show="enter_panel">
            <div class="well well-lg">
                <h4>Вход в Панель управления</h4>
                <div class="input-group col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Логин..." ng-model="name"
                           aria-describedby="sizing-addon1">
                </div>
                <div class="input-group col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1"
                     style="margin-top: 10px; margin-bottom: 10px">
                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                    <input type="password" class="form-control" placeholder="Пароль..." ng-model="password"
                           aria-describedby="sizing-addon1">
                </div>
                <button type="submit" class="btn btn-default" ng-click="login()"><strong> Войти </strong>
                    <i class="fa fa-sign-in"></i></button>
                <div class="col-md-12 alert alert-danger animated fadeInDown" role="alert" ng-show="error_login"
                     style="padding: 10px;margin: 10px">
                    <i class="fa fa-exclamation"></i> Логин или пароль не верен
                </div>
            </div>
        </div>
        <!--          PANEL ADMIN  -->
        <div ng-show="admin_panel">
            <div class="col-md-6 col-xs-12">
                <h5>Панель управления сайтом</h5>
            </div>
            <div class="col-md-2 col-xs-6">
                <a class="btn btn-default col-md-12 col-xs-12" href="" id="file_manager" style="margin-top: 10px;margin-bottom: 10px ">
                    <strong class="file_manager">Файлы </strong><i class="fa fa-file"></i></a>
            </div>
            <div class="col-md-2 col-xs-6">
                <a class="btn btn-default col-md-12 col-xs-12" href="/" target="_blank"
                   style="margin-top: 10px;margin-bottom: 10px "><strong>
                        На сайт </strong>
                    <i class="fa fa-home"></i></a>
            </div>
            <div class="col-md-2 col-xs-6">
                <button type="submit" class="btn btn-default col-md-12 col-xs-12" ng-click="logout()"
                        style="margin-top: 10px;margin-bottom: 10px "><strong>
                        Выйти </strong>
                    <i class="fa fa-sign-out"></i></button>
            </div>
            <!--NAVIGATIOn-->

            <ul class="nav nav-tabs col-md-12 col-xs-12">

                <li role="presentation" class="{{-1==active_link ? 'active':''}}" ng-click="link_menu('-1','statistic')">
                    <a href="">Статистика</a>
                </li>
                <li role="presentation" class="{{0==active_link ? 'active':''}}" ng-click="link_menu('0','albums')">
                    <a href="">Альбомы</a>
                </li>
                <li role="presentation" class="{{1==active_link ? 'active':''}}" ng-click="link_menu('1','fotos')">
                    <a href="">Картинки</a>
                </li>
                <li role="presentation" class="{{2==active_link ? 'active':''}}" ng-click="link_menu('2','articles')">
                    <a href="">Статьи</a>
                </li>

            </ul>
            <!--PAGES-->

            <!--            PAGE table-->
            <div ng-show="page">
                <div class="col-md-10 col-xs-12">
                    <h5>{{'Таблица '+title_page}}</h5>
                </div>
                <div class="col-md-2 col-xs-12" ng-show="btn_new">
                    <a class="btn btn-default col-md-10 col-xs-6 col-xs-offset-3" ng-click="new_row(title_page)"
                       style="margin-top: 10px;margin-bottom: 10px">
                        <strong>Создать </strong><i class="fa fa-plus"></i>
                    </a>
                </div>

                <div class="form-group col-md-3  col-xs-12" ng-show="table_show">
                    <label for="sort">Сортировать по:</label>
                    <select class="form-control" ng-model="table_filter" ng-change="sort_table()">
                        <option ng-repeat="item in page_data['fields'] track by $index" value="{{item}}">{{item}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3  col-xs-12" ng-show="table_show">
                    <label for="sort">Сортировать по:</label>
                    <select class="form-control" ng-model="table_desc" ng-change="sort_table()">
                        <option>По возрастанию</option>
                        <option>По убыванию</option>
                    </select>
                </div>
                <div class="form-group col-md-3  col-xs-12" ng-show="table_show">
                <label for="search">Поиск в таблице:</label>
                <input type="text" class="form-control" id="search" placeholder="" aria-describedby="sizing-addon1" ng-model="search">
                </div>
                <div class="form-group col-md-3 col-xs-12" ng-show="table_show">
                    <label for="sum">Количество записей:</label>
                    <select class="form-control" id="sum" ng-model="summ" ng-change="summ_table()">
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                        <option>Все</option>
                    </select>
                </div>

                <div class="col-md-4 col-xs-8" ng-show="table_show">
                    <ul class="pagination">
                        <li>
                            <a href="" aria-label="Previous" ng-click="prev_page()">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="">{{num_page}}</a></li>
                        <li><a href="">из</a></li>
                        <li><a href="">{{all_pages}}</a></li>
                        <li>
                            <a href="" aria-label="Next" ng-click="next_page()">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-xs-4" style="text-align: center">
                    <a href="" class="btn btn-default" ng-click="grafik_open()" ng-show="title_page=='statistic'? true:false">График</a>
                </div>
                <div class="col-md-4 col-xs-12" ng-show="table_show">
                    <label style="float: right">Всего записей: {{all_rows}}</label>
                </div>

                <div class="col-md-12 col-xs-12" style="text-align: center" ng-show="empty_table">
                    <h5>Нет записей в таблице</h5>
                </div>
                <div class="col-md-12 col-xs-12" style="overflow-x: scroll; overflow-y: scroll; height:580px;margin-bottom: 50px;" ng-show="table_show">
                    <table class="bordered col-md-12 col-xs-12" >
                        <thead>
                        <tr>
                            <th ng-repeat="item in page_data['fields'] track by $index">{{item}}</th>
                            <th ng-show="title_page=='statistic'?false:true"><i class="fa fa-edit"></i></th>
                            <th><i class="fa fa-trash"></i></th>
                        </tr>
                        </thead>
                        <tr ng-repeat="item in page_data['rows'] | filter: search">
                            <td ng-repeat="col in item track by $index" style="color: {{item['color']}}" my-bind-html="col"></td>
                            <td style="cursor: pointer" ng-click="edit_row(item[0])" ng-show="title_page=='statistic'?false:true" title="Редактировать"><i class="fa fa-edit"></i></td>
                            <td style="cursor: pointer" ng-click="delete_row(item[0])" title="Удалить"><i class="fa fa-trash"></i></td>
                        </tr>
                    </table>
                </div>


            </div>

        </div>


<!--        ADD ALBUMS-->
        <div class="col-md-12 col-xs-12 well" ng-show="add_albums" style="margin-top: 30px;">
            <div class="col-md-12">
                <h5>{{title_add}}</h5>
                <i class="fa fa-close" ng-click="close_add()" style="float: right;font-size: 25px;margin-top: -50px;cursor: pointer"></i>
            </div>
            <form novalidate name="albums" ng-submit="save()">
            <div class="col-md-6 col-xs-12">
            <label>Название альбома</label>
                <input type="text" class="form-control" ng-model="albums_name" aria-describedby="sizing-addon1" required>
            </div>

            <div class="col-md-12 col-xs-12">
                <label>Описание</label>
                    <input type="text" class="form-control" ng-model="albums_text" aria-describedby="sizing-addon1" required>
            </div>
            <div class="col-md-12 col-xs-12">
                <label>Картинка</label>
                <input type="text" readonly class="form-control" ng-model="albums_img" ng-click="file_mng()"
                       aria-describedby="sizing-addon1" required>
            </div>
                <div class="col-md-6 col-xs-6" style="margin-top: 20px">
                    <button type="submit" ng-disabled="albums.$invalid" class="col-md-12 col-xs-12 btn btn-default"><i class="fa fa-download"></i> Сохранить</button>
                </div>
                <div class="col-md-6 col-xs-6" style="margin-top: 20px">
                    <a class="btn btn-default col-md-12 col-xs-12" ng-click="close_add()"><i class="fa fa-times"></i><strong> Отмена</strong></a>
            </div>
            </form>
        </div>
        <!--        ADD FOTOS-->
        <div class="col-md-12 col-xs-12 well" ng-show="add_fotos" style="margin-top: 30px;">
            <div class="col-md-12">
                <h5>{{title_add}}</h5>
                <i class="fa fa-close" ng-click="close_add()" style="float: right;font-size: 25px;margin-top: -50px;cursor: pointer"></i>
            </div>
            <form novalidate name="fotos" ng-submit="save()">

                <div class="col-md-6 col-xs-12">
                    <label>Название альбома</label>
                    <select class="form-control" ng-model="fotos_album" required>
                        <option ng-repeat="item in page_data['rows'] track by $index" value="{{item[0]}}" my-bind-html="item[1]"></option>
                    </select>
                </div>

                <div class="col-md-6 col-xs-12">
                    <label>Картинка</label>
                    <input type="text" readonly class="form-control" ng-model="fotos_img" ng-click="file_mng()" aria-describedby="sizing-addon1" required>
                </div>
                <div class="col-md-6 col-xs-6" style="margin-top: 20px">
                    <button type="submit" ng-disabled="fotos.$invalid" class="col-md-12 col-xs-12 btn btn-default"><i class="fa fa-download"></i> Сохранить</button>
                </div>
                <div class="col-md-6 col-xs-6" style="margin-top: 20px">
                    <a class="btn btn-default col-md-12 col-xs-12" ng-click="close_add()"><i class="fa fa-times"></i><strong> Отмена</strong></a>
                </div>
            </form>
        </div>



<!--load image-->
        <div class="col-md-10 col-md-offset-1 col-xs-12 well well-sm" ng-show="show_file_mng" style="margin-top: 10px">
            <div class="col-md-12 col-xs-12">
                <h5>Выбор картинки</h5>
                <i class="fa fa-close" ng-click="close_file_mng()" style="float: right;font-size: 25px;margin-top: -50px;cursor: pointer"></i>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="input-group col-md-12 col-xs-12" style="margin-bottom: 10px">
                    <input type="text" class="form-control" ng-model="select_img" readonly>
                    <div class="input-group-btn">
                        <a class="btn btn-default" ng-click="selected_img()"><i class="fa fa-check"></i><strong> Применить</strong></a>
                    </div>
                </div>

                    <b class="col-md-10 col-xs-12">Папка {{dir_folder}}</b>
                <a class="btn btn-default col-md-2 col-xs-12" style="margin-bottom: 10px" ng-click="load_file()"><i class=" fa fa-download"></i><strong> Загрузить</strong></a>

            </div>
            <div class="col-md-12 col-xs-12 panel panel-default" style="height: {{height-250}}px;overflow-y:scroll;">
                <div class="panel-body">
                    <label class="col-md-2 col-xs-2 thumbnail" ng-show="back_folder" >
                        <img ng-click="click_back_folder()" src="images/back.png" style="height: 80px" >
                        <p  ng-click="click_back_folder()" style="font-size: 14px;height: 30px;margin-top: 5px" >Назад..</p>
                    </label>
                    <label class="col-md-2 col-xs-2 thumbnail" ng-repeat="item in list_files['folders'] track by $index" >
                        <img src="images/folder.png" style="height: 80px" ng-click="click_folder(item[0])">
                        <p ng-click="click_folder(item[0])" style="font-size: 10px;overflow: hidden;height: 30px;margin-top: 5px" >{{item[0]}}</p>
<!--                        <input type="checkbox" aria-label="..." ng-click="pick_folder(item[1])">-->
                    </label>
                    <label class="col-md-2 col-xs-2 thumbnail" ng-repeat="item in list_files['files'] track by $index" >
                        <img ng-click="click_img(item[1])" src="{{item[1] ? item[1] : ''}}"   style="height: 80px">
                        <p  ng-click="click_img(item[1])" style="font-size: 10px;overflow:hidden;height: 30px;margin-top: 5px">{{item[0]}}</p>
<!--                        <input type="checkbox" value="{{item[1]}}">-->
                    </label>
                    <div class="col-md-12 col-xs-12" style="text-align: center;margin-top: 50px" ng-show="empty_folder">
                        <h5>Папка пуста...</h5>
                    </div>
                </div>
            </div>
<!--            <div class="btn-group col-md-12 col-xs-12" role="group" aria-label="...">-->
<!--                <a class="btn btn-default" ng-click="selected_img()"><i class="fa fa-plus"></i><strong> Добавить папку</strong></a>-->
<!--                <a class="btn btn-default" ng-click="selected_img()"><i class="fa fa-download"></i><strong> Загрузить файл</strong></a>-->
<!--                <a class="btn btn-default" ng-click="delete_files()"><i class="fa fa-trash"></i><strong> Удалить файл</strong></a>-->
<!--            </div>-->
        </div>



<!--        GRAFIK-->
        <div class="col-md-12 col-xs-12 well" ng-show="grafik" style="margin-top: 10px" >
            <div class="col-md-12 col-xs-12">
                <h5>График статистики</h5>

                <i class="fa fa-close" ng-click="close_add()" style="float: right;font-size: 25px;margin-top: -50px;cursor: pointer"></i>
            </div>
            <div class="form-group col-md-4 col-xs-6" style="margin-top: -10px;">
                <label style="font-size: 12px">Начальная дата:</label>
                <input type="text" class="form-control" id="date_begin" ui-date="dateOptions" ng-model="date_begin">
            </div>
            <div class="form-group col-md-4 col-xs-6" style="margin-top: -10px;">
                <label style="font-size: 12px">Конечная дата:</label>
                <input type="text" class="form-control" id="date_end" ui-date="dateOptions2" ng-model="date_end">
            </div>
            <div class="form-group col-md-4 col-xs-6" style="margin-top: -10px;">
                <label style="font-size: 12px">Тип графика:</label>
                <select class="form-control" id="type_grafik" ng-model="type_grafik" ng-change="">
                    <option selected="selected">Часовой</option>
                    <option>Суточный</option>
                </select>
            </div>
            <div class="col-md-12 col-xs-6" style="text-align: center;margin-top: 22px">
                <a href="" class="btn btn-default" ng-click="build_graph()">Построить график</a>
            </div>
            <div class="col-md-12 col-xs-12" id="graph" style="height: {{height-300}}px;margin-top: 10px"></div>
        </div>
<!--        ////////////////////////////////-->

        <!--        error-->

        <div class="col-md-4 col-md-offset-4 col-xs-12 alert alert-danger" role="alert" ng-show="error" style="text-align: center;padding: 5px;position: absolute;top: 50px;">
            <i class="fa fa-exclamation"></i> {{title_error}}
        </div>
        <div id="preloader"  class="wow fadeIn" ng-show="loader"><span class="spinner"></span></div>

    </div>
</div>




<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>

