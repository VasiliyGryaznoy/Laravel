(function(){
    angular
        .module('adminApp')
        .config(function($httpProvider){
            $httpProvider.interceptors.push('httpInterceptor');
    });
})();