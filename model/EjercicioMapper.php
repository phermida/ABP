<?php
// file: model/EjercicioMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Ejercicio.php");

/**
 * Class EjercicioMapper
 *
 * Database interface for Post entities
 * 
 * @author MO
 */
class EjercicioMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }


  /*funcion que te trae un array de los ejercicio del tipo que le pasas(musculacion, estiramiento, cardio)
  */
  public function findForType($tipoEjercicio){

    $stmt = $this->db->prepare("SELECT * FROM ejercicios WHERE tipo=?");
    $stmt->execute(array($tipoEjercicio));
    $ejercicio_db = $stmt->fetch(PDO::FETCH_ASSOC);

    $ejerciciosTipo = array();

    foreach ($ejercicio_db as $ejercicio) {

      array_push($ejerciciosTipo, new Ejercicio($ejercicio["id"], $ejercicio["descripcion"], $ejercicio["nombre"], $ejercicio["foto"], $ejercicio["video"]));
    }

    return ejerciciosTipo;

  }


//supuestemante deberia traerte todos los ejercicios de todos los tipos
  public function findAll() {   

    $stmt = $this->db->query("SELECT * FROM ejercicios");    
    $ejercicio_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $ejercicios= array();
    
    foreach ($ejercicio_db as $ejercicio) {

      array_push($ejercicios, new Ejercicio($ejercicio["id"], $ejercicio["descripcion"], $ejercicio["nombre"], $ejercicio["foto"], $ejercicio["video"], $ejercicio["tipo"]));
    }   

    return $ejercicios;
  }

  public function findById($ejercicioid){
    $stmt = $this->db->prepare("SELECT * FROM ejercicios WHERE id=?");
    $stmt->execute(array($ejercicioid));
    $ejercicio = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($ejercicio != null) {
      return new Ejercicio(
      $ejercicio["id"],
      $ejercicio["nombre"],
      $ejercicio["descripcion"]);
    } else {
      return NULL;
    }   
  }


  public function save(Ejercicio $ejercicio) {

    $stmt = $this->db->prepare("INSERT INTO ejercicios(descripcion, foto, video, nombre, tipo) values (?,?,?,?,?)");
    $stmt->execute(array($ejercicio->getDescripcion(), $ejercicio->getFoto(), $ejercicio->getNombre(), $ejercicio->getTipo() ));
    return $this->db->lastInsertId();
  }

 public function update(Ejercicio $ejercicio) {
    $stmt = $this->db->prepare("UPDATE ejercicios set descripcion=?, foto=?, video=?, nombre=?, tipo=? where id=?");
    $stmt->execute(array($ejercicio->getDescripcion(), $ejercicio->getFoto(), $ejercicio->getNombre(), $ejercicio->getTipo(), $post->getId()));    
  }

}
