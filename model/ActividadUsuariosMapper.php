<?php
// file: model/usuarioMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/ActividadUsuarios.php");
require_once(__DIR__."/../model/usuario.php");

/**
 * Class usuarioMapper
 *
 * Database interface for Post entities
 *
 * @author MO
 */
class ActividadUsuariosMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

//supuestemante deberia traerte todos los usuarios de todos los tipos

  public function findAll() {

    $stmt = $this->db->prepare("SELECT * FROM participacion");
    $actUsers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $actUsers= array();

    foreach ($actUsers_db as $actU) {

      array_push($actUsers, new ActividadUsuario($actU["idUsuario"], $actU["idActivity"]));
    }

    return $actUsers;
  }

/*
  public function findAll() {

    $stmt = $this->db->prepare("SELECT t.idActivity,t.nombreActividad FROM Actividad t
    LEFT JOIN Actividad_usuario te ON t.idActivity = te.idActivity
    LEFT JOIN usuarios e ON e.idusuario=te.idusuario
    GROUP BY t.idActivity");
    $stmt->execute();
    $Actividadusuario_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $Actividadusuario_db;


    $ActividadUsuarios= array();


    foreach ($Actividadusuario_db as $Actividad_usuario) {

      array_push($ActividadUsuarios, new ActividadUsuarios($Actividad_usuario["idusuario"], $Actividad_usuario["idActivity"]);
    }

    return $ActividadUsuarios;
  }
*/
  public function findActividadUser($idActivity) {

    $stmt = $this->db->prepare(
      "SELECT e.nombreusuario FROM participacion te, usuario e, Actividad t
      WHERE e.idusuario = te.idusuario and t.idActividad = te.idActividad and t.idActividad = ?");

    $stmt->execute(array($idActivity));
    //$stmt->BindParam("1",$idActivity);

    $usuarios = array();
    while(  $usuario = $stmt->fetch(PDO::FETCH_ASSOC)){
      array_push($usuarios, new usuario(NULL,$usuario["nombreusuario"] ));
    }
    return $usuarios;


    /*$usuarios = array();

    foreach ($usuariosActividad_db as $usuario) {

      array_push($usuarios, new usuario($usuario["nombreusuario"] ));
    }
    return $usuarios;*/

  }

  //HAY QUE ADAPTARLAR TODA TODAVIA
  public function save(ActividadUsuarios $Actividadusuario) {

    $stmt = $this->db->prepare("INSERT INTO participacion values (?,?,?)");
    $stmt->execute(array($Actividadusuario->getIdusuario(), $Actividadusuario->getidActivity(),  $Actividadusuario->getdateToday()));
    return $this->db->lastInsertId();
  }


}
