(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('LoginCtrl', LoginCtrl);

    LoginCtrl.$inject = ['$auth', '$state'];

    function LoginCtrl($auth, $state) {
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