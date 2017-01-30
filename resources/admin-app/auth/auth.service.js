(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('authService', authService);

    /* @ngInject */
    function authService($http, $auth, $state, $rootScope) {
        return {
            logout: function(sendRequest){
                sendRequest = sendRequest === undefined ? false :  sendRequest;

                if(sendRequest) {
                    $http.post('/api/logout').then(clearUserData);
                } else {
                    clearUserData();
                }
            }
        };

        function clearUserData() {
            $auth.removeToken();
            $state.go('login');
        }
    }
})();