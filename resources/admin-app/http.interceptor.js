(function(){
    'use strict';

    angular
        .module('adminApp')
        .factory('httpInterceptor', httpInterceptor);
    
    function httpInterceptor($q) {
        return {
            'responseError': function(rejection) {
                console.log('-----');
                console.log(arguments);
                console.log('-----');
                return $q.reject(rejection);
            }
        };
    }
})();

