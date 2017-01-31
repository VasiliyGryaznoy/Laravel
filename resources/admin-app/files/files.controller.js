(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('FilesController', FilesController);

    /* @ngInject */
    function FilesController(files, FileUploader, $auth) {
        var vm = this;

        vm.files = files;
        vm.uploadProgress = 0;

        vm.uploader = new FileUploader({
            url: '/api/files',
            method: 'POST',
            headers: {'Authorization': 'Bearer ' + $auth.getToken()},
            removeAfterUpload: true,
            onProgressAll: function (progress) { vm.uploadProgress = progress; },
            onError: function(){
                console.log('onError');
                console.log(arguments);
                console.log('-------');
            },
            onSuccessItem: function (item, result) {
                if(vm.files.indexOf(result.fileName) === -1)
                    vm.files.push(result.fileName);
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