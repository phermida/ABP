<?php
 //file: view/posts/edit.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activity = $view->getVariable("activity");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Activity");

?><h1><?= i18n("Modify activity") ?></h1>

<form action="index.php?controller=activities&amp;action=edit" method="POST">

      <?= i18n("Name") ?>: <input type="text" name="activityName"
		    value="<?= isset($_POST["activityName"])?$_POST["activityName"]:$activity->getActivityName() ?>">
      <?= isset($errors["activityName"])?$errors["activityName"]:"" ?><br>

      <?= i18n("Description") ?>: <input type="text" name="activityDesc"
      	value="<?= isset($_POST["activityDesc"])?$_POST["activityDesc"]:$activity->getActivityDesc() ?>">
      <?= isset($errors["activityDesc"])?$errors["activityDesc"]:"" ?><br>

      <?= i18n("Places") ?>: <input type="text" name="activityPlaces"
      	value="<?= isset($_POST["activityPlaces"])?$_POST["activityPlaces"]:$activity->getActivityPlaces() ?>">
      <?= isset($errors["activityPlaces"])?$errors["activityPlaces"]:"" ?><br>

      <?php $aMapper = new ActivityMapper();?>
      <?= i18n("Trainer") ?>:
      <select id="idTrainer" name="activityTrainer">
        <?php $trainers = $aMapper->getAllTrainers() ?>
         <option value = ""><?= $activity->getActivityTrainer() ?></option>
       <?php
       foreach ($trainers as $trainer) {?>
         <option value="<?= $trainer->getIdUsuario() ?>"><?= $trainer->getNombre() ?></option><?php

       }
       ?>

       </select>
      <?= isset($errors["activityTrainer"])?$errors["activityTrainer"]:"" ?><br>

      <input type="hidden" name="id" value="<?= $activity->getActivityId() ?>">
      <input type="submit" name="submit" value="<?= i18n("Modify activity") ?>">
</form>
