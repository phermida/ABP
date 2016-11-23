  <?php
//file: controller/usuario_Controller.php

require_once(__DIR__."/../model/ActividadUsuarios.php");
require_once(__DIR__."/../model/ActividadUsuariosMapper.php");
require_once(__DIR__."/../model/activityMapper.php");
require_once(__DIR__."/../model/Usuario.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class usuario_Controller
 *
 * Controller to make a CRUDL of usuario entities
 *
 * @author MO
 */
class ActividadesUsuariosController extends BaseController {

  /**
   * Reference to the usuarioMapper to interact
   * with the database
   *
   * @var PostMapper
   */
  private $ActividadUsuariosMapper;

  public function __construct() {
    parent::__construct();

    $this->ActividadUsuariosMapper = new ActividadUsuariosMapper();
    $this->ActivityMapper = new activityMapper();
  }

  public function index() {

    // obtain the data from the database
    $usuarios = $this->ActividadUsuariosMapper->findAll();
    var_dump($usuarios);
    die;

    // put the array containing Post object to the view
    $this->view->setVariable("usuarios", $usuarios);

    // render the view (/view/posts/index.php)
    $this->view->render("ActividadUsuarios", "view");
  }
//muestra todos los usuarios que hay en la bd

  public function viewUsers() {

    $Actividadid = $_REQUEST["id"];
    // obtain the data from the database
    $ActividadUsuarios = $this->ActividadUsuariosMapper->findActividadUser($Actividadid);
    $usuarios = $this->ActividadUsuariosMapper->findAll($Actividadid);

    $this->view->setVariable("usuarios", $usuarios);
    // put the array containing Post object to the view
    $this->view->setVariable("ActividadUsuarios", $ActividadUsuarios);
    $this->view->setVariable("idActivity", $Actividadid);

    // render the view (/view/posts/index.php)
    $this->view->render("ActividadUsuarios", "view");
  }


  public function add() {
    /*
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding posts requires login");
    }*/

/*    $idusuario = $_POST["idusuario"];
    $idActivity = $_GET["idActivity"];*/


    $ActividadUsuarios = new ActividadUsuarios();
    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $ActividadUsuarios->setIdusuario($_POST["usuarios"]);
      $ActividadUsuarios->setidActivity($_POST["idActivity"]);
      $ActividadUsuarios->setdateToday($_POST["dateToday"]);
    }

    //echo $idusuario;
    //echo $idActivity;
      //---------------------------$post->setAuthor($this->currentUser);

      try {

        $this->ActividadUsuariosMapper->save($ActividadUsuarios);

        $this->view->redirect("activities", "view");

        //$this->view->setVariable("ActividadUsuarios", $ActividadUsuarios);



 //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully added."),$usuario ->getNombre()));


      }catch(ValidationException $ex) {
  // Get the errors array inside the exepction...
  $errors = $ex->getErrors();
  // And put it to the view as "errors" variable
  $this->view->setVariable("errors", $errors);
      }


    // Put the Post object visible to the view
    //$this->view->setVariable("ActividadUsuarios", $ActividadUsuarios);

    // render the view (/view/posts/add.php)
    $this->view->render("ActividadUsuarios", "view");

  }
}
