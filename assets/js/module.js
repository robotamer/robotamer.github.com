

angular.module('Module', [], function($routeProvider, $locationProvider) {

    $routeProvider.when('', {
	templateUrl: '/assets/html/lobby.html', 
	controller: LobbyCntl
    });

    $routeProvider.when('/Copyright', {
	templateUrl: '/assets/html/copyright.html', 
	controller: CopyrightCntl
    });

    $routeProvider.otherwise({redirectTo: ''});

});

function MainCntl($scope, $route, $routeParams, $location) {
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
}
     
function LobbyCntl($scope, $route, $routeParams, $location) {
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
}
     
function CopyrightCntl($scope, $routeParams) {
    $scope.name = "CopyrightCntl";
    $scope.params = $routeParams;
}
