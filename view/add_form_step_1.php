<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/quizzooo.css">

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.js"></script>

</head>
<body>


<div id="main">
    <div class="row">
        <div class="col-xs-12 col-md-8">

            <div id="logo"><img src="medias/logo_visual_1.png" alt="Quizzooo"/></div>

            <h1>Creation d'un quizz</h1>
            <p class="subtitle">Etape <?php echo $step; ?> / 2</p>

            <?php // general errors.
                  if( isset($_SESSION['general_errors']) && is_array($_SESSION['general_errors']) )
                  {
                        foreach($_SESSION['general_errors'] as $error)
                        {
                            //echo $error.'<br>';
                        }

                  }
            ?>

                <form action="quizzooo_api.php?action=create&step=2" role="form" method="POST">

                    <div class="form-group">
                        <label for="name">Nom du quizz</label>
                        <input type="text" class="form-control input-qzoo <?php if( isset($_SESSION['form_errors']['name']) ){ echo 'error_field'; } ?>" id="name" placeholder="Choisissez un nom pour votre quizz" name="name">
                        <div class="error_msg"><?php if( isset($_SESSION['form_errors']['name']) ){ echo '<span class="glyphicon glyphicon-warning-sign"></span> '.$_SESSION['form_errors']['name']; } ?></div>
                    </div>


                    <div class="form-group">
                        <label for="theme">Theme Visuel</label>
                        <select class="form-control input-qzoo" id="theme" name="theme">
                            <option value="1">Blanc</option>
                            <option value="2">Noir</option>
                            <option value="3">Silver</option>
                            <option value="4">Metro</option>
                        </select>
                    </div>


                    <div class="form-button">
                        <button type="submit" class="btn btn-default button-qzoo">Etape suivante ></button>
                    </div>

                </form>



        </div>
        <div class="col-xs-6 col-md-4"></div>
    </div>
</div>


</body>
</html>