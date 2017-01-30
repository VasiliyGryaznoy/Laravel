(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('SignupController', SignupController);

    /* @ngInject */
    function SignupController($auth, $state, $scope, $validation) {
        var vm = this;

        vm.credentials = {
            name: undefined,
            email: undefined,
            password: undefined
        };

        vm.signup = signup;
        vm.validateSignup = validateSignup;
        
        function signup() {
            $auth.signup(vm.credentials).then(function(result) {
                $auth.setToken(result.data.token);
                $state.go('dashboard', {});
            }).catch(function(err){
                console.log(err);
            });
        }

        function validateSignup(signupForm){
            return $validation.checkValid($scope[signupForm]);
        }
    }
})();