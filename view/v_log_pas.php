<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

       <!--                                                              Bootstrap core CSS
   ====================================================================================================================================================== -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- ======================================================================================================================================================
                                                                      End Bootstrap core CSS.-->
    <!--                                                              Custom styles for this template
   ====================================================================================================================================================== -->
    <link href="../assets/css/justified-nav.css" rel="stylesheet">
    <!-- ======================================================================================================================================================
                                                                      End Custom styles for this template.-->
</head>

<header class="masthead">
    <h3 class="text-muted"><?=$title?></h3>
</header>
<form action="../controller/c_log_pas.php"  method="post">
    <div class="form-group">
        <b><label for="exampleInputLogin1">Введите логин</label></b>
        <input type="input" class="form-control" id="exampleInputlog" name ='log' aria-describedby="emailHelp" placeholder="Введите логин">
        <small id="emailHelp" class="form-text text-muted">Обязательное поле</small>
    </div>
    <div class="form-group">
        <b> <label for="exampleInputPass1">Введите пароль</label></b>
        <input type="password" class="form-control" id="exampleInputPass1" name='pass' placeholder="Пароль">
        <small id="emailHelp" class="form-text text-muted">Обязательное поле</small>
    </div>

    <button type="submit" class="btn btn-primary">Вход</button>
</form>