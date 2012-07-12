'use strict';

angular.module('Module', ['Filters', 'Services']).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/', {templateUrl: 'html/lobby.html'}).
      when('/copyright', {templateUrl: 'html/copyright.html'}).
      otherwise({redirectTo: '/'});
}]);
