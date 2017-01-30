(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('authService', authService);

    function authService($http, $auth, $state, $rootScope) {
        return {
            logout: function(){
                return $http.post('/api/logout').then(function(result){
                    $rootScope.showNavigation = false;
                    $auth.removeToken();
                    $state.go('login');
                });
            }
        };
    }
})();