(function(){
    'use strict';

    angular
        .module('adminApp')
        .run(run);

    function run($rootScope, $auth, $state, authService, statesWithoutAuthenticated) {

        $rootScope.$on('$stateChangeStart', function (event, toState, toParams) {

            if(!$auth.isAuthenticated() && statesWithoutAuthenticated.indexOf(toState.name) === -1) {
                $rootScope.showNavigation = false;
                authService.logout();
                event.preventDefault();
                $state.go('login');
            } else if($auth.isAuthenticated() && statesWithoutAuthenticated.indexOf(toState.name) !== -1) {
                $rootScope.showNavigation = true;
                event.preventDefault();
                $state.go('dashboard');
            } else if($auth.isAuthenticated()) {
                $rootScope.showNavigation = true;
            }
        });
    }
})();