(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('SignupCtrl', SignupCtrl);

    SignupCtrl.$inject = ['$auth', '$state'];

    function SignupCtrl($auth, $state) {
        var vm = this;

        vm.credentials = {
            'name': '',
            'email': '',
            'password': ''
        };

        vm.signup = signup;
        
        function signup() {
            $auth.signup(vm.credentials).then(function(result) {
                if(!result.data.success) {
                    alert(result.data.msg);
                } else {
                    $auth.login(vm.credentials).then(function(data) {
                        $state.go('dashboard', {});
                    });
                }
            });
        }
    }
})();