<?php
 //file: view/posts/index.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $actividades = $view->getVariable("actividades");
 //$currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "Actividad");

?><h1>Actividads</h1>
<!--
<table border="1">
      <tr>
  <th><?= i18n("Title")?></th><th><?= i18n("Author")?></th><th><?= i18n("Actions")?></th>
      </tr>-->

    <?php foreach ($actividades as $actividad): ?>

      <div>
        <?php echo $actividad->getActivityName() ?>
        <br/>
        <br/>

         <form
        method="POST"
        action="index.php?controller=actividades&amp;action=delete"
        id="delete_tabla_<?= $actividad->getIdActividad(); ?>"
        style="display: inline"
        >

        <input type="hidden" name="id" value="<?= $actividad->getIdActividad() ?>">

        <a href="#"
          onclick="
          if (confirm('<?= i18n("are you sure?")?>')) {
          document.getElementById('delete_tabla_<?= $actividad->getIdActividad() ?>').submit()
          }"
        ><?= i18n("Delete") ?></a>

      </form>

        <a href="index.php?controller=actividades&amp;action=edit&amp;id=<?= $actividad->getIdActividad() ?>"><?= i18n("Edit") ?></a>
        <a href="index.php?controller=actividadesEjercicios&amp;action=viewExercises&amp;id=<?= $actividad->getIdActividad() ?>"><?= i18n("Ver Ejercicios de la actividad") ?></a>
      </div>

      <br/>

    <?php endforeach; ?>

      <a href="index.php?controller=actividades&amp;action=add"><?= i18n("Añadir Actividad") ?></a>
      <br/>
