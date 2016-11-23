<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Activity.php");

/**
 * Class PostMapper
 *
 * Database interface for Post entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ActivityMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Retrieves all posts
   *
   * Note: Comments are not added to the Post instances
   *
   * @throws PDOException if a database error occurs
   * @return mixed Array of Post instances (without comments)
   */


  public function findAll() {
    $stmt = $this->db->query("SELECT * FROM actividad");
    $activites_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $activities = array();

    foreach ($activites_db as $activity) {
      array_push($activities, new Activity($activity["idActividad"], $activity["nombreActividad"], $activity["descripcionActividad"], $activity["plazasActividad"], $activity["idEntrenador"]));
    }

    return $activities;
  }

  /**
   * Loads a Post from the database given its id
   *
   * Note: Comments are not added to the Post
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL
   * if the Post is not found
   */
  public function findById($activityId){
    $stmt = $this->db->prepare("SELECT * FROM actividad WHERE idActividad=?");
    $stmt->execute(array($activityId));
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);

    if($activity != null) {
      return new Activity(
  $activity["idActividad"],
	$activity["nombreActividad"],
	$activity["descripcionActividad"],
	$activity["plazasActividad"],
	$activity["idEntrenador"]);
    } else {
      return NULL;
    }
  }

  /**
   * Loads a Post from the database given its id
   *
   * It includes all the comments
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL
   * if the Post is not found
   */
  public function getAllTrainers(){
    $stmt = $this->db->query("SELECT idUsuario,nombreUsuario FROM usuario WHERE tipoUsuario = 'E'");
    $trainers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $trainers = array();

    foreach ($trainers_db as $trainer) {
      $tr = new Usuario($trainer["idUsuario"],$trainer["nombreUsuario"]);
      array_push($trainers,$tr);
    }
    return $trainers;
  }

  public function getNameTrainer($idTrainer){
    $stmt = $this->db->query("SELECT nombreUsuario FROM usuario WHERE $idTrainer = idUsuario");
    $trainers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $trainers = array();
    
    foreach ($trainers_db as $trainer) {
      $tr = new Usuario("",$trainer["nombreUsuario"]);
      array_push($trainers,$tr);
    }
    return $trainers;
  }
  /**
   * Saves a Post into the database
   *
   * @param Post $post The post to be saved
   * @throws PDOException if a database error occurs
   * @return int The mew post id
   */

  public function save(Activity $activity) {
    $stmt = $this->db->prepare("INSERT INTO actividad(nombreActividad, descripcionActividad, plazasActividad,idEntrenador) values (?,?,?,?)");
    $stmt->execute(array($activity->getActivityName(), $activity->getActivityDesc(), $activity->getActivityPlaces(),$activity->getActivityTrainer()));
    return $this->db->lastInsertId();
  }

  /**
   * Updates a Activity in the database
   *
   * @param Post $post The post to be updated
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function update(Activity $activity) {
    $stmt = $this->db->prepare("UPDATE actividad set nombreActividad=?, descripcionActividad=?, plazasActividad=?, idEntrenador=? where idActividad=?");
    $stmt->execute(array($activity->getActivityName(), $activity->getActivityDesc(), $activity->getActivityPlaces(), $activity->getActivityTrainer(), $activity->getActivityId()));
  }

  /**
   * Deletes a Activity into the database
   *
   * @param Post $post The post to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Activity $activity) {
    $stmt = $this->db->prepare("DELETE from actividad WHERE idActividad=?");
    $stmt->execute(array($activity->getActivityId()));
  }

}
