'use strict';

angular.module('Module', ['Filters', 'Services']).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/list', {templateUrl: 'html/list.html',   controller: ListCtrl}).
      when('/item/:itemId', {templateUrl: 'html/detail.html', controller: DetailCtrl}).
      otherwise({redirectTo: '/list'});
}]);


/* Services */
angular.module('Services', ['ngResource']). factory('Item', function($resource){
    return $resource('/rentals/phones/:itemId.json', {}, {
        query: {method:'GET', params:{itemId:'phones'}, isArray:true}
    });
});


/* Filters */
angular.module('Filters', []).filter('checkmark', function() {
    return function(input) {
        return input ? '\u2713' : '\u2718';
    };
});
