var app = angular.module('themepark', ['ui.router']);




app.controller('MainCtrl', [
'$scope',
'$http',
function($scope,$http){
  var data = null;
  $http.get('sample.json').success(function(tdata) {
    data = tdata;
    $scope.parks = data.all_data[0].data;
    $scope.tickets = data.all_data[1].data;
    $scope.attractions = data.all_data[2].data;
    $scope.hours = data.all_data[3].data;
    $scope.employees = data.all_data[4].data;
  });
  $scope.addPark = function(){
    var data = {
      "park_code":$scope.park_code,
      "park_name":$scope.park_name,
      "park_city":$scope.park_country,
      "park_country":$scope.park_country
    };
    var url = 'add_park.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully created new park";
    })
    .error(function (data, status, header, config) {
      $scope.ResponseDetails = "An error occured"
    });
  }
  $scope.adultquantity=0;
  $scope.adultprice=0;
  $scope.childquantity=0;
  $scope.childprice=0;
  $scope.seniorquantity=0;
  $scope.seniorprice=0;
  $scope.ticketTotal = function(){
    var val = $scope.adultquantity*$scope.adultprice+$scope.childquantity*$scope.childprice+$scope.seniorquantity*$scope.seniorprice;
    if(isNaN(val)){
      return 0;
    } else {
      return val;
    }
  }
}]);

app.config([
'$stateProvider',
'$urlRouterProvider',
function($stateProvider, $urlRouterProvider) {

  $stateProvider
    .state('dashboard', {
      url: '/dashboard',
      templateUrl: '/dashboard.html',
      controller: 'MainCtrl'
    })
    .state('parks', {
      url: '/parks',
      templateUrl: '/parks.html',
      controller: 'MainCtrl'
    })
    .state('newpark', {
      url: '/newpark',
      templateUrl: '/newpark.html',
      controller: 'MainCtrl'
    })
    .state('attractions', {
      url: '/attractions',
      templateUrl: '/attractions.html',
      controller: 'MainCtrl'
    })
    .state('newattraction', {
      url: '/newattraction',
      templateUrl: '/newattraction.html',
      controller: 'MainCtrl'
    })
    .state('employees', {
      url: '/employees',
      templateUrl: '/employees.html',
      controller: 'MainCtrl'
    })
    .state('newemployee', {
      url: '/newemployee',
      templateUrl: '/newemployee.html',
      controller: 'MainCtrl'
    })
    .state('tickets', {
      url: '/tickets',
      templateUrl: '/tickets.html',
      controller: 'MainCtrl'
    })
    .state('newticket', {
      url: '/newticket',
      templateUrl: '/newticket.html',
      controller: 'MainCtrl'
    })
    .state('hours', {
      url: '/hours',
      templateUrl: '/hours.html',
      controller: 'MainCtrl'
    })
    .state('newhour', {
      url: '/newhour',
      templateUrl: '/newhour.html',
      controller: 'MainCtrl'
    })
    .state('login', {
      url: '/login',
      templateUrl: '/login.html',
      controller: 'MainCtrl'
    })

  $urlRouterProvider.otherwise('dashboard');
}]);
