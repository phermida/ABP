<?php
// file: model/Ejercicio.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Ejercicio
 *
 * @author MO
 */
class Ejercicio {

  /**
   * @var string
   */
  private $id;  
  
  private $descripcion;
  
  private $nombre;
  
  private $foto;

  private $video;

  private $tipo;
  
  /**
   * The constructor
   * 
   *
   */
  public function __construct($id=NULL, $descripcion=NULL, $nombre=NULL, $foto=NULL, $video=NULL, $tipo=NULL) {

    $this->id = $id;
    $this->descripcion = $descripcion;    
    $this->nombre = $nombre;
    $this->foto = $foto;
    $this->video = $video;
    $this->tipo = $tipo;

  }
  

  public function getId(){
    return $this->id;
  }
  
  public function getDescripicion() {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre){
    $this->nombre = $nombre;
  }
  
  public function getFoto() {
    return $this->foto;
  }

  public function setFoto($foto) {
    $this->foto = $foto;
  }

  public function getVideo() {
    return $this->video;
  }

  public function setVideo($video) {
    $this->video = $video;
  }

  public function getTipo() {
    return $this->tipo;
  }

  public function setTipo($tipo) {
    $this->tipo = $tipo;
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
      
      if (strlen(trim($this->descripcion)) < 6 ) {
	$errors["descripcion"] = "content is mandatory";	
      }

      if ($this->nombre == NULL ) {
	$errors["nombre"] = "nombre is mandatory";	
      }

      if ($this->foto == NULL ) {
	$errors["post"] = "post is mandatory";	
      }

      if ($this->video == NULL ) {
  $errors["post"] = "post is mandatory";  
      }

      if ($this->tipo == NULL ) {
  $errors["post"] = "post is mandatory";  
      }
      
      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "comment is not valid");
      }
  }
}
