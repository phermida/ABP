<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/*
 * 
 * @author MO
 */
class Usuario {

  /**
   * The user name of the user
   * @var string
   */
  private $username;

  /**
   * The password of the user
   * @var string
   */
  private $id;
  private $passwd;
  private $email;
  private $telefono;
  private $dni;
  private $tipo;
  
  /**
   * The constructor
   * 
   */
  public function __construct($id=NULL, $username=NULL, $passwd=NULL, $email=NULL, $telefono=NULL, $dni=NULL, $tipo=NULL) {

    $this->id = $id;
    $this->username = $username;
    $this->passwd = $passwd;    
    $this->email = $email;
    $this->telefono = $telefono;
    $this->dni = $dni;
    $this->tipo = $tipo;

  }

  public function getId() {
      return $this->id;
    }  
  
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Gets the username of this user
   * 
   * @return string The username of this user
   */  
  public function getUsername() {
    return $this->username;
  }

  /**
   * Sets the username of this user
   * 
   * @param string $username The username of this user
   * @return void
   */  
  public function setUsername($username) {
    $this->username = $username;
  }
  
  /**
   * Gets the password of this user
   * 
   * @return string The password of this user
   */  
  public function getPasswd() {
    return $this->passwd;
  }  
  /**
   * Sets the password of this user
   * 
   * @param string $passwd The password of this user
   * @return void
   */    
  public function setPassword($passwd) {
    $this->passwd = $passwd;
  }

  public function getEmail() {
    return $this->email;
  }  
 
  public function setEmail($email) {
    $this->email = $email;
  }


  public function getTelefono() {
    return $this->telefono;
  }  

  public function setTelefono($telefono) {
    $this->telefono = $telefono;
  }


  public function getDni() {
    return $this->dni;
  }  

  public function setDni($dni) {
    $this->dni = $dni;
  }


  public function getTipo() {
    return $this->tipo;
  }  
   
  public function setTipo($tipo) {
    $this->tipo = $tipo;
  }
  
  /**
   * Checks if the current user instance is valid
   * for being registered in the database
   * DUDAAAAAA(1)
   * 
   * @throws ValidationException if the instance is
   * not valid
   * 
   * @return void
   */  
  public function checkIsValidForRegister() {
      $errors = array();
      if (strlen($this->username) < 5) {
	$errors["username"] = "Username must be at least 5 characters length";
	
      }
      if (strlen($this->passwd) < 5) {
	$errors["passwd"] = "Password must be at least 5 characters length";	
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "user is not valid");
      }
  } 
}