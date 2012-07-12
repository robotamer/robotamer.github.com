'use strict';

angular.module('Module', []).
  config(['$routeProvider', function($routeProvider, $locationProvider) {
  $routeProvider.
      when('/lobby', {templateUrl: '/assets/html/lobby.html', controller: ChapterCntl}).
      when('/copyright', {templateUrl: '/assets/html/copyright.html', controller: BookCntl}).
      otherwise({redirectTo: '/lobby'});
}]);

angular.module('Module2', [], function($routeProvider, $locationProvider) {
    $routeProvider.when('/lobby', {
    templateUrl: '/assets/html/lobby.html',
    controller: BookCntl
    });
    $routeProvider.when('/copyright', {
    templateUrl: '/assets/html/copyright.html',
    controller: ChapterCntl
    });
     
    // configure html5 to get links working on jsfiddle
    $locationProvider.html5Mode(true);
    });
     
    function MainCntl($scope, $route, $routeParams, $location) {
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
    }
     
    function BookCntl($scope, $routeParams) {
    $scope.name = "BookCntl";
    $scope.params = $routeParams;
    }
     
    function ChapterCntl($scope, $routeParams) {
    $scope.name = "ChapterCntl";
    $scope.params = $routeParams;
    }