<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");

/**
 * Class Post
 *
 * Represents a Post in the blog. A Post was written by an
 * specific User (author) and contains a list of Comments
 *
 * @author lipido <lipido@gmail.com>
 */
class Activity {

  /**
   * The id of this post
   * @var string
   */
  private $ActivityId;

  /**
   * The title of this post
   * @var string
   */
  private $ActivityName;

  /**
   * The content of this post
   * @var string
   */
  private $ActivityDesc;

  /**
   * The list of comments of this post
   * @var mixed
   */
  private $ActivityPlaces;

  /**
   * The author of this post
   * @var User
   */
  private $ActivityTrainer;


  /**
   * The constructor
   *
   * @param string $id The id of the post
   * @param string $title The id of the post
   * @param string $content The content of the post
   * @param User $author The author of the post
   * @param mixed $comments The list of comments
   */
  public function __construct($ActivityId=NULL, $ActivityName=NULL, $ActivityDesc=NULL, $ActivityPlaces=NULL, $ActivityTrainer=NULL) {
    $this->id = $ActivityId;
    $this->name = $ActivityName;
    $this->description = $ActivityDesc;
    $this->places = $ActivityPlaces;
    $this->trainer = $ActivityTrainer;

  }

  /**
   * Gets the id of this post
   *
   * @return string The id of this post
   */
  public function getActivityId() {
    return $this->id;
  }

  /**
   * Gets the title of this post
   *
   * @return string The title of this post
   */
  public function getActivityName() {
    return $this->name;
  }

  /**
   * Sets the title of this post
   *
   * @param string $title the title of this post
   * @return void
   */
  public function setActivityName($name) {
    $this->name = $name;
  }

  /**
   * Gets the content of this post
   *
   * @return string The content of this post
   */
  public function getActivityDesc() {
    return $this->description;
  }

  /**
   * Sets the content of this post
   *
   * @param string $content the content of this post
   * @return void
   */
  public function setActivityDesc($description) {
    $this->description = $description;
  }

  /**
   * Gets the author of this post
   *
   * @return User The author of this post
   */
  public function getActivityTrainer() {
    return $this->trainer;
  }

  /**
   * Sets the author of this post
   *
   * @param User $author the author of this post
   * @return void
   */
  public function setActivityTrainer($trainer) {
    $this->trainer = $trainer;
  }

  /**
   * Gets the list of comments of this post
   *
   * @return mixed The list of comments of this post
   */
  public function getActivityPlaces() {
    return $this->places;
  }

  /**
   * Sets the comments of the post
   *
   * @param mixed $comments the comments list of this post
   * @return void
   */
  public function setActivityPlaces($places) {
    $this->places = $places;
  }

  /**
   * Checks if the current instance is valid
   * for being updated in the database.
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
  public function checkIsValidForCreate() {
      $errors = array();
      if (strlen(trim($this->name)) == 0 ) {
	$errors["activityName"] = "name is mandatory";
      }
      if (strlen(trim($this->description)) == 0 ) {
	$errors["activityDesc"] = "description is mandatory";
      }
      if (strlen(trim($this->places)) == 0 ) {
  $errors["activityPlaces"] = "number of places is mandatory";
      }

      if (sizeof($errors) > 0){
	throw new ValidationException($errors, "activity is not valid");
      }
  }

  /**
   * Checks if the current instance is valid
   * for being updated in the database.
   *
   * @throws ValidationException if the instance is
   * not valid
   *
   * @return void
   */
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
      throw new ValidationException($errors, "activity is not valid");
    }
  }
}
