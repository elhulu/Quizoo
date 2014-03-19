<?php
session_start();

// CREATION QUIZZ : /quizzooo_api.php?action=create


class quizz
{

    private $step = 1;
    private $quizz_id = null;
    private $base_route = null;



    function __construct($get) {



        $this->base_route = str_replace(basename($_SERVER["REQUEST_URI"]), '',$_SERVER["REQUEST_URI"]);

        if( !isset($get['action']) )
            $this->set_error("general","Missing parameter",1);
        else
            $action = htmlspecialchars($get['action']);


        if( method_exists ($this, $action) )
            call_user_func( array($this, $action) , $get);

    }






    function create($get) {

        $step = isset($get['step']) ? (INT)$get['step'] : $this->getStep();

        if($step == 1) // STEP 1
        {
            require_once('view/add_form_step_1.php');
            session_destroy();
        }

        if($step == 2) // STEP 2
        {
            if( !empty($_POST) || isset($_GET['error']) )
            {

                $resInputFilter = $this->checkInputsData($_POST); // input filter

                if( $resInputFilter[0] )  // [0] = res, [1] = optional data array
                {

                    $quizz_id = isset($_GET['quizz_id']) ? $_GET['quizz_id'] : $this->quizz_id;
                    $cats = $this->get_cats();

                    if( !empty($_POST) )
                    {
                        if( $this->saveQuizz($_POST) ) // SAVING STEP 1
                        {
                            $quizz_id = $this->quizz_id;

                        }

                    }


                    require_once('view/add_form_step_2.php');
                    session_destroy();

                }
                else
                {
                    $this->set_error(["form",$resInputFilter[1]],"",0);
                    $this->redirect_step(1);
                }

            }
            else
            {
                $this->set_error("general","No data",1);
            }

        }


        if($step == 3) // STEP 3
        {
            if( isset($_GET['quizz_id']) && (INT)$_GET['quizz_id'] != 0 )
            {

                $this->quizz_id = (INT)$_GET['quizz_id'];

                $question_count = count($_POST);

                $resInputFilter = $this->checkInputsData($_POST); // input filter

                if( $resInputFilter[0] )
                {

                    for($i=1; $i<=($question_count/3); $i++)
                    {

                        $this->saveQuestion( array('question' => $_POST['question'.$i],
                            'answer' => $_POST['answer'.$i],
                            'img' => $_POST['img'.$i]
                        ));

                    }

                    require_once('view/add_success.php');

                }
                else
                {
                    $this->set_error(["form",$resInputFilter[1]],"",0);
                    $this->redirect_step(2);
                }




            }
            else
            {
                $this->set_error("general","No data",1);
            }

        }




    }






    function getStep() {
        return $this->step;
    }




    function redirect_step($step) {

            $quizz_id = $this->quizz_id != null ? '&quizz_id='.$this->quizz_id : '' ;

        header('Location: '.$this->base_route.'quizzooo_api.php?action=create&step='.$step.$quizz_id.'&error');
    }




    function get_cats() {

        $img_dir = 'images/';

        //dirs (cats)
        $dirs = [];

        if ($handle = opendir($img_dir)) {
            while (($file = readdir($handle)) !== false){
                    if( !in_array($file, array('.', '..')) && is_dir($img_dir.$file)){
                        $dirs[] = $file;
                    }
            }
        }

        //var_dump($dirs); //cats
        $imgs = [];


        foreach($dirs as $dir)
        {

            //count images in dir
            $imgs_c = 0;

            if ($handle = opendir($img_dir.$dir)) {
                while (($file = readdir($handle)) !== false){
                    if (!in_array($file, array('.', '..')) && !is_dir($img_dir.$dir.$file))
                        $imgs_c++;
                }
            }

            $imgs[$dir] = $imgs_c;
        }


        ksort($imgs);
        return $imgs;

    }


    function get_img_by_cat() { //ajax

        $cat = isset($_GET['cat']) ? $_GET['cat'] : 'Objets';

        $img_dir = 'images/';

        $i_a=0;

        if ($handle = opendir($img_dir.$cat)) {
            while (($file = readdir($handle)) !== false){
                if (!in_array($file, array('.', '..')) && !is_dir($img_dir.$cat.$file))
                {
                    $class = $i_a == 0 ? 'active' : '';

                    echo '<div class="item '.$class.'">
                                <img src="images/'.$cat.'/'.$file.'" alt="...">
                                <div class="carousel-caption">
                                </div>
                          </div>';
                    $i_a++;
                }


            }
        }



    }






    // DB

    function saveQuizz($data) {

        require('conf/connection.php');

        $insert = $bdd->prepare('INSERT INTO quizz VALUES( NULL, :theme, :name)');

        try {

            $success = $insert->execute(array(
                'name'=> htmlspecialchars($data['name']),
                'theme'=> (INT)$data['theme']

            ));

            if( $success ) {

                $this->quizz_id = $bdd->lastInsertId();
                return true;
            }

        } catch( Exception $e ){
            $this->set_error("general","Error #221",1);
            //echo 'Erreur de requète : ', $e->getMessage();
        }

    }



    function saveQuestion($data) {

        require('conf/connection.php');

        $insert = $bdd->prepare('INSERT INTO question VALUES( NULL, :quizz_id, :question, :answer, :background_id)');

        try {


            $res = $insert->execute(array(
                'quizz_id'=> $this->quizz_id,
                'question'=> htmlspecialchars($data['question']),
                'answer'=> htmlspecialchars($data['answer']),
                'background_id'=> htmlspecialchars($data['img'])

            ));


        } catch( Exception $e ){
            $this->set_error("general","Error #221",1);
        }

    }



    // input filter
    private function checkInputsData($post_data)
    {


        $error_messages = [ 'name' => 'Merci de nommer votre quizz.',
                            'theme' => 'Choisissez un thème pour votre quizz.',
                            'question1' => 'Votre quizz doit contenir au moins une question.',
                            'answer1' => 'Votre quizz doit contenir au moins une réponse.', ];


        $res = [ true,  [] ];


        if( is_array($post_data) )
        {
            foreach( $post_data as $field_name => $data )
            {


                if( empty($data) && array_key_exists($field_name,$error_messages) )
                {
                    $res[0] = false;

                    $res[1][] = [ $field_name, $error_messages[$field_name] ];
                }

            }

        }

        return $res;

    }




    // Errors
    public $errors = array();

    private function set_error($focus_e,$messages,$stop)
    {


        $focus = array();

        if( !is_array($focus_e) ) { $focus[0] = $focus_e; }
        else { $focus[0] = $focus_e[0]; }


                if( $focus[0] == 'general' )
                {
                    $_SESSION['general_errors'] = array();
                    $_SESSION['general_errors'][] = $messages;
                }
                elseif( $focus[0] == 'form' )
                {
                    $_SESSION['form_errors'] = array();

                    foreach($focus_e[1] as $key => $value)
                    {
                        $_SESSION['form_errors'][$value[0]] = $value[1];
                    }

                }



        if($stop)
        {
            echo 'ERROR :<PRE>';
            echo $messages;
            echo '</PRE>';

            exit;
        }

    }

    private function get_errors()
    {
        return $this->errors;
    }




}

$quizz = new quizz($_GET);








?>