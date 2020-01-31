<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        label {
            color: white;
        }

        ;
    </style>

    <title><?php echo config('app.pageTitle') ?></title>
</head>
<body class="bg-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top " style="margin-bottom: 30px">
    <div class="container">
        <div class="text-white "
             style="padding: 0px 10px 0px 10px">Welcome to <?php echo config('app.pageTitle') ?></div>
        <br>
        <?php if ($_SERVER['REQUEST_URI'] == '/') : ?>
            <?php if (auth()->check()): ?>
                <div class="navbar-text text-white"
                     style="padding: 0px 10px 0px 10px">Hello <?php echo auth()->user()->name(); ?> </div>
                <form method="post" action="/auth/logout">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
                <!--<div><a href="/auth/logout">Logout </a></div>-->
            <?php else : ?>
                <div class="navbar-text text-white"
                     style="padding: 0px 10px 0px 10px">Hello <?php echo "Stranger! "; ?></div>

                <div style="padding: 0px 10px 0px 10px"><a href="/auth/login">Please login</a></div>
                <!--    Please login-->
            <?php endif; ?>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/'): ?> active <?php endif; ?>">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/auth/login'): ?> active <?php endif; ?>">
                    <a class="nav-link" href="/auth/login">Login</a>
                </li>
                <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/auth/signup'): ?> active <?php endif; ?>">
                    <a class="nav-link" href="/auth/signup">SignUp</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
