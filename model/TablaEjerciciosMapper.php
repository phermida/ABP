<?php
// file: model/EjercicioMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/TablaEjercicios.php");
require_once(__DIR__."/../model/Ejercicio.php");

/**
 * Class EjercicioMapper
 *
 * Database interface for Post entities
 *
 * @author MO
 */
class TablaEjerciciosMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

//supuestemante deberia traerte todos los ejercicios de todos los tipos

  public function findAll($idtabla) {

    $stmt = $this->db->prepare("SELECT * FROM ejercicios WHERE idEjercicio != ?  ");
    $stmt->execute(array($idtabla));
    $ejercicio_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ejercicios= array();

    foreach ($ejercicio_db as $ejercicio) {

      array_push($ejercicios, new Ejercicio($ejercicio["idEjercicio"], $ejercicio["nombreEjercicio"], $ejercicio["descripcionEjercicio"], $ejercicio["fotoEjercicio"], $ejercicio["videoEjercicio"], $ejercicio["tipoEjercicio"]));
    }

    return $ejercicios;
  }

/*
  public function findAll() {

    $stmt = $this->db->prepare("SELECT t.idTabla,t.nombreTabla FROM tabla t
    LEFT JOIN tabla_ejercicio te ON t.idTabla = te.idTabla
    LEFT JOIN ejercicios e ON e.idEjercicio=te.idEjercicio
    GROUP BY t.idTabla");
    $stmt->execute();
    $tablaEjercicio_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tablaEjercicio_db;


    $tablaEjercicios= array();


    foreach ($tablaEjercicio_db as $tabla_ejercicio) {

      array_push($tablaEjercicios, new TablaEjercicios($tabla_ejercicio["idEjercicio"], $tabla_ejercicio["idTabla"]);
    }

    return $tablaEjercicios;
  }
*/
  public function findTablaExercise($idTabla) {

    $stmt = $this->db->prepare(
      "SELECT e.nombreEjercicio FROM tabla_ejercicio te, ejercicios e, tabla t
      WHERE e.idEjercicio = te.idEjercicio and t.idTabla = te.idTabla and t.idTabla = ?");

    $stmt->execute(array($idTabla));
    //$stmt->BindParam("1",$idTabla);

    $ejercicios = array();
    while(  $ejercicio = $stmt->fetch(PDO::FETCH_ASSOC)){
      array_push($ejercicios, new Ejercicio(NULL,$ejercicio["nombreEjercicio"] ));
    }
    return $ejercicios;


    /*$ejercicios = array();

    foreach ($ejerciciosTabla_db as $ejercicio) {

      array_push($ejercicios, new Ejercicio($ejercicio["nombreEjercicio"] ));
    }
    return $ejercicios;*/

  }

  //HAY QUE ADAPTARLAR TODA TODAVIA
  public function save(TablaEjercicios $tablaEjercicio) {

    $stmt = $this->db->prepare("INSERT INTO tabla_ejercicio values (?,?)");
    $stmt->execute(array($tablaEjercicio->getIdEjercicio(), $tablaEjercicio->getIdTabla() ));
    return $this->db->lastInsertId();
  }


}
