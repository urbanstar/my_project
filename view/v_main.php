
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>My first Blog</title>


    <!--                                                              Bootstrap core CSS
   ====================================================================================================================================================== -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- ======================================================================================================================================================
                                                                      End Bootstrap core CSS.-->


    <!--                                                              Custom styles for this template
   ====================================================================================================================================================== -->
    <link href="assets/css/justified-nav.css" rel="stylesheet">
    <!-- ======================================================================================================================================================
                                                                      End Custom styles for this template.-->
</head>

<body>

<div class="container">
    <!--                                                                      Header
    ====================================================================================================================================================== -->
    <header class="masthead">
        <h3 class="text-muted">Газета</h3>
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav text-md-center nav-justified w-100">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view/v_add_update_article.php">Статьи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Блог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Контанкты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view/v_my.php">Обо мне</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view/v_log_pas.php"><?php if (!($user=='guest')) echo $user; else echo 'Войти'; ?></a>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- ======================================================================================================================================================
                                                                            End Header.-->

    <main role="main">


        <!--                                                                 Slider
    ====================================================================================================================================================== -->

        <!-- ======================================================================================================================================================
                                                                            End Slider.-->

        <!--                                                                 Main Content
    ====================================================================================================================================================== -->
        <br>

        <?=$content?>
        <!-- ======================================================================================================================================================
                                                                        End Main Content.-->
    </main>

    <!--                                                                           Footer
    ====================================================================================================================================================== -->
    <footer class="footer">
        <p>&copy; Сайт, 2017</p>
    </footer>
    <!-- ======================================================================================================================================================
                                                                                End Footer.-->

</div>


<!--                                                                Bootstrap core JavaScript
====================================================================================================================================================== -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- ======================================================================================================================================================
                                                                    End Bootstrap core JavaScript.-->

</body>
</html>
