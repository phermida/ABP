<?php
//file: controller/PostController.php

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/Usuario.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class PostsController
 *
 * Controller to make a CRUDL of Posts entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ActivitiesController extends BaseController {

  /**
   * Reference to the PostMapper to interact
   * with the database
   *
   * @var PostMapper
   */
  private $activityMapper;

  public function __construct() {
    parent::__construct();

    $this->activityMapper = new ActivityMapper();
  }

  /**
   * Action to list posts
   *
   * Loads all the posts from the database.
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>posts/index (via include)</li>
   * </ul>
   */
  public function index() {

    // obtain the data from the database
    $activities = $this->activityMapper->findAll();

    // put the array containing Activity object to the view
    $this->view->setVariable("activities", $activities);

    // render the view (/view/activities/index.php)
    $this->view->render("activities", "indexActivity");
  }

  public function view() {

    // obtain the data from the database
    $activities = $this->activityMapper->findAll();

    // put the array containing Activity object to the view
    $this->view->setVariable("activities", $activities);

    // render the view (/view/activities/index.php)
    $this->view->render("activities", "viewActivity");
  }

  /**
   * Action to view a given post
   *
   * This action should only be called via GET
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the post (via HTTP GET)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/view: If post is successfully loaded (via include).  Includes these view variables:</li>
   * <ul>
   *  <li>post: The current Post retrieved</li>
   *  <li>comment: The current Comment instance, empty or
   *  being added (but not validated)</li>
   * </ul>
   * </ul>
   *
   * @throws Exception If no such post of the given id is found
   * @return void
   *
   */
  public function viewActivity(){
    if (!isset($_GET["id"])) {
      throw new Exception("id is mandatory");
    }

    $activityId = $_GET["id"];

    // find the Post object in the database
    $activity = $this->activityMapper->findById($activityId);

    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$activityId);
    }

    // put the Post object to the view
    $this->view->setVariable("activity", $activity);

    // check if comment is already on the view (for example as flash variable)
    // if not, put an empty Comment for the view
    // $comment = $this->view->getVariable("comment");
    // $this->view->setVariable("comment", ($comment==NULL)?new Comment():$comment);

    // render the view (/view/posts/view.php)
    $this->view->render("activities", "view");

  }

  /**
   * Action to add a new post
   *
   * When called via GET, it shows the add form
   * When called via POST, it adds the post to the
   * database
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>title: Title of the post (via HTTP POST)</li>
   * <li>content: Content of the post (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/add: If this action is reached via HTTP GET (via include)</li>
   * <li>posts/index: If post was successfully added (via redirect)</li>
   * <li>posts/add: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>post: The current Post instance, empty or
   *  being added (but not validated)</li>
   *  <li>errors: Array including per-field validation errors</li>
   * </ul>
   * </ul>
   * @throws Exception if no user is in session
   * @return void
   */
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Adding activities requires login");
    }

    $activity = new Activity();
    if (isset($_POST["submit"])) { // reaching via HTTP Post...
      // populate the Post object with data form the form
      $activity->setActivityName($_POST["activityName"]);
      $activity->setActivityDesc($_POST["activityDesc"]);
      $activity->setActivityPlaces($_POST["activityPlaces"]);
      $activity->setActivityTrainer($_POST["activityTrainer"]);

      // The user of the Post is the currentUser (user in session)
      //$activity->setTrainer($this->currentUser);


      try {
	// validate Post object
	$activity->checkIsValidForCreate(); // if it fails, ValidationException

	// save the Post object into the database
	$this->activityMapper->save($activity);
	// POST-REDIRECT-GET
	// Everything OK, we will redirect the user to the list of posts
	// We want to see a message after redirection, so we establish
	// a "flash" message (which is simply a Session variable) to be
	// get in the view after redirection.
	$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully added."),$activity ->getActivityName()));

	// perform the redirection. More or less:
	// header("Location: index.php?controller=posts&action=index")
	// die();
	$this->view->redirect("activities", "index");

      }catch(ValidationException $ex) {
	// Get the errors array inside the exepction...
	$errors = $ex->getErrors();
	// And put it to the view as "errors" variable
	$this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("activity", $activity);

    // render the view (/view/posts/add.php)
    $this->view->render("activities", "addActivity");

  }

  /**
   * Action to edit a post
   *
   * When called via GET, it shows an edit form
   * including the current data of the Post.
   * When called via POST, it modifies the post in the
   * database.
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the post (via HTTP POST and GET)</li>
   * <li>title: Title of the post (via HTTP POST)</li>
   * <li>content: Content of the post (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/edit: If this action is reached via HTTP GET (via include)</li>
   * <li>posts/index: If post was successfully edited (via redirect)</li>
   * <li>posts/edit: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>post: The current Post instance, empty or being added (but not validated)</li>
   *  <li>errors: Array including per-field validation errors</li>
   * </ul>
   * </ul>
   * @throws Exception if no id was provided
   * @throws Exception if no user is in session
   * @throws Exception if there is not any post with the provided id
   * @throws Exception if the current logged user is not the author of the post
   * @return void
   */
  public function edit() {
    if (!isset($_REQUEST["id"])) {
      throw new Exception("A activity id is mandatory");
    }

    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing activites requires login");
    }


    // Get the Post object from the database
    $activityId = $_REQUEST["id"];
    $activity = $this->activityMapper->findById($activityId);

    // Does the post exist?
    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$activityId);
    }

    // Check if the Post author is the currentUser (in Session)
    //if ($activity->getAuthor() != $this->currentUser) {
    //  throw new Exception("logged user is not the trainer of the activity id ".$activityId);
    //}

    if (isset($_POST["submit"])) { // reaching via HTTP Post...

      // populate the Post object with data form the form
      $activity->setActivityName($_POST["activityName"]);
      $activity->setActivityDesc($_POST["activityDesc"]);
      $activity->setActivityPlaces($_POST["activityPlaces"]);
      $activity->setActivityTrainer($_POST["activityTrainer"]);
      try {
	// validate Post object
	$activity->checkIsValidForUpdate(); // if it fails, ValidationException

	// update the Post object in the database
	$this->activityMapper->update($activity);

	// POST-REDIRECT-GET
	// Everything OK, we will redirect the user to the list of posts
	// We want to see a message after redirection, so we establish
	// a "flash" message (which is simply a Session variable) to be
	// get in the view after redirection.
	$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully updated."),$activity ->getActivityName()));

	// perform the redirection. More or less:
	// header("Location: index.php?controller=posts&action=index")
	// die();
	$this->view->redirect("activities", "index");

      }catch(ValidationException $ex) {
	// Get the errors array inside the exepction...
	$errors = $ex->getErrors();
	// And put it to the view as "errors" variable
	$this->view->setVariable("errors", $errors);
      }
    }

    // Put the Post object visible to the view
    $this->view->setVariable("activity", $activity);

    // render the view (/view/posts/add.php)
    $this->view->render("activities", "editActivity");
  }

  /**
   * Action to delete a post
   *
   * This action should only be called via HTTP POST
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>id: Id of the post (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/index: If post was successfully deleted (via redirect)</li>
   * </ul>
   * @throws Exception if no id was provided
   * @throws Exception if no user is in session
   * @throws Exception if there is not any post with the provided id
   * @throws Exception if the author of the post to be deleted is not the current user
   * @return void
   */
  public function delete() {
    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing activities requires login");
    }

     // Get the Post object from the database
    $activityId = $_POST["id"];
    $activity = $this->activityMapper->findById($activityId);

    // Does the post exist?
    if ($activity == NULL) {
      throw new Exception("no such activity with id: ".$activityId);
    }

    // Check if the Post author is the currentUser (in Session)
  //  if ($activity->getTrainer() != $this->currentUser) {
  //    throw new Exception("Activity trainer is not the logged user");
  //  }

    // Delete the Post object from the database
    $this->activityMapper->delete($activity);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of posts
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."),$activity->getActivityName()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=posts&action=index")
    // die();
    $this->view->redirect("activities", "index");

  }
}
