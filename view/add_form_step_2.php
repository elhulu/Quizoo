<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/quizzooo.css" type="text/css">
    <link rel="stylesheet" href="css/hexaflip.css" type="text/css">

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


                <form action="quizzooo_api.php?action=create&step=3&quizz_id=<?php echo $quizz_id; ?>" role="form" method="POST" id="form">

                    <div class="questionField">
                        <label for="name" class="label-center">Sélectionnez une image</label>


                        <div id="carousel-img-cat1" class="carousel slide cat_carou" data-ride="carousel" data-interval="false">
                            <div id="carou_cats_1" class="carousel-inner">
                                <?php $i_a=0; foreach($cats as $di_name => $imgs): ?>
                                    <div id="carou_1_cat_<?=$di_name?>" class="item <?= $i_a == 0 ? 'active' : ''; $i_a++; ?>">
                                        <p class="cat_title"><?= $di_name ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>


                            <a class="left leftb carousel-control cat_control" href="#carousel-img-cat1" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right rightb carousel-control cat_control" href="#carousel-img-cat1" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>



                        <div id="carousel-img1" class="carousel slide carousel2" data-ride="carousel" data-interval="false">
                        <div id="carou_imgs_1" class="carousel-inner">
                            <div class="item active">
                                <img src="images/empty.jpg" alt="...">
                            </div>
                        </div>

                            <div id="img_loader_1" class="img_loader"><span class="glyphicon glyphicon-time"></span></div>


                        <a class="left carousel-control" href="#carousel-img1" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-img1" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                        </div>





                        <div class="form-group question">
                            <input type="hidden" name="img1" id="img_1"/>
                            <label for="name">Question</label>
                            <input type="text" class="form-control input-qzoo <?php if( isset($_SESSION['form_errors']['question1']) ){ echo 'error_field'; } ?>" id="name" placeholder="Ecrivez votre question" name="question1">
                            <div class="error_msg"><?php if( isset($_SESSION['form_errors']['question1']) ){ echo '<span class="glyphicon glyphicon-warning-sign"></span> '.$_SESSION['form_errors']['question1']; } ?></div>

                            <label for="name">Réponse</label>
                            <input type="text" class="form-control input-qzoo <?php if( isset($_SESSION['form_errors']['answer1']) ){ echo 'error_field'; } ?>" id="name" placeholder="Ecrivez la réponse à votre question" name="answer1">
                            <div class="error_msg"><?php if( isset($_SESSION['form_errors']['answer1']) ){ echo '<span class="glyphicon glyphicon-warning-sign"></span> '.$_SESSION['form_errors']['answer1']; } ?></div>
                        </div>
                    </div>


                    <div id="prependzone"></div>

                    <button  type="button" class="btn btn-default button-qzooo" id="add_question"> <i class="glyphicon glyphicon-plus"></i> Ajouter une question</button>



                    <div class="form-button">
                        <button type="submit" class="btn btn-default button-qzoo">Etape suivante ></button>
                    </div>

                </form>



        </div>
        
    </div>
</div>


<script type="text/javascript">


$(document).ready(function(){

    var question_id = 1;
    var max_lock = 50;
    var added_count = 0;

    $('#add_question').click( add_question );

    function add_question()
    {

        if( added_count <= max_lock )
        {
            question_id++;


            $('#prependzone').append('<div class="questionField">\
                    <label for="name" class="label-center">Sélectionnez une image</label>\
                <div id="carousel-img-cat'+question_id+'" class="carousel slide cat_carou" data-ride="carousel" data-interval="false">\
        <div id="carou_cats_'+question_id+'" class="carousel-inner">\
            <?php $i_a=0; foreach($cats as $di_name => $imgs): ?>\
        <div id="carou_'+question_id+'_cat_<?=$di_name?>" class="item <?= $i_a == 0 ? 'active' : ''; $i_a++; ?>">\
        <p class="cat_title"><?= $di_name ?></p>\
        </div>\
            <?php endforeach; ?>\
        </div>\
        <a class="left leftb carousel-control cat_control" href="#carousel-img-cat'+question_id+'" data-slide="prev">\
        <span class="glyphicon glyphicon-chevron-left"></span>\
        </a>\
        <a class="right rightb carousel-control cat_control" href="#carousel-img-cat'+question_id+'" data-slide="next">\
        <span class="glyphicon glyphicon-chevron-right"></span>\
        </a>\
        </div>\
        <div id="carousel-img'+question_id+'" class="carousel slide carousel2" data-ride="carousel" data-interval="false">\
        <div id="carou_imgs_'+question_id+'" class="carousel-inner">\
        <div class="item active">\
        <img src="images/empty.jpg" alt="...">\
        </div>\
        </div>\
        <div id="img_loader_'+question_id+'" class="img_loader"><span class="glyphicon glyphicon-time"></span></div>\
        <a class="left carousel-control" href="#carousel-img'+question_id+'" data-slide="prev">\
        <span class="glyphicon glyphicon-chevron-left"></span>\
        </a>\
        <a class="right carousel-control" href="#carousel-img'+question_id+'" data-slide="next">\
        <span class="glyphicon glyphicon-chevron-right"></span>\
        </a>\
        </div>\
        <div class="form-group question">\
        <input type="hidden" name="img'+question_id+'" id="img_'+question_id+'"/>\
        <label for="name">Question</label>\
        <input type="text" class="form-control input-qzoo" id="name" placeholder="Ecrivez votre question" name="question'+question_id+'">\
        <label for="name">Réponse</label>\
        <input type="text" class="form-control input-qzoo" id="name" placeholder="Ecrivez la réponse à votre question" name="answer'+question_id+'">\
        </div>\
        </div>');


            added_count++;
        }


    }



    $(document).on('click', '.carousel-control', function(){

        object_parent_id = $(this).parent().attr('id').split("-").pop();
        carou_type = object_parent_id.substring(0,object_parent_id.length - 1);
        carou_id = $(this).parent()[0].id.substr($(this).parent()[0].id.length - 1);

        parent_id = $(this).parent().attr('id');


        if(carou_type=="cat")
        {
            change_carou_cat(parent_id,carou_id);
            setTimeout(function(){ save_carou_change("carousel-img"+carou_id,carou_id); }, 1500);
        }
        if(carou_type=="img")
        {
            save_carou_change(parent_id,carou_id);
        }

    });

    ajax_lock = false;


    function change_carou_cat(elem,carou_id)
    {

        if( ajax_lock == false )
        {
            ajax_lock = true;


            $("#img_loader_"+carou_id).fadeTo(1000, 0.8);
            setTimeout( function(){


                cat_name =  $('#'+elem).find('div:first').find('.active').attr('id').split("_").pop();

                $.ajax( "quizzooo_api.php?action=get_img_by_cat&cat="+cat_name )
                    .done(function(data) {
                        $("#carou_imgs_"+carou_id).html(data);
                    })
                    .fail(function() {
                        console.log( "cat error" );
                    })
                    .always(function() {
                        $("#img_loader_"+carou_id).fadeTo(1000, 0);
                        ajax_lock = false;

                    });


            } ,1000);


        }





    }

    function save_carou_change(elem,carou_id)
    {
        setTimeout( function(){

            selected_img =  $('#'+elem).find('div:first').find('.active').find('img:first').attr('src');
            hidden_img_input =  $('#img_'+carou_id);

            hidden_img_input.val(selected_img);

        } ,1000);

    }




    /*


    $.ajax( "example.php" )
        .done(function() {
            alert( "success" );
        })
        .fail(function() {
            alert( "error" );
        })
        .always(function() {
            alert( "complete" );
        });


*/


});

</script>











</body>
</html>