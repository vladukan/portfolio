


var MainSite = angular.module("MainSite", ['ngAnimate','ui.bootstrap','ngMaterial','ngMessages']);

MainSite.controller("MainCtrl", function ($scope,$http,$timeout) {

    $scope.call3=false;
    $timeout(function () {$scope.call3=true;console.log($scope.call3);}, 5000);

    if(document.documentElement.clientHeight>1000){
        $scope.height_window=document.documentElement.clientHeight*0.7;
    }else{
        $scope.height_window=document.documentElement.clientHeight*0.6;
    }
    if(document.documentElement.clientWidth>1200){
        $scope.width_window=document.documentElement.clientWidth*0.6;
    }else{
        $scope.width_window=document.documentElement.clientWidth*0.8;
    }


    //console.log($scope.height_window);

    angular.element(window).on('resize',function(){
        if(document.documentElement.clientHeight>1000){
            $scope.height_window=document.documentElement.clientHeight*0.7;
        }else{
            $scope.height_window=document.documentElement.clientHeight*0.6;
        }
        if(document.documentElement.clientWidth>1200){
            $scope.width_window=document.documentElement.clientWidth*0.6;
        }else{
            $scope.width_window=document.documentElement.clientWidth*0.8;
        }

        //console.log($scope.width_window);
    });
    $scope.portfolio_albums=false;
    $scope.portfolio_fotos=true;
    $scope.show_foto=false;
    $scope.select_album=0;
    $scope.select_article=0;

    $http.post('php/statistic.php').then(function success(data) {
        $scope.ip_user=data.data;
        //console.log($scope.ip_user);
    });

    function get_albums(){
        $http.post('https://school44.hostingerapp.com/php/get_statistic.php',{'id':$scope.select_album}).then(function success(data) {
            console.log(data);
                // $scope.id_album=data.data[0][0];
                // $scope.name_album=data.data[0][1];
                // $scope.pic_album=data.data[0][3];
                $scope.albums=data.data;
                $scope.search=[];
                for(i=0;i<data.data.length;i++){
                    $scope.search.push($scope.albums[i].id);
                }
                //$scope.search=$scope.albums[0];
                //$scope.portfolio_items=data.data;
                //console.log($scope.search);
                if(parseInt($scope.select_album)==0){
                    $scope.show_next=true;
                    $scope.show_prev=false;
                }else{
                    $scope.show_prev=true;
                }
                if(parseInt($scope.select_album)==parseInt($scope.count_table)){
                    $scope.show_next=false;
                }else{
                    $scope.show_next=true;
                }
            });
    }
    function get_articles(){
        $http.post('php/get_articles.php',{'id':$scope.select_article}).then(function success(data) {
                // $scope.id_album=data.data[0][0];
                // $scope.name_album=data.data[0][1];
                // $scope.pic_album=data.data[0][3];
                $scope.articles=data.data;
                $scope.search_article=[];
                for(i=0;i<data.data.length;i++){
                    $scope.search_article.push($scope.articles[i].id);
                }
                //$scope.search=$scope.albums[0];
                //$scope.portfolio_items=data.data;
                //console.log($scope.search);
                if(parseInt($scope.select_article)==0){
                    $scope.next_article=true;
                    $scope.prev_article=false;
                }else{
                    $scope.prev_article=true;
                }
                if(parseInt($scope.select_article)==parseInt($scope.count_articles)){
                    $scope.next_article=false;
                }else{
                    $scope.next_article=true;
                }
            });
    }
    function count_table() {
        $http.post('php/count_items.php')
            .then(function success(data) {
                // console.log(data.data)
                $scope.count_table=data.data.count;
                $scope.count_articles=data.data.articles;
            });
    }
    function get_foto(id,name) {
        $http.post('php/get_fotos.php', {'id': id}).then(function success(data) {
                //console.log(data.data);
                $scope.title1 = 'Альбом: ' + name;
                if(data.data=='null'){
                    $scope.empty_fotos=true;
                    $scope.full_fotos=false;
                }else{
                    $scope.fotos=data.data;
                    $scope.search_foto=[];
                    $scope.count_table_foto=data.data.length;
                    $scope.select_foto=0;
                    view_foto($scope.fotos[$scope.select_foto]['id']);
                    for(i=0;i<data.data.length;i++){
                        $scope.search_foto.push($scope.fotos[i].id);
                    }
                    $scope.full_fotos=true;
                    $scope.empty_fotos=false;
                }

               // console.log($scope.search_foto[$scope.select_foto]);

                if(parseInt($scope.select_foto)==0){
                    $scope.show_next_foto=true;
                    $scope.show_prev_foto=false;
                }else{
                    $scope.show_prev_foto=true;
                }
                if(parseInt($scope.select_foto)==parseInt($scope.count_table_foto)-1){
                    $scope.show_next_foto=false;
                }else{
                    $scope.show_next_foto=true;
                }
            });
    }
    function navigation() {
        if(parseInt($scope.select_album)==0){
            $scope.show_next=true;
            $scope.show_prev=false;
        }else{
            $scope.show_prev=true;
        }
        if(parseInt($scope.select_album)==parseInt($scope.count_table)-1){
            $scope.show_next=false;
        }else{
            $scope.show_next=true;
        }
    }
    function nav_art() {
        if(parseInt($scope.select_article)==0){
            $scope.next_article=true;
            $scope.prev_article=false;
        }else{
            $scope.prev_article=true;
        }
        if(parseInt($scope.select_article)==parseInt($scope.count_articles)-1){
            $scope.next_article=false;
        }else{
            $scope.next_article=true;
        }
    }
    function nav_fotos() {
        if(parseInt($scope.select_foto)==0){
            $scope.show_next_foto=true;
            $scope.show_prev_foto=false;
        }else{
            $scope.show_prev_foto=true;
        }
        if(parseInt($scope.select_foto)==parseInt($scope.count_table_foto)-1){
            $scope.show_next_foto=false;
        }else{
            $scope.show_next_foto=true;
        }
    }
    function view_foto(id) {
        $http.post('php/view_foto.php',{'id':id}).then(function success(data) {
            $scope.views_sum=data.data.sum;
            $scope.likes_sum=data.data.like;
            });
    }
    function like_foto(id) {
        data={
            'id':id,
            'ip':$scope.ip_user
        }
        $http.post('php/like_foto.php',data).then(function success(data) {
            $scope.likes_sum=data.data;
            //console.log(data.data);
        });
    }

    $scope.title1='Портфолио';
    count_table();
    get_albums();
    get_articles();

    $scope.Click_album= function (id,name) {
        get_foto(id,name);
        $scope.portfolio_fotos=false;
        $scope.portfolio_albums=true;
    }
    $scope.back_albums= function () {
        $scope.title1='Портфолио';
        $scope.portfolio_fotos=true;
        $scope.portfolio_albums=false;
        //get_albums();
    }

    $scope.view_foto=function (id) {
        $scope.show_foto=true;
        $scope.name_foto=id;
    }
    $scope.click_likes=function (id) {
        like_foto(id);
    }

    $scope.next_album=function () {
        // $scope.select_album=parseInt($scope.select_album)+1;
        // get_albums();
        $scope.select_album=parseInt($scope.select_album)+1;
        navigation();
    }
    $scope.prev_album=function () {
        $scope.select_album=parseInt($scope.select_album)-1;
        navigation();
    }
    $scope.next_art=function () {
        $scope.select_article=parseInt($scope.select_article)+1;
        nav_art();
    }
    $scope.prev_art=function () {
        $scope.select_article=parseInt($scope.select_article)-1;
        nav_art();
    }

    $scope.next_foto=function (id,name) {
        $scope.select_foto=parseInt($scope.select_foto)+1;
        nav_fotos();
        view_foto($scope.fotos[$scope.select_foto]['id']);
    }
    $scope.prev_foto=function (id,name) {
        $scope.select_foto=parseInt($scope.select_foto)-1;
        nav_fotos();
        view_foto($scope.fotos[$scope.select_foto]['id']);
    }


});
