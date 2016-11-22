<?php
//file: controller/TablasController.php
require_once(__DIR__."/../model/Tabla.php");
require_once(__DIR__."/../model/TablaMapper.php");
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
class TablasController extends BaseController {

  /**
   * Reference to the EjercicioMapper to interact
   * with the database
   *
   * @var PostMapper
   */
  private $TablaMapper;

  public function __construct() {
    parent::__construct();

    $this->TablaMapper = new TablaMapper();
  }


//muestra todos los ejercicios que hay en la bd

  public function index() {

    // obtain the data from the database
    $tablas = $this->TablaMapper->findAll();

    // put the array containing Post object to the view
    $this->view->setVariable("tablas", $tablas);

    // render the view (/view/posts/index.php)
    $this->view->render("tablas", "index");
  }


  public function add() {
    /*
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding posts requires login");
    }*/

    $tabla = new Tabla();

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $tabla->setNombreTabla($_POST["nombreTabla"]);


      // The user of the Post is the currentUser (user in session)
      //---------------------------$post->setAuthor($this->currentUser);

      try {
  // validate Post object
  $tabla->checkIsValidForCreate(); // if it fails, ValidationException

  // save the Post object into the database
  $this->TablaMapper->save($tabla);

  // POST-REDIRECT-GET
  // Everything OK, we will redirect the user to the list of posts
  // We want to see a message after redirection, so we establish
  // a "flash" message (which is simply a Session variable) to be
  // get in the view after redirection.

 //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully added."),$ejercicio ->getNombre()));

  // perform the redirection. More or less:
  // header("Location: index.php?controller=posts&action=index")
  // die();
  $this->view->redirect("tablas", "index");

      }catch(ValidationException $ex) {
  // Get the errors array inside the exepction...
  $errors = $ex->getErrors();
  // And put it to the view as "errors" variable
  $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("tabla", $tabla);

    // render the view (/view/posts/add.php)
    $this->view->render("tablas", "add");

  }
  public function edit() {

    /*
    if (!isset($_REQUEST["id"])) {
      throw new Exception("A post id is mandatory");
    }*/
    /*
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing posts requires login");
    }*/


    // Get the Post object from the database
    $tablaid = $_REQUEST["id"];
    $tabla = $this->TablaMapper->findById($tablaid);

    // Does the post exist?
    if ($tabla == NULL) {
      throw new Exception("no such tabla with id: ".$tablaid);
    }
    /*
    // Check if the Post author is the currentUser (in Session)
    if ($post->getAuthor() != $this->currentUser) {
      throw new Exception("logged user is not the author of the post id ".$postid);
    }*/

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

            // populate the Post object with data form the form
            $tabla->setNombreTabla($_POST["nombreTabla"]);

            try {
        // validate Post object
        //$tabla->checkIsValidForUpdate(); // if it fails, ValidationException

        // update the Post object in the database
        $this->TablaMapper->update($tabla);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of posts
        // We want to see a message after redirection, so we establish
        // a "flash" message (which is simply a Session variable) to be
        // get in the view after redirection.

        //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully updated."),$ejercicio ->getNombre()));

        // perform the redirection. More or less:
        // header("Location: index.php?controller=posts&action=index")
        // die();

        //var_dump(isset($this->view->redirect));
        //exit;
        $this->view->redirect("tablas", "index");

        //exit;
        //header("Location: http://localhost:8888/gimnasio/index.php?controller=ejercicios&action=index");


            }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
            }
    }



    // Put the Post object visible to the view
    $this->view->setVariable("tabla", $tabla);

    // render the view (/view/posts/add.php)
    $this->view->render("tablas", "edit");
  }


  public function delete() {
  /*
    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing posts requires login");
    }*/

     // Get the Post object from the database
    $tablaid = $_REQUEST["id"];
    $tabla = $this->TablaMapper->findById($tablaid);

    // Does the post exist?

    /*if ($ejercicio == NULL) {
      throw new Exception("no such post with id: ".$ejercicioid);
    }

    /*
    // Check if the Post author is the currentUser (in Session)
    if ($post->getAuthor() != $this->currentUser) {
      throw new Exception("Post author is not the logged user");
    }*/

    // Delete the Post object from the database
    $this->TablaMapper->delete($tabla);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of posts
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.

    //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully deleted."),$ejercicio ->getNombre()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=posts&action=index")
    // die();
    $this->view->redirect("tablas", "index");

  }



}
