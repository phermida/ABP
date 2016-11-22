<?php
 //file: view/posts/add.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $tabla = $view->getVariable("tabla");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "Edit Tabla");

?>
<h1><?= i18n("Alta Tabla")?></h1>

      <form action="index.php?controller=tablas&amp;action=add" method="POST">

	    <?= i18n("Nombre") ?>:
	    <input type="text" name="nombreTabla"  value="<?= $tabla->getNombreTabla() ?>">
	    <?= isset($errors["tabla"])?$errors["tabla"]:"" ?>

	    <br>


	    <input type="submit" name="submit" value="Añadir Tabla">
      </form>
