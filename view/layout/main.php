<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <title>MVC</title>
</head>
<body class="mx-auto">

<nav class="navbar  navbar-light bg-light">
    <div class="container-fluid">

            <div class="d-flex ps-5">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/about">About us</a>
            </div>

            <div class="d-flex pe-5">
                <a class="nav-link" href="/login">Login</a>
                <a class="nav-link" href="/register">Register</a>
            </div>

    </div>
</nav>

<div class="container">

    {{content}}

</div>

</body>
</html>