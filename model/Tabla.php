<?php
// file: model/Tabla.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Tabla
 *
 * @author MO
 */
class Tabla {

  /**
   * @var string
   */
  private $idTabla;

  private $nombreTabla;



  /**
   * The constructor
   *
   *
   */
  public function __construct($idTabla=NULL, $nombreTabla=NULL) {

    $this->idTabla = $idTabla;
    $this->nombreTabla = $nombreTabla;

  }


  public function getIdTabla(){
    return $this->idTabla;
  }

  public function getNombreTabla() {
    return $this->nombreTabla;
  }

  public function setNombreTabla($nombreTabla) {
    $this->nombreTabla = $nombreTabla;
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

  public function checkIsValidForCreate() {
      $errors = array();


      if ($this->nombreTabla == NULL ) {
  $errors["nombreTabla"] = "El nombre es obligatoria";
      }

      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "tabla is not valid");
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
      throw new ValidationException($errors, "Tabla is not valid");
    }
  }

}
