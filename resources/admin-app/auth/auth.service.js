(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('authService', authService);

    /* @ngInject */
    function authService($http, $auth, $state, $rootScope, usersService) {
        return {
            logout: function(sendRequest){
                sendRequest = sendRequest === undefined ? false :  sendRequest;

                if(sendRequest) {
                    $http.post('/logout').then(clearUserData);
                } else {
                    clearUserData();
                }
            },
            loadUserData: function () {
                usersService.getCurrentUser().then(function(result){
                    $rootScope.user = result;
                });
            }
        };

        function clearUserData() {
            $auth.removeToken();
            $state.go('login');
            $rootScope.user = undefined;
        }
    }
})();