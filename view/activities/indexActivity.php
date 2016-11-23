<?php
 //file: view/activities/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activities = $view->getVariable("activities");
 $currentuser = $view->getVariable("currentusername");

 $view->setVariable("name", "Activities");

?><h1><?=i18n("Activities")?></h1>
<table border="1">
      <tr>
	<th><?= i18n("Name")?></th><th><?= i18n("Description")?></th><th><?= i18n("Plazas")?></th><th><?= i18n("Trainer")?></th>
      </tr>

    <?php foreach ($activities as $activity): ?>
	    <tr>
	      <td>
		    <a href="index.php?controller=activities&amp;action=view&amp;id=<?= $activity->getActivityId() ?>"><?= htmlentities($activity->getActivityName()) ?></a>
	      </td>
	      <td>
		<?= htmlentities($activity->getActivityDesc()) ?>
	      </td>
        <td>
    <?= htmlentities($activity->getActivityPlaces()) ?>
        </td>
        <?php $aMapper = new ActivityMapper();?>
        <?php $trainers = $aMapper->getNameTrainer($activity->getActivityTrainer()) ?>
        <td>
        <?php   foreach ($trainers as $trainer) {?>
    <?= htmlentities($trainer->getNombre()) ?>
    <?php

  }
  ?>
        </td>
	      <td>
		<?php
		//show actions ONLY for the author of the post (if logged)


		//if (isset($currentuser) && $currentuser == $activity->getActivityTrainer()->getUsername()): ?>

		  <?php
		  // 'Delete Button': show it as a link, but do POST in order to preserve
		  // the good semantic of HTTP
		  ?>
		  <form
		    method="POST"
		    action="index.php?controller=activities&amp;action=delete"
		    id="delete_activity_<?= $activity->getActivityId(); ?>"
		    style="display: inline"
		    >

		    <input type="hidden" name="id" value="<?= $activity->getActivityId() ?>">
		    <a href="#"
		      onclick="
		      if (confirm('<?= i18n("are you sure?")?>')) {
			    document.getElementById('delete_activity_<?= $activity->getActivityId() ?>').submit()
		      }"
		    ><?= i18n("Delete") ?></a>

		  </form>

		  &nbsp;

		  <?php
		  // 'Edit Button'
		  ?>
		  <a href="index.php?controller=activities&amp;action=edit&amp;id=<?= $activity->getActivityId() ?>"><?= i18n("Edit") ?></a>

		<?php //endif; ?>

	      </td>
	    </tr>
    <?php endforeach; ?>

    </table>
     <?php //if (isset($currentuser)): ?>
      <a href="index.php?controller=activities&amp;action=add"><?= i18n("Create activity") ?></a>
    <?php //endif; ?>
