(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('SignupCtrl', SignupCtrl);

    SignupCtrl.$inject = ['$auth'];

    function SignupCtrl($auth) {
        var vm = this;

        vm.credentials = {
            'name': '',
            'email': '',
            'password': ''
        };

        vm.signup = signup;
        
        function signup() {
            
        }
    }
})();