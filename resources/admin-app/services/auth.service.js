(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('authService', authService);

    function authService($http) {
        return {
            logout: function(){
                return $http.post('/api/logout').then(function(result){
                    console.log(result);
                });
            }
        };
    }
})();