(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('LoginController', LoginController);

    /* @ngInject */
    function LoginController($auth, $state, $validation, $scope) {
        var vm = this;

        vm.login = login;
        vm.validateLogin = validateLogin;

        vm.credentials = {
            email: '',
            password: ''
        };

        function login() {
            $auth.login(vm.credentials).then(function(data) {
                $state.go('dashboard', {});
            }).catch(function(err){
                alert(err.data.error);
            });
        }

        function validateLogin(loginForm){
            return $validation.checkValid($scope[loginForm]);
        }
    }
})();