(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('AuthCtrl', AuthCtrl);

    AuthCtrl.$inject = ['$auth', '$state'];

    function AuthCtrl($auth, $state) {
        var vm = this;

        vm.login = login;

        vm.credentials = {
            email: '',
            password: ''
        };

        function login() {
            $auth.login(vm.credentials).then(function(data) {
                $state.go('dashboard', {});
            });
        }
    }
})();