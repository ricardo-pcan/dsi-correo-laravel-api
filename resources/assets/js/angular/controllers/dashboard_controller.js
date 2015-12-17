app.controller( 'DashboardController', [
                                        '$scope',
                                        '$http',
                                        '$templateCache',
                                        'DTOptionsBuilder',
                                        'DTColumnBuilder',
                                        function( $scope,
                                                 $http,
                                                 $templateCache,
                                                 DTOptionsBuilder,
                                                 DTColumnBuilder
                                        )
{
    // Get the request

    $http({
        method: 'GET',
        url: location.origin + '/requests',
    })
    .then( function( response ){
        $scope.requests = response.data.data;
    })
}]);
