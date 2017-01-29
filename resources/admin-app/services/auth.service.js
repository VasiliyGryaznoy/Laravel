(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('authService', authService);

    function authService($http, $auth, $state, $rootScope) {
        return {
            logout: function(){
                $auth.removeToken();
                return $http.post('/api/logout').then(function(result){
                    $state.go('login');
                    $rootScope.showNavigation = false;
                });
            }
        };
    }
})();