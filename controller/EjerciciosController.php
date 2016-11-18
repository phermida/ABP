<?php
//file: controller/Ejercicio_Controller.php

require_once(__DIR__."/../model/Ejercicio.php");
require_once(__DIR__."/../model/EjercicioMapper.php");
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
class EjerciciosController extends BaseController {
  
  /**
   * Reference to the EjercicioMapper to interact
   * with the database
   * 
   * @var PostMapper
   */
  private $EjercicioMapper;  
  
  public function __construct() { 
    parent::__construct();
    
    $this->EjercicioMapper = new EjercicioMapper();          
  }


//muestra todos los ejercicios que hay en la bd

  public function index() {
  
    // obtain the data from the database
    $ejercicios = $this->EjercicioMapper->findAll();    
    
    // put the array containing Post object to the view
    $this->view->setVariable("ejercicios", $ejercicios);    
    
    // render the view (/view/posts/index.php)
    $this->view->render("ejercicios", "index");
  }


  public function add() {
    /*
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding posts requires login");
    }*/
    
    $ejercicio = new Ejercicio();
    
    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      
      // populate the Post object with data form the form
      $ejercicio->setNombre($_POST["nombre"]);
      $ejercicio->setDescripcion($_POST["descripcion"]);
      $ejercicio->setFoto($_POST["foto"]);
      $ejercicio->setVideo($_POST["video"]);
      $ejercicio->setTipo($_POST["tipo"]);

      
      // The user of the Post is the currentUser (user in session)
      //---------------------------$post->setAuthor($this->currentUser);
       
      try {
  // validate Post object
  $ejercicio->checkIsValidForCreate(); // if it fails, ValidationException
  
  // save the Post object into the database
  $this->EjercicioMapper->save($ejercicio);
  
  // POST-REDIRECT-GET
  // Everything OK, we will redirect the user to the list of posts
  // We want to see a message after redirection, so we establish
  // a "flash" message (which is simply a Session variable) to be
  // get in the view after redirection.
 
 //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully added."),$ejercicio ->getNombre()));
  
  // perform the redirection. More or less: 
  // header("Location: index.php?controller=posts&action=index")
  // die();
  $this->view->redirect("ejercicios", "index");
  
      }catch(ValidationException $ex) {      
  // Get the errors array inside the exepction...
  $errors = $ex->getErrors(); 
  // And put it to the view as "errors" variable
  $this->view->setVariable("errors", $errors);
      }
    }
    
    // Put the Post object visible to the view
    $this->view->setVariable("ejercicio", $ejercicio);    
    
    // render the view (/view/posts/add.php)
    $this->view->render("ejercicios", "add");
    
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
    $ejercicioid = $_REQUEST["id"];
    $ejercicio = $this->EjercicioMapper->findById($ejercicioid);
    
    // Does the post exist?
    if ($ejercicio == NULL) {
      throw new Exception("no such ejercicio with id: ".$ejercicioid);
    }
    /*
    // Check if the Post author is the currentUser (in Session)
    if ($post->getAuthor() != $this->currentUser) {
      throw new Exception("logged user is not the author of the post id ".$postid);
    }*/
    
    if (isset($_POST["submit"])) { // reaching via HTTP Post...  
    
            // populate the Post object with data form the form
            $ejercicio->setNombre($_POST["nombre"]);
            $ejercicio->setDescripcion($_POST["descripcion"]);
            $ejercicio->setFoto($_POST["foto"]);
            $ejercicio->setVideo($_POST["video"]);
            $ejercicio->setTipo($_POST["tipo"]);
            
            try {
        // validate Post object
        $ejercicio->checkIsValidForUpdate(); // if it fails, ValidationException
        
        // update the Post object in the database
        $this->EjercicioMapper->update($ejercicio);
        
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
        $this->view->redirect("ejercicios", "index");  

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
    $this->view->setVariable("ejercicio", $ejercicio);
    
    // render the view (/view/posts/add.php)
    $this->view->render("ejercicios", "edit");    
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
    $ejercicioid = $_REQUEST["id"];
    $ejercicio = $this->EjercicioMapper->findById($ejercicioid);
    
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
    $this->EjercicioMapper->delete($ejercicio);
    
    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of posts
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.

    //$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully deleted."),$ejercicio ->getNombre()));
    
    // perform the redirection. More or less: 
    // header("Location: index.php?controller=posts&action=index")
    // die();
    $this->view->redirect("ejercicios", "index");
    
  }  



}