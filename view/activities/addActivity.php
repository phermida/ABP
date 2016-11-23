<?php
 //file: view/posts/add.php
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/ActivityMapper.php");
 $view = ViewManager::getInstance();

 $activity = $view->getVariable("activity");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Add Activity");

?><h1><?= i18n("Create activity")?></h1>
      <form action="index.php?controller=activities&amp;action=add" method="POST">
	    <?= i18n("Name") ?>: <input type="text" name="activityName"
			     value="<?= $activity->getActivityName() ?>">
	    <?= isset($errors["activityName"])?$errors["activityName"]:"" ?><br>

      <?= i18n("Description") ?>: <input type="text" name="activityDesc"
           value="<?= $activity->getActivityDesc() ?>">
      <?= isset($errors["activityDesc"])?$errors["activityDesc"]:"" ?><br>

      <?= i18n("Places") ?>: <input type="text" name="activityPlaces"
           value="<?= $activity->getActivityPlaces() ?>">
      <?= isset($errors["activityPlaces"])?$errors["activityPlaces"]:"" ?><br>


      <?php $aMapper = new ActivityMapper();?>
      <?= i18n("Trainer") ?>:
      <select id="idTrainer" name="activityTrainer">
        <?php $trainers = $aMapper->getAllTrainers() ?>
         <option value = "">--Seleccionar--</option>
       <?php
       foreach ($trainers as $trainer) {?>
         <option value="<?= $trainer->getIdUsuario() ?>"><?= $trainer->getNombre() ?></option><?php

       }
       ?>

       </select>
      <?= isset($errors["activityTrainer"])?$errors["activityTrainer"]:"" ?><br>


	    <input type="submit" name="submit" value="submit">
      </form>
