<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mon Application')</title>
</head>
<body>
<!-- Menu et header communs -->
{{--@include('partials.navbar')--}}

<!-- Contenu principal qui changera selon la page -->
@yield('content')

<!-- Footer commun -->
{{--@include('partials.footer')--}}
</body>
</html>
