<?php
//file: controller/Ejercicio_Controller.php

require_once(__DIR__."/../model/TablaEjercicios.php");
require_once(__DIR__."/../model/TablaEjerciciosMapper.php");
require_once(__DIR__."/../model/Usuario.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class Ejercicio_Controller
 *
 * Controller to make a CRUDL of Ejercicio entities
 *
 * @author MO
 */
class TablasEjerciciosController extends BaseController {

  /**
   * Reference to the EjercicioMapper to interact
   * with the database
   *
   * @var PostMapper
   */
  private $TablaEjerciciosMapper;

  public function __construct() {
    parent::__construct();

    $this->TablaEjerciciosMapper = new TablaEjerciciosMapper();
  }

  public function index() {

    // obtain the data from the database
    $ejercicios = $this->TablaEjercicioMapper->findAll();

    // put the array containing Post object to the view
    $this->view->setVariable("ejercicios", $ejercicios);

    // render the view (/view/posts/index.php)
    $this->view->render("tablaEjercicios", "view");
  }
//muestra todos los ejercicios que hay en la bd

  public function viewExercises() {

    $tablaid = $_REQUEST["id"];
    // obtain the data from the database
    $tablaEjercicios = $this->TablaEjerciciosMapper->findTablaExercise($tablaid);

    $ejercicios = $this->TablaEjerciciosMapper->findAll($tablaid);

    $this->view->setVariable("ejercicios", $ejercicios);
    // put the array containing Post object to the view
    $this->view->setVariable("tablaEjercicios", $tablaEjercicios);
    $this->view->setVariable("idTabla", $tablaid);

    // render the view (/view/posts/index.php)
    $this->view->render("tablaEjercicios", "view");
  }


  public function add() {
    /*
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding posts requires login");
    }*/

/*    $idEjercicio = $_POST["idEjercicio"];
    $idTabla = $_GET["idTabla"];*/


    $tablaEjercicios = new TablaEjercicios();
    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $tablaEjercicios->setIdEjercicio($_POST["ejercicios"]);
      $tablaEjercicios->setIdTabla($_POST["idTabla"]);
      $tablaEjercicios->setIdTabla(1);

    }


    //echo $idEjercicio;
    //echo $idTabla;
      //---------------------------$post->setAuthor($this->currentUser);

      try {

        $this->TablaEjerciciosMapper->save($tablaEjercicios);

        $this->view->redirect("tablas", "index");

        //$this->view->setVariable("tablaEjercicios", $tablaEjercicios);



 //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully added."),$ejercicio ->getNombre()));


      }catch(ValidationException $ex) {
  // Get the errors array inside the exepction...
  $errors = $ex->getErrors();
  // And put it to the view as "errors" variable
  $this->view->setVariable("errors", $errors);
      }


    // Put the Post object visible to the view
    //$this->view->setVariable("tablaEjercicios", $tablaEjercicios);

    // render the view (/view/posts/add.php)
    $this->view->render("tablaEjercicios", "view");

  }
}
