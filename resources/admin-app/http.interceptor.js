(function(){
    'use strict';

    angular
        .module('adminApp')
        .factory('httpInterceptor', httpInterceptor);
    
    function httpInterceptor($q) {
        return {
            'request': function(config) {
                if(config.url.indexOf('.html') === -1)
                    config.url = '/api' + config.url;

                return config;
            },

            'responseError': function(rejection) {
                //Show good alert
                return $q.reject(rejection);
            }
        };
    }
})();

