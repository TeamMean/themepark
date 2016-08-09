var app = angular.module("journalApp", ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
        $routeProvider.when("/", {
                templateUrl: "pages/ng-login.html",
                controller: "MainCtrl"
        });

        $locationProvider.html5Mode({
                enabled: false,
                requireBase: false
        });
});

app.controller("MainCtrl", ["$scope", "$http", function($scope, $http) {

        $scope.error = "Hello";


}]);

app.controller("latestCtrl", ["$scope", function($scope) {
        $scope.errors = "This page will show the latest post";
}]);

app.controller("dateCtrl", ["$scope", function($scope) {
        $scope.errors = "This page will allow you to select a post by date";
}]);

app.controller("createCtrl", ["$scope", "$http", function($scope, $http) {
        $scope.pdata = {title: "", text: "", password: ""};
        $scope.post = function()
        {
                if($scope.pdata.title == "" || $scope.pdata.text == "" || $scope.pdata.password == "")
                {
                        $scope.errors = "There is some data missing.";
                }
                else
                {
                        $scope.errors = "Submitting...";
                        var res = $http.post("/post", {title: $scope.pdata.title, text: $scope.pdata.text, password: $scope.pdata.password});

                        res.success(function(data, headers, status, config) {
                                $scope.errors = data;
                        });
                        res.error(function(data, headers, status, config) {
                                $scope.errors = data;
                        })
                }
        };
}]);

