<?php
 //file: view/posts/index.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $tablas = $view->getVariable("tablas");
 //$currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "Tabla");

?><h1>Tablas</h1>
<!--
<table border="1">
      <tr>
  <th><?= i18n("Title")?></th><th><?= i18n("Author")?></th><th><?= i18n("Actions")?></th>
      </tr>-->

    <?php foreach ($tablas as $tabla): ?>

      <div>
        <?php echo $tabla->getNombreTabla() ?>
        <br/>
        <br/>

         <form
        method="POST"
        action="index.php?controller=tablas&amp;action=delete"
        id="delete_tabla_<?= $tabla->getIdTabla(); ?>"
        style="display: inline"
        >

        <input type="hidden" name="id" value="<?= $tabla->getIdTabla() ?>">

        <a href="#"
          onclick="
          if (confirm('<?= i18n("are you sure?")?>')) {
          document.getElementById('delete_tabla_<?= $tabla->getIdTabla() ?>').submit()
          }"
        ><?= i18n("Delete") ?></a>

      </form>

        <a href="index.php?controller=tablas&amp;action=edit&amp;id=<?= $tabla->getIdTabla() ?>"><?= i18n("Edit") ?></a>
        <a href="index.php?controller=tablasEjercicios&amp;action=viewExercises&amp;id=<?= $tabla->getIdTabla() ?>"><?= i18n("Ver Ejercicios de la tabla") ?></a>
      </div>

      <br/>

    <?php endforeach; ?>

      <a href="index.php?controller=tablas&amp;action=add"><?= i18n("Añadir Tabla") ?></a>
      <br/>
