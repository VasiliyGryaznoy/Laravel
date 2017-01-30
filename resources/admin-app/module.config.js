(function(){
    angular
        .module('adminApp')
        .config(function($httpProvider, $authProvider){
            $httpProvider.interceptors.push('httpInterceptor');
            $authProvider.storageType = 'localStorage';
            $authProvider.loginUrl = '/api/authenticate';
            $authProvider.signupUrl = '/api/signup';

    });
})();