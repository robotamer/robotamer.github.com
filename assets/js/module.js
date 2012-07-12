'use strict';

angular.module('Module', ['Filters', 'Services']).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/lobby', {templateUrl: '/assests/html/lobby.html'}).
      when('/copyright', {templateUrl: '/assests/html/copyright.html'}).
      otherwise({redirectTo: '/lobby'});
}]);
