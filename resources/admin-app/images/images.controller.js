(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('ImagesController', ImagesController);

    /* @ngInject */
    function ImagesController(FileUploader, $auth, $scope) {
        var vm = this;

        vm.image = {
            full: undefined,
            cropped: undefined
        };


        vm.debug = function() {
            console.log(vm.image);
        };

        vm.uploader = new FileUploader({
            url: '/api/images',
            method: 'POST',
            headers: {'Authorization': 'Bearer ' + $auth.getToken()},
            removeAfterUpload: true,
            onError: function(){
                console.log('onError');
                console.log(arguments);
                console.log('-------');
            },
            onSuccessItem: function (item, result) {
                vm.image.full = result.fileName;
            },
            filters: [ ], //Here can be something
            onAfterAddingFile: function(item){
                item.upload();
            },
            onBeforeUploadItem: function(item){
                item.formData.push({'file_alias': 'file'});
            },
        });
    }
})();