<?php
// file: model/EjercicioMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Tabla.php");

/**
 * Class EjercicioMapper
 *
 * Database interface for Post entities
 *
 * @author MO
 */
class TablaMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }


//supuestemante deberia traerte todos los ejercicios de todos los tipos
  public function findAll() {

    $stmt = $this->db->query("SELECT * FROM tabla");
    $tabla_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tablas = array();

    foreach ($tabla_db as $tabla) {

      array_push($tablas, new Tabla($tabla["idTabla"], $tabla["nombreTabla"]));
    }

    return $tablas;
  }

  public function findById($tablaid){
    $stmt = $this->db->prepare("SELECT * FROM tabla WHERE idTabla=?");
    $stmt->execute(array($tablaid));
    $tabla = $stmt->fetch(PDO::FETCH_ASSOC);



    if($tabla != null) {

      return new Tabla(
      $tabla["idTabla"],
      $tabla["nombreTabla"]
      );
    } else {
      return NULL;
    }
  }


  public function save(Tabla $tabla) {

    $stmt = $this->db->prepare("INSERT INTO tabla(nombreTabla) values (?)");
    $stmt->execute(array($tabla->getNombreTabla() ));
    return $this->db->lastInsertId();
  }

  public function update(Tabla $tabla) {
    $stmt = $this->db->prepare("UPDATE tabla set nombreTabla=? where idTabla=?");
    $stmt->execute(array( $tabla->getNombreTabla(), $tabla->getIdTabla() ));
  }

  public function delete(Tabla $tabla) {
    $stmt = $this->db->prepare("DELETE from tabla WHERE idTabla=?");
    $stmt->execute(array($tabla->getIdTabla()));
  }

}
