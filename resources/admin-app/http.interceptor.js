(function(){
    'use strict';

    angular
        .module('adminApp')
        .factory('httpInterceptor', httpInterceptor);
    
    function httpInterceptor($q) {
        return {
            'request': function(config) {
                return config;
            },

            'responseError': function(rejection) {
                //Show good alert
                return $q.reject(rejection);
            }
        };
    }
})();

