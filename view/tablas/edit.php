<?php
 //file: view/posts/edit.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $tabla = $view->getVariable("tabla");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Tabla");

?><h1><?= i18n("Modificar Tabla") ?></h1>

<form action="index.php?controller=tablas&amp;action=edit" method="POST">

      <?= i18n("Nombre de la tabla") ?>:
      <input type="text" name="nombreTabla" value="<?= isset($_POST["nombreTabla"]) ? $_POST["nombreTabla"] : $tabla->getNombreTabla() ?>">
      <?= isset($errors["nombreTabla"])?$errors["nombreTabla"]:"" ?>
      <br>

      <input type="hidden" name="id" value="<?= $tabla->getIdTabla() ?>">
      <input type="submit" name="submit" value="<?= i18n("Modificar tabla") ?>">
</form>
