var MainSite = angular.module("MainSite", ['ngAnimate', 'ckeditor','ui.date']);


MainSite.controller("MainCtrl", function ($scope, $http, $filter) {

    $scope.log=function () {
        console.log($scope.name_text_headers);
    }
    $scope.height=window.innerHeight;
    $scope.sort_desc=0;

    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $scope.dateOptions = {
        dateFormat: 'yy-mm-dd'
    }
    $scope.dateOptions2 = {
        dateFormat: 'yy-mm-dd'
    }
    // Editor options.
    $scope.options = {
        language: 'ru',
        color: 'blue',
        allowedContent: true,
        entities: false
    };

    // Called when the editor is completely ready.
    $scope.onReady = function () {
        // ...
    };

    document.title = 'Вход в панель управления';
    $scope.error_login = false;
    $scope.admin_panel = false;

    if (sessionStorage.getItem('user')) {
        $scope.btn_new=true;
        $scope.summ = '10';
        $scope.table_desc = 'По убыванию';
        $scope.table_filter = 'ID';
        $scope.title_page = 'albums';
        $scope.active_link = 0;
        $scope.num_page = 1;
        $scope.type_grafik='Часовой';
        $scope.enter_panel = false;
        $scope.admin_panel = true;
        document.title = 'Панель управления';
            get_data($scope.title_page, $scope.table_filter,$scope.table_desc);

    } else {
        $scope.enter_panel = true;
        $scope.admin_panel = false;

    }

// AUTH ///////////////////////////
    $scope.login = function () {
        $scope.error_login = false;

        if (!$scope.name || !$scope.password) {
            $scope.error_login = true;
        } else {
            $http.post('php/login.php', {'login': $scope.name, 'password': $scope.password}).then(function success(data) {
                    //console.log(data);
                    if (data.data == "0") {
                        $scope.error_login = true;
                        $scope.enter_panel = true;
                    } else {
                        sessionStorage.setItem('user', $scope.name);
                        //console.log(sessionStorage.getItem('user'));
                        $scope.btn_new=true;
                        $scope.summ = '10';
                        $scope.table_desc = 'По убыванию';
                        $scope.table_filter = 'ID';
                        $scope.title_page = 'albums';
                        $scope.active_link = 0;
                        $scope.num_page = 1;
                        $scope.type_grafik='Часовой';
                        $scope.enter_panel = false;
                        $scope.admin_panel = true;
                        document.title = 'Панель управления';
                        get_data($scope.title_page, $scope.table_filter,$scope.table_desc);
                        $scope.title = 'Панель управления';
                        $scope.enter_panel = false;
                        $scope.admin_panel = true;


                    }
                });
        }
    }
    $scope.logout = function () {
        sessionStorage.clear();
        $scope.admin_panel = false;
        $scope.title = 'Вход в панель управления';
        $scope.enter_panel = true;
    }
///////////////////////////////////

    $scope.link_menu = function (id, link) {
        $scope.btn_new=true;
        $scope.page = false;
        $scope.title_page = link;
        $scope.active_link = id;
        //main_menu($scope.active_link);
        $scope.table_filter = 'ID';
        switch (link){
            //case 'orders':  $scope.btn_new=false; break;
            case 'statistic':  $scope.btn_new=false; break;
            default: $scope.btn_new=true; break;
        }
        get_data(link, $scope.table_filter,$scope.table_desc);

    }
/////NEW
    $scope.new_row = function (table) {
        //console.log($scope.title);
        $scope.admin_panel = false;
        $scope.update = 0;
        $scope.error=false;
        switch (table) {
            case 'albums':
                $scope.albums_name = '';
                $scope.albums_text = '';
                $scope.albums_img = '';
                $scope.add_albums = true;
                document.title = 'Добавление Альбома';
                $scope.title_add = 'Добавление Альбома';
                break;
            case 'fotos':
                get_data('albums','ID','По возрастанию');
                $scope.fotos_album = '';
                $scope.fotos_img = '';
                $scope.add_fotos = true;
                document.title = 'Добавление Картинки';
                $scope.title_add = 'Добавление Картинки';
                break;


        }
        //console.log($scope.title);
    }
///////SAVE
    $scope.save = function () {
        $scope.error = false;
        switch ($scope.title_page){
            case 'albums':
                data = {
                    'table': $scope.title_page,
                    'name': $scope.albums_name,
                    'text': $scope.albums_text,
                    'img': $scope.albums_img,
                    'update': $scope.update,
                    'id': $scope.id_item
                }
                break;
            case 'fotos':
                data = {
                    'table': $scope.title_page,
                    'name': $scope.fotos_album,
                    'img': $scope.fotos_img,
                    'update': $scope.update,
                    'id': $scope.id_item
                }
                break;
        }
        $http.post('php/add.php', data).then(function success(data) {
            if (data.data == 1) {
                get_data($scope.title_page, $scope.table_filter,$scope.table_desc);
                switch ($scope.title_page){
                    case 'albums':  $scope.add_albums = false; break;
                    case 'fotos':  $scope.add_fotos = false; break;
                }
                $scope.admin_panel = true;
                alert('Запись успешно сохранена!');
            } else {
                $scope.error = true;
                $scope.title_error = 'Ошибка записи';
            }
        });
    }
//////// EDITING
    $scope.edit_row = function (id) {
        $scope.admin_panel = false;
        $scope.update = 1;
        $scope.error = false;
        data={
            'id':id,
            'table': $scope.title_page
        }
        switch ($scope.title_page) {
            case 'albums':
                $http.post('php/get_for_edit.php', data).then(function success(data) {
                    //console.log(data.data[1]);
                    $scope.albums_name = data.data[1];
                    $scope.albums_text = data.data[2];
                    $scope.albums_img = data.data[3];
                    $scope.id_item = data.data[0];
                    $scope.add_albums = true;
                    document.title = 'Редактирование Альбома';
                    $scope.title_add = 'Редактирование Альбома';
                });
                break;
            case 'fotos':
                $http.post('php/get_for_edit.php', data).then(function success(data) {
                    //console.log(data.data[1]);
                    get_data('albums','ID','По возрастанию');
                    $scope.fotos_album = data.data[1];
                    $scope.fotos_img = data.data[2];
                    $scope.id_item = data.data[0];
                    $scope.add_fotos = true;
                    document.title = 'Редактирование Картинки';
                    $scope.title_add = 'Редактирование Картинки';
                });
                break;
        }

    }
    ///// DELETE
    $scope.delete_row = function (id) {
        $http.post('php/delete_item.php', {'id': id, 'table': $scope.title_page}).then(function success(data) {
            if (data.data == 1) {
                get_data($scope.title_page,$scope.table_filter);
                $http.post('php/main_menu.php').then(function success(data) {
                    $scope.menu = data.data;
                });
                alert('Запись успешно удалена');
            } else {
                alert('Ошибка удаления!');
            }
            //console.log(data.data);

        });
    }

/////////////////////////// MAIN MENU
    $scope.close_add=function () {
        document.title = 'Панель управления';
        $scope.error = false;
        $scope.admin_panel = true;
        switch ($scope.title_page){
            case 'albums': $scope.add_albums = false; break;
            case 'fotos': $scope.add_fotos= false; get_data('fotos','ID',$scope.table_desc);break;
            case 'statistic': $scope.grafik=false; break;
        }
    }


////////////////////////////////

// NAVIGATION
    $scope.send_order = function () {
        $http.post('php/send_order.php', {
            'name': $scope.name_order,
            'phone': $scope.phone_order
        }).then(function success(data) {
            if (data.data == 1) {
                alert('Заявка принята, в ближайшее время с вами свяжется мастер по ремонту!');
            } else {
                alert('Ошибка записи, повторите попытку!');
            }
        });
    }
    $scope.sort_table = function () {
        get_data($scope.title_page, $scope.table_filter,$scope.table_desc);
    }
    $scope.summ_table = function () {
        $scope.num_page = 1;
        get_data($scope.title_page, $scope.table_filter);
    }
    $scope.next_page = function () {
        if ($scope.num_page == $scope.all_pages) {
            get_data($scope.title_page, $scope.table_filter);
        } else {
            $scope.num_page = $scope.num_page + 1;
            get_data($scope.title_page, $scope.table_filter);
        }
    }
    $scope.prev_page = function () {
        if ($scope.num_page == 1) {
            get_data($scope.title_page, $scope.table_filter);
        } else {
            $scope.num_page = $scope.num_page - 1;
            get_data($scope.title_page, $scope.table_filter);
        }
    }
//////////////////////////////////////////////
    // GRAFIK
    $scope.grafik_open=function () {
        $scope.admin_panel=false;
        $scope.grafik=true;
        var date = new Date();
        date_begin=date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
        date.setDate(date.getDate()+1);
        date_end=date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
        $scope.begin_graph=date_begin;
        $scope.end_graph=date_end;
        data={
            'date_begin': date_begin,
            'date_end': date_end,
            'type': $scope.type_grafik
        }
        $http.post('php/graph.php', data).then(function success(data) {
            //console.log(data);
            var options = {
                chart: {
                    renderTo: 'graph',
                    type: 'column',
                    zoomType: 'x'
                },

                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            borderRadius: 4,
                            backgroundColor: 'rgba(252,255,197,0.7)',
                            borderWidth: 1,
                            borderColor: '#AAA',
                            y: -10,
                            shape: 'callout'
                        }
                    }
                },
                rangeSelector: {
                    buttons: [{
                        type: 'hour',
                        count: 1,
                        text: 'Час'
                    }, {
                        type: 'day',
                        count: 1,
                        text: 'День'
                    }, {
                        type: 'all',
                        count: 1,
                        text: 'Всё'
                    }],
                    selected: 1,
                    inputEnabled: false
                },
                title: {
                    text: 'Статистика с '+ $scope.begin_graph+' по '+ $scope.end_graph,
                    align: 'center'
                },
                legend: {
                    enabled: false,
                    align: 'left',
                    backgroundColor: '#FCFFC5',
                    layout: 'vertical',
                    verticalAlign: 'center',
                    y: 30,
                    shadow: true
                },
                series: [{}]
            };
            //
            $.getJSON('php/data.json', function (data) {
                options.series[0].data = data;
                options.series[0].tooltip = {valueDecimals: 0};
                var chart = new Highcharts.stockChart(options);
            });
        });
    }
    $scope.build_graph=function () {
        $scope.error = false;
        if(!$scope.date_begin){
            $scope.error = true;
            $scope.title_error = 'Выберите начальную дату';
        }else{
            if(!$scope.date_end){
                $scope.error = true;
                $scope.title_error = 'Выберите конечную дату';
            }else{
                data={
                    'date_begin': $scope.date_begin,
                    'date_end': $scope.date_end,
                    'type': $scope.type_grafik
                }
                $http.post('php/graph.php', data).then(function success(data) {
                    //console.log(data);
                    $scope.begin_graph=$scope.date_begin.getDate()+'.'+($scope.date_begin.getMonth()+1)+'.'+$scope.date_begin.getFullYear();
                    $scope.end_graph=$scope.date_end.getDate()+'.'+($scope.date_end.getMonth()+1)+'.'+$scope.date_end.getFullYear();
                    var options = {
                        chart: {
                            renderTo: 'graph',
                            type: 'column',
                            zoomType: 'x'
                        },

                        plotOptions: {
                            series: {
                                dataLabels: {
                                    enabled: true,
                                    borderRadius: 4,
                                    backgroundColor: 'rgba(252,255,197,0.7)',
                                    borderWidth: 1,
                                    borderColor: '#AAA',
                                    y: -10,
                                    shape: 'callout'
                                }
                            }
                        },
                        rangeSelector: {
                            buttons: [{
                                type: 'hour',
                                count: 1,
                                text: 'Час'
                            }, {
                                type: 'day',
                                count: 1,
                                text: 'День'
                            }, {
                                type: 'all',
                                count: 1,
                                text: 'Всё'
                            }],
                            selected: 1,
                            inputEnabled: false
                        },
                        title: {
                            text: 'Статистика с '+ $scope.begin_graph+' по '+ $scope.end_graph,
                            align: 'center'
                        },
                        legend: {
                            enabled: false,
                            align: 'left',
                            backgroundColor: '#FCFFC5',
                            layout: 'vertical',
                            verticalAlign: 'center',
                            y: 30,
                            shadow: true
                        },
                        series: [{}]
                    };
                    //
                    $.getJSON('php/data.json', function (data) {
                        options.series[0].data = data;
                        options.series[0].tooltip = {valueDecimals: 0};
                        var chart = new Highcharts.stockChart(options);
                    });
                });
            }
        }
    }
    /////////////////////

    // file mng
    $scope.file_mng=function () {
        sessionStorage.setItem('files','');
        $scope.pick_file=[];
        $scope.dir_folder='../ckfinder/userfiles';
        $scope.dir_folder_now='';
        get_list_files();
        $scope.back_folder=false;
        switch ($scope.title_page){
            case 'albums': $scope.add_albums = false; break;
            case 'fotos': $scope.add_fotos = false; break;
        }
        $scope.show_file_mng = true;
        $scope.error=false;
    }
    $scope.click_folder=function (name) {
        $scope.dir_folder_now=name;
        $scope.dir_folder=$scope.dir_folder+'/'+name;
        $scope.back_folder=true;
        get_list_files();
        $scope.error=false;
    }
    $scope.load_file=function (name) {
        CKFinder.modal({
            chooseFiles: true,
            width: 800,
            height: 600
        });
    }
    $scope.click_back_folder=function () {
        $scope.dir_folder=$scope.dir_folder.slice(0,$scope.dir_folder.length-$scope.dir_folder_now.length-1);
        str=$scope.dir_folder.split('/');
        $scope.dir_folder_now=str[str.length-1];
        if($scope.dir_folder=='.'||$scope.dir_folder=='..'||$scope.dir_folder==''||$scope.dir_folder=='../ckfinder/userfi'||$scope.dir_folder=='../ckfinder/'){
            $scope.dir_folder='../ckfinder/userfiles';
        }
        if($scope.dir_folder=='../ckfinder/userfiles'){
            $scope.back_folder=false;
        }else{
            $scope.back_folder=true;
        }
        get_list_files();
        $scope.error=false;
    }
    $scope.click_img=function (url) {
        $scope.select_img=url;
        $scope.error=false;
    }
    $scope.selected_img=function () {
        $scope.error=false;
        if($scope.select_img==''){
            $scope.title_error='Выберите картинку и нажмите применить!';
            $scope.error=true;
        }else{
            switch ($scope.title_page){
                case 'albums': $scope.albums_img=$scope.select_img; $scope.add_albums=true; break;
                case 'fotos': $scope.fotos_img=$scope.select_img; $scope.add_fotos=true; break;
            }
            $scope.show_file_mng=false;
            $scope.error=false;
        }
    }
    $scope.close_file_mng=function () {
        switch ($scope.title_page){
            case 'albums': $scope.add_albums = true; break;
            case 'fotos': $scope.add_fotos = true; break;
        }
        $scope.show_file_mng = false;
        $scope.error=false;
    }

    // FUNCTION////////////
    function get_data(id, column,sort) {
        $scope.page=false;
        $scope.loader=true;

        if(sort=='По возрастанию'){
            $scope.sort_desc=0;
        }else{
            $scope.sort_desc=1;
        }

        if ($scope.num_page == 1) {
            $scope.begin = 0;
        } else {
            $scope.begin = ($scope.num_page - 1) * $scope.summ;
        }
        data = {
            'table': id,
            'id': column,
            'begin': $scope.begin,
            'end': $scope.summ,
            'desc': $scope.sort_desc
        }
        $http.post('php/get_date.php', data).then(function success(data) {

            if (data.data['rows']) {
                $scope.page_data = data.data;

                //console.log(data.data);
                if (id == 'orders') {
                    for (i = 0; i < data.data['rows'].length; i++) {
                        if (data.data['rows'][i][4] == 'Не выполнено') {
                            data.data['rows'][i]['color'] = 'red';
                        } else {
                            data.data['rows'][i]['color'] = 'green';
                        }
                    }
                }
                $scope.all_pages = data.data['pages'];
                $scope.all_rows = data.data['all_rows'];
                $scope.empty_table = false;
                $scope.table_show = true;
            } else {
                $scope.empty_table = true;
                $scope.table_show = false;
            }
            $scope.loader=false;
            $scope.page = true;

        });

    }
    function get_list_files() {
        data={
            'str':$scope.dir_folder
        }
        $http.post('php/file_scan.php', data).then(function success(data) {
                $scope.list_files=data.data;
                //console.log(data.data.length);
                if(data.data.length==0){
                    $scope.empty_folder=true;
                }else{
                    $scope.empty_folder=false;
                }
            });
    }
    /////////////////

});

MainSite.directive('myBindHtml', function() {
        return {
            restrict: "A",
            scope: {
                myBindHtml: "="
            },
            link: function(scope, elem) {
                scope.$watch('myBindHtml', function(newVal) {
                    //Здесь можете делать любые преобразования текста перед выводом.
                    elem.html(newVal);
                });
            }
        };
    });
$(document).ready(function () {
    $('body').click(function (event) {
        if (event.target.className == 'file_manager'||event.target.id == 'file_manager'||event.target.id == 'load_file') {
            CKFinder.modal({
                chooseFiles: true,
                width: 800,
                height: 600
            });
        }
    });
});

