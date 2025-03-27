<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Conqueror CRM')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link href="{{asset('/css/login-register-lock.css')}}" rel="stylesheet">
    <link href="{{asset('/css/jquery.toast.css')}}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/favicon.png')}}">
    <title>CRM Admin Template - The Ultimate Multipurpose admin template</title>

    <!-- page css -->
    <link href="{{asset('/css/login-register-lock.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('/css/style.min.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Contenu principal qui changera selon la page -->
@yield('content')

<script th:inline="javascript">
    var home = /*[[${home}]]*/ null;
</script>
<script th:src="{{asset('/js/library/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap tether Core JavaScript -->
<script th:src="{{asset('/js/library/popper.min.js')}}" type="text/javascript"></script>
<script th:src="{{asset('/js/library/bootstrap.min.js')}}" type="text/javascript"></script>
<!--Custom JavaScript -->
<script th:src="{{asset('/js/custom.js')}}" type="text/javascript"></script>
<script th:src="{{asset('/js/library/jquery.toast.js')}}"></script>
<script th:src="{{asset('/js/library/toastr.js')}}"></script>
</body>
</html>
