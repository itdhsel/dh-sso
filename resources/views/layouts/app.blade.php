<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'DH SSO')</title>

    @vite(['resources/css/app.css'])

</head>

<body>
    <main class="page">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>