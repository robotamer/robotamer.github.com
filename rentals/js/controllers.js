

function ListCtrl($scope, Item) {
    $scope.list = Item.query();
    $scope.orderProp = 'age';
}


function DetailCtrl($scope, $routeParams, Item) {
    $scope.item = Item.get({itemId: $routeParams.itemId}, function(item) {
        $scope.mainImageUrl = item.images[0];
    });

    $scope.setImage = function(imageUrl) {
        $scope.mainImageUrl = imageUrl;
    }
}

//PhoneListCtrl.$inject = ['$scope', '$http'];
