(function(){
    'use strict';

    angular
        .module('adminApp')
        .run(run);

    function run($rootScope, $auth, $state, authService, statesWithoutAuthenticated) {

        $rootScope.$on('$stateChangeStart', changeStateHandler);

        $rootScope.logout = logout;

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
        }

        function logout(){
            authService.logout(true);
        }
    }
})();