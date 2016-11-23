<?php
 //file: view/posts/index.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $activities = $view->getVariable("activities");
 //$currentuser = $view->getVariable("currentusername");

 $view->setVariable("name", "Activities");

 ?><h1><?=i18n("Activities")?></h1>
 <table border="1">
       <tr>
 	<th><?= i18n("Name")?></th><th><?= i18n("Description")?></th><th><?= i18n("Plazas")?></th><th><?= i18n("Trainer")?></th>
       </tr>

       <?php foreach ($activities as $activity): ?>

        <div>
          <?php echo $activity->getActivityName() ?>
          <br/>
          <br/>

          <input type="hidden" name="id" value="<?= $activity->getActivityId() ?>">

        </form>
          <a href="index.php?controller=actividadesusuarios&amp;action=viewUsers&amp;id=<?= $activity->getActivityId() ?>"><?= i18n("Ver Usuarios de la actividad") ?></a>
        </div>

        <br/>

      <?php endforeach; ?>

        <a href="index.php?controller=actividades&amp;action=add"><?= i18n("Añadir Actividad") ?></a>
        <br/>
