


var MainSite = angular.module("MainSite", ['ngAnimate']);
MainSite.filter('unsafe', function($sce) {
    return function(val) {
        return $sce.trustAsHtml(val);
    };
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
MainSite.controller("MainCtrl", function ($scope,$http) {
    $scope.height=window.innerHeight;
    $scope.site=true;
    $scope.call=false;
    $scope.call_form=false;
    $scope.offset_comments=0;
    $scope.btn_next_com=true;

    $scope.options = {
        language: 'ru',
        color: 'blue',
        allowedContent: true,
        entities: false
    };

    main_menu();

    $http.post('php/statistic.php').then(function success(data) {});


    function main_menu() {
        $http.post('php/site.php').then(function success(data) {
                console.log(data.data)
               $scope.main_menu=data.data;
            if($scope.offset_comments <=parseInt($scope.main_menu['limit'])){
                $scope.btn_next_com=true;
            }else{
                $scope.btn_next_com=false;
            }
            });
    }

    $scope.send_order = function () {

                $http.post('php/send_order.php', {
                    'name': $scope.name_call,
                    'phone': $scope.phone_call
                }).then(function success(data) {
                    if (data.data == 1) {
                        alert('Заявка принята, в ближайшее время с вами свяжется мастер по ремонту!');
                        $scope.name_call='';
                        $scope.phone_call='';
                        $('#modal-1').fadeOut(500);
                        $('#modal-2').fadeOut(500);
                        $('.md-overlay').fadeOut(500);
                    } else {
                        alert('Ошибка записи, повторите попытку!');
                    }
                });

    }
    $scope.call_click=function () {
        $('#modal-1').fadeIn(500);
        $('.md-overlay').fadeIn(500);
    }
    $scope.repair_click=function () {
        $('#modal-2').fadeIn(500);
    }
    $scope.send_order_page = function () {
        $('#error_order_page').fadeOut(500);
        if(!$scope.name_order_page){
            $scope.title_error='Вы не ввели Имя!';
            $('#error_order_page').fadeIn(500);
        }else{
            if(!$scope.phone_order_page){
                $scope.title_error='Вы не ввели Номер телефона!';
                $('#error_order_page').fadeIn(500);
            }else{
                $scope.preloader=true;
                $http.post('php/send_order.php', {
                    'name': $scope.name_order_page,
                    'phone': $scope.phone_order_page
                }).then(function success(data) {

                    if (data.data == 1) {
                        alert('Заявка принята, в ближайшее время с вами свяжется мастер по ремонту!');
                        $scope.name_order_page='';
                        $scope.phone_order_page='';
                    } else {
                        alert('Ошибка записи, повторите попытку!');
                    }
                    $scope.preloader=false;
                });
            }
        }
    }


});


$(window).on('load',function () {
    $('#preloader').delay(350).fadeOut('slow');
});


