'use strict';

angular.module('Module', ['Filters', 'Services']).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/lobby', {templateUrl: '/assets/html/lobby.html'}).
      when('/copyright', {templateUrl: '/assets/html/copyright.html'}).
      otherwise({redirectTo: '/lobby'});
}]);
