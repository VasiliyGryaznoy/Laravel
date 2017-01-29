(function(){
    'use strict';

    angular
        .module('adminApp')
        .run(run);

    function run($rootScope, $auth, $state, authService, statesWithoutAuthenticated) {

        $rootScope.$on('$stateChangeStart', changeStateHandler);

        function changeStateHandler(event, toState, toParams) {
            if(!$auth.isAuthenticated() && statesWithoutAuthenticated.indexOf(toState.name) === -1) {
                event.preventDefault();
                authService.logout();
            } else if($auth.isAuthenticated() && statesWithoutAuthenticated.indexOf(toState.name) !== -1) {
                $rootScope.showNavigation = true;
                event.preventDefault();
                $state.go('dashboard');
            } else if($auth.isAuthenticated()) {
                $rootScope.showNavigation = true;
            }

            if(toState.name === 'logout') {
                event.preventDefault();
                authService.logout();
            }
        }
    }
})();