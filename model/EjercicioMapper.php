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

      array_push($ejercicios, new Ejercicio($ejercicio["idEjercicio"], $ejercicio["nombreEjercicio"], $ejercicio["descripcionEjercicio"], $ejercicio["fotoEjercicio"], $ejercicio["videoEjercicio"], $ejercicio["tipoEjercicio"]));
    }

    return $ejercicios;
  }

  public function findById($ejercicioid){
    $stmt = $this->db->prepare("SELECT * FROM ejercicios WHERE idEjercicio=?");
    $stmt->execute(array($ejercicioid));
    $ejercicio = $stmt->fetch(PDO::FETCH_ASSOC);



    if($ejercicio != null) {
      return new Ejercicio(
      $ejercicio["idEjercicio"],
      $ejercicio["nombreEjercicio"],
      $ejercicio["descripcionEjercicio"],
      $ejercicio["fotoEjercicio"],
      $ejercicio["videoEjercicio"],
      $ejercicio["tipoEjercicio"]

      );
    } else {
      return NULL;
    }
  }


  public function save(Ejercicio $ejercicio) {

    $stmt = $this->db->prepare("INSERT INTO ejercicios(descripcionEjercicio, fotoEjercicio, videoEjercicio, nombreEjercicio, tipoEjercicio) values (?,?,?,?,?)");
    $stmt->execute(array($ejercicio->getDescripcion(), $ejercicio->getFoto(),$ejercicio->getVideo(), $ejercicio->getNombre(), $ejercicio->getTipo() ));
    return $this->db->lastInsertId();
  }

  public function update(Ejercicio $ejercicio) {
    $stmt = $this->db->prepare("UPDATE ejercicios set descripcionEjercicio=?, fotoEjercicio=?, videoEjercicio=?, nombreEjercicio=?, tipoEjercicio=? where idEjercicio=?");
    $stmt->execute(array($ejercicio->getDescripcion(), $ejercicio->getFoto(), $ejercicio->getVideo(), $ejercicio->getNombre(), $ejercicio->getTipo(), $ejercicio->getId() ));
  }

  public function delete(Ejercicio $ejercicio) {
    $stmt = $this->db->prepare("DELETE from ejercicios WHERE idEjercicio=?");
    $stmt->execute(array($ejercicio->getId()));
  }

}
