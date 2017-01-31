(function(){
    'use strict';

    angular
        .module('adminApp')
        .run(run);

    function run($rootScope, $auth, $state, authService, statesWithoutAuthenticated, $urlRouter) {

        $rootScope.$on('$stateChangeStart', changeStateHandler);

        $rootScope.logout = logout;



        function changeStateHandler(event, toState, toParams) {
            //TODO.
            if($auth.isAuthenticated() && $rootScope.user === undefined) {
                authService.loadUserData();
            }

            if(!$auth.isAuthenticated() && statesWithoutAuthenticated.indexOf(toState.name) === -1) {
                event.preventDefault();
                authService.logout();
            } else if($auth.isAuthenticated() && statesWithoutAuthenticated.indexOf(toState.name) !== -1) {
                event.preventDefault();
                $state.go('dashboard');
            }
        }

        function logout(){
            authService.logout(true);
        }
    }
})();