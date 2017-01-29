(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('UsersCtrl', UsersCtrl);

    UsersCtrl.$inject = ['usersService'];

    function UsersCtrl(usersService) {
        var vm = this;

        vm.users = [];

        init();

        function init(){
            usersService.all().then(function(result){
                vm.users = result;
            }).catch(function(err){
                console.log(err);
            });
        }
    }
})();