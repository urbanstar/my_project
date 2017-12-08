<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>add article</title>
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

<form>
<div class="form-group col-md-6">
    <label for="inputName">Название статьи*</label>
    <input type="email" class="form-control" id="inputtext" placeholder="Название статьи">
</div>

<div class="form-group col-md-6">
    <label for="inputText">Содержание*</label>
    <textarea type="text" class="form-control" id="inputtext" placeholder="Содержание"></textarea>
</div>
<div class="form-group col-md-6">
    <label for="inputAutor">Автор*</label>
    <input type="email" class="form-control" id="inputautor" placeholder="Автор статьи">
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>
<button type="reset" class="btn btn-primary">Очистить</button>
</form>