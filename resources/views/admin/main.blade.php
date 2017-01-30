<!DOCTYPE html>
<html lang="en" ng-app="adminApp" ng-cloack>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <ng-include data-ng-if="user" src="'/views/admin/navbar.html'"></ng-include>

        <div id="page-wrapper" ng-class="{'hide-navigation': !user}">
            <div ui-view></div>
        </div>
    </div>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/js/sb-admin-2.min.js"></script>

    <!--Angular-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.11/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular-resource.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/satellizer/0.14.1/satellizer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.4.2/angular-ui-router.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-validation/1.4.2/angular-validation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-validation/1.4.2/angular-validation-rule.min.js"></script>

    <script src="{{ url('admin-app/libs.js') }}"></script>
    <script src="{{ url('admin-app/app.js') }}"></script>
</body>

</html>

<style>
    /* Very bad practice! Don't do so! */
    .hide-navigation {
        margin: 0 !important;
    }
</style>
