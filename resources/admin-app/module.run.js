(function(){
    'use strict';

    angular
        .module('adminApp')
        .run(run);

    function run($rootScope, $auth, $state, $injector) {
        console.log($auth.isAuthenticated());


    }
})();