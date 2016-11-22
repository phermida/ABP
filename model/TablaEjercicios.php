<?php
// file: model/Ejercicio.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Ejercicio
 *
 * @author MO
 */
class TablaEjercicios {

  /**
   * @var string
   */
  private $idEjercicio;

  private $idTabla;


  /**
   * The constructor
   *
   *
   */
  public function __construct($idEjercicio=NULL, $idTabla=NULL) {

    $this->idEjercicio = $idEjercicio;
    $this->idTabla = $idTabla;

  }


  public function getIdEjercicio(){
    return $this->idEjercicio;
  }

  public function setIdEjercicio($idEjercicio){
    return $this->idEjercicio = $idEjercicio;
  }

  public function getIdTabla() {
    return $this->idTabla;
  }

  public function setIdTabla($idTabla){
    return $this->idTabla = $idTabla;
  }


  /**
   * Checks if the current instance is valid
   * for being inserted in the database.
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
   /*
  public function checkIsValidForCreate() {
      $errors = array();

      if (strlen(trim($this->idEjercicio)) < 1 ) {
	$errors["idEjercicio"] = "content is mandatory";
      }

      if ($this->idTabla == NULL ) {
	$errors["idTabla"] = "nombre is mandatory";
      }


      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "comment is not valid");
      }
  }

  public function checkIsValidForUpdate() {

    $errors = array();

    if (!isset($this->id)) {
      $errors["id"] = "id is mandatory";
    }

    try{
      $this->checkIsValidForCreate();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
      $errors[$key] = $error;
      }
    }
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "Ejercicio is not valid");
    }
  }
  */
}
