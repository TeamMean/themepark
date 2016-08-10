var app = angular.module('themepark', ['ui.router']);

app.controller('MainCtrl', [
'$scope',
'$http',
function($scope,$http){
  var data = null;
  $scope.login = function(){
    $http.get('sample.json').success(function(tdata) {
      data = tdata;
      $scope.parks = data.all_data[0].data;
      $scope.tickets = data.all_data[1].data;
      $scope.attractions = data.all_data[2].data;
      $scope.hours = data.all_data[3].data;
      $scope.employees = data.all_data[4].data;
      $scope.user = data.user_data;
      $scope.privilege = $scope.user[2].data[0].emp_priv;
    });
  }



  $scope.addPark = function(){
    var data = {
      "park_code":$scope.park_code,
      "park_name":$scope.park_name,
      "park_city":$scope.park_city,
      "park_country":$scope.park_country
    };
    var url = 'php/add_park.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully created new park";
      $scope.resetpark();
    })
    .error(function (data, status, header, config) {
      $scope.ResponseDetails = "An error occured"
    });
  };

  $scope.updatepark = function(data){
    var url = 'php/edit_park.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully made changes to park";
      $scope.resetpark();
    })
    .error(function (data, status, header, config) {
      $scope.PostDataResponse = "An error occured"
    });
  };

  $scope.resetpark = function(){
    $scope.park_code = '';
    $scope.park_name = '';
    $scope.park_city = '';
    $scope.park_country = '';
  }
  $scope.addattraction = function(){
    var data = {
      "attract_no": $scope.attraction_no,
			"attract_name": $scope.attraction_name,
			"attract_age": $scope.attraction_age,
			"attract_capacity": $scope.attraction_capacity,
			"park_code": $scope.attraction_park_code
    };
    var url = 'php/add_attraction.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully created new attraction";
      $scope.resetattraction();
    })
    .error(function (data, status, header, config) {
      $scope.ResponseDetails = "An error occured"
    });
  };

  $scope.editattraction = function(data){
    var url = 'php/edit_attraction.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully modified attractions";
      $scope.resetattraction();
    })
    .error(function (data, status, header, config) {
      $scope.ResponseDetails = "An error occured"
    });
  };

  $scope.editemployee = function(data){
    var url = 'php/addemployee.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully created new employee";
      $scope.resetemployee();
    })
    .error(function (data, status, header, config) {
      $scope.ResponseDetails = "An error occured"
    });
  }
  $scope.resetattraction = function(){
    $scope.attraction_no = '';
    $scope.attraction_name = '';
    $scope.attraction_age = '';
    $scope.attraction_capacity = '';
    $scope.attraction_park_code = '';
  }

  $scope.addemployee = function(){
    if($scope.emp_passwd===$scope.emp_confirm){
      var data = {
        "emp_num":$scope.emp_num,
        "emp_title":$scope.emp_title,
        "emp_fname":$scope.emp_fname,
        "emp_lname":$scope.emp_lname,
        "emp_area_code":$scope.emp_area_code,
        "emp_phone":$scope.emp_phone,
        "emp_dob":$scope.emp_dob,
        "emp_hire_date":$scope.emp_hire_date,
        "emp_passwd":$scope.emp_passwd
      };
      var url = 'php/addemployee.php';
      var config = {
        headers : {
          'Content-Type': 'application/json;charset=utf-8;'
        }
      };
      $http.post(url, data, config)
      .success(function (data, status, headers, config) {
        $scope.PostDataResponse = "Successfully created new employee";
        $scope.resetemployee();
      })
      .error(function (data, status, header, config) {
        $scope.ResponseDetails = "An error occured"
      });
    } else {
      $scope.ResponseDetails = 'Passwords do not match';
    }
  }

  $scope.resetemployee = function(){
    $scope.emp_num = '';
    $scope.emp_title = '';
    $scope.emp_fname = '';
    $scope.emp_lname = '';
    $scope.emp_area_code = '';
    $scope.emp_phone = '';
    $scope.emp_dob = '';
    $scope.emp_hire_date = '';
    $scope.emp_passwd = '';
    $scope.emp_confirm = '';
  }

  $scope.addtickets = function(){
    var data = {
      "adults": {"quantity":$scope.adultquantity,"price":$scope.adultprice},
      "children":{"quantity":$scope.childquantity,"price":$scope.childprice},
      "seniors":{"quantity":$scope.seniorquantity,"price":$scope.seniorprice},
      "emp_num": $scope.user[2].data[0].emp_num
    };
    var url = 'php/addtickets.php';
    var config = {
      headers : {
        'Content-Type': 'application/json;charset=utf-8;'
      }
    };
    $http.post(url, data, config)
    .success(function (data, status, headers, config) {
      $scope.PostDataResponse = "Successfully created new tickets";
      $scope.resettickets();
    })
    .error(function (data, status, header, config) {
      $scope.ResponseDetails = "An error occured"
    });
  }

  $scope.resetalltickets = function(){
    $scope.adultprice = 0;
    $scope.adultquantity = 0;
    $scope.childprice = 0;
    $scope.childquantity = 0;
    $scope.seniorprice = 0;
    $scope.seniorquantity = 0;
    $scope.ticket_park_code = '';
  }
  $scope.resettickets = function(){
    $scope.adultquantity = 0;
    $scope.childquantity = 0;
    $scope.seniorquantity = 0;
}

$scope.addhours = function(){
  var data = {
    "attract_no": $scope.hour_attraction_code,
    "date_worked": $scope.date_worked,
    "hour_rate": $scope.hour_rate,
    "hours_per_attract": $scope.hours_per_attract,
    "emp_num": $scope.user[2].data[0].emp_num
  };
  var url = 'php/addhours.php';
  var config = {
    headers : {
      'Content-Type': 'application/json;charset=utf-8;'
    }
  };
  $http.post(url, data, config)
  .success(function (data, status, headers, config) {
    $scope.PostDataResponse = "Successfully changed hours";
    $scope.resethours();
  })
  .error(function (data, status, header, config) {
    $scope.ResponseDetails = "An error occured"
  });
}

$scope.edithours = function(data){
  var url = 'php/edithours.php';
  var config = {
    headers : {
      'Content-Type': 'application/json;charset=utf-8;'
    }
  };
  $http.post(url, data, config)
  .success(function (data, status, headers, config) {
    $scope.PostDataResponse = "Successfully added hours";
    $scope.resethours();
  })
  .error(function (data, status, header, config) {
    $scope.ResponseDetails = "An error occured"
  });
}

$scope.deleteattract = function(data){
  var url = 'php/delete_attract.php';
  var config = {
    headers : {
      'Content-Type': 'application/json;charset=utf-8;'
    }
  };
  $http.post(url, data, config)
  .success(function (data, status, headers, config) {
    $scope.PostDataResponse = "Successfully delete attraction";
    $scope.resethours();
  })
  .error(function (data, status, header, config) {
    $scope.ResponseDetails = "An error occured"
  });
};

$scope.deleteempl = function(data){
  var url = 'php/delete_emp.php';
  var config = {
    headers : {
      'Content-Type': 'application/json;charset=utf-8;'
    }
  };
  $http.post(url, data, config)
  .success(function (data, status, headers, config) {
    $scope.PostDataResponse = "Successfully deleted employee";
    $scope.resethours();
  })
  .error(function (data, status, header, config) {
    $scope.ResponseDetails = "An error occured"
  });
};

$scope.deletehour = function(data){
  var url = 'php/delete_hours.php';
  var config = {
    headers : {
      'Content-Type': 'application/json;charset=utf-8;'
    }
  };
  $http.post(url, data, config)
  .success(function (data, status, headers, config) {
    $scope.PostDataResponse = "Successfully deleted hours";
    $scope.resethours();
  })
  .error(function (data, status, header, config) {
    $scope.ResponseDetails = "An error occured"
  });
};

$scope.resethours = function(){
  $scope.hour_attraction_code = '';
  $scope.date_worked = '';
  $scope.hour_rate = '';
  $scope.hours_per_attract = '';
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
