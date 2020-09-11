<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MVC Framework</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/style.css" >
</head>
<body>
<header>
    <?php $url = $_SERVER["REQUEST_URI"];?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">MVC-Framework</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?php $activeLink = $url == "/department" ? 'active' : '' ?>
                    <a class="nav-link <?= $activeLink ?>" href="/department">Departments</a>
                </li>
                <li class="nav-item">
                    <?php $activeLink = $url == "/user" ? 'active' : ''?>
                    <a class="nav-link <?= $activeLink ?>" href="/user" >Users</a>
                </li>
        </div>
    </nav>
</header>
<main role="main" class="container">
    <?php
    include ($contentPage);
    ?>
</main>
<footer class="footer">
    <div class="container">
        <span class="text-muted">MVC framework</span>
    </div>
</footer>
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>