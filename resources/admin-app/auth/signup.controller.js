(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('SignupCtrl', SignupCtrl);

    SignupCtrl.$inject = [
        '$auth',
        '$state',
        '$scope',
        '$validation'
    ];

    function SignupCtrl(
        $auth,
        $state,
        $scope,
        $validation
    ) {
        var vm = this;

        vm.credentials = {
            'name': '',
            'email': '',
            'password': ''
        };

        vm.signup = signup;
        vm.validateSignup = validateSignup;
        
        function signup() {
            $auth.signup(vm.credentials).then(function(result) {
                if(!result.data.success) {
                    alert(result.data.msg);
                } else {
                    $auth.login(vm.credentials).then(function(data) {
                        $state.go('dashboard', {});
                    });
                }
            }).catch(function(err){
                console.log(err);
            });
        }

        function validateSignup(signupForm){
            return $validation.checkValid($scope[signupForm]);
        }
    }
})();