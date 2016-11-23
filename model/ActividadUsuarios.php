<?php
// file: model/usuario.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class usuario
 *
 * @author MO
 */
class ActividadUsuarios {

  /**
   * @var string
   */
  private $idusuario;

  private $idActivity;

  private $dateToday;


  /**
   * The constructor
   *
   *
   */
  public function __construct($idusuario=NULL, $idActivity=NULL, $dateToday=NULL) {

    $this->idusuario = $idusuario;
    $this->idActivity = $idActivity;
    $this->dateToday= $dateToday;
  }


  public function getIdusuario(){
    return $this->idusuario;
  }

  public function setIdusuario($idusuario){
    return $this->idusuario = $idusuario;
  }

  public function getidActivity() {
    return $this->idActivity;
  }

  public function setidActivity($idActivity){
    return $this->idActivity = $idActivity;
  }

  public function getdateToday() {
    return $this->dateToday;
  }

  public function setdateToday($dateToday){
    return $this->dateToday = $dateToday;
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

      if (strlen(trim($this->idusuario)) < 1 ) {
	$errors["idusuario"] = "content is mandatory";
      }

      if ($this->idActivity == NULL ) {
	$errors["idActivity"] = "nombre is mandatory";
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
      throw new ValidationException($errors, "usuario is not valid");
    }
  }
  */
}
