<?php 
 //file: view/posts/edit.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 
 $ejercicio = $view->getVariable("ejercicio");
 $errors = $view->getVariable("errors");
 
 $view->setVariable("title", "Edit Exercise");
 
?><h1><?= i18n("Modify Exercise") ?></h1>

<form action="index.php?controller=ejercicios&amp;action=edit" method="POST">

      <?= i18n("Nombre") ?>:
      <input type="text" name="nombre" value="<?= isset($_POST["nombre"]) ? $_POST["nombre"] : $ejercicio->getNombre() ?>">
      <?= isset($errors["nombre"])?$errors["nombre"]:"" ?>
      <br>
      
      <?= i18n("Descripcion") ?>:
      <br>
      <textarea name="descripcion" rows="4" cols="50"><?=isset($_POST["descripcion"])?
	      htmlentities($_POST["descripcion"]):
	      htmlentities($ejercicio->getDescripcion()) ?></textarea>
            
      <?= isset($errors["descripcion"])?$errors["descripcion"]:"" ?><br>

      <?= i18n("Foto") ?>:
      <input type="text" name="foto" value="<?= isset($_POST["foto"])?$_POST["foto"]:$ejercicio->getFoto() ?>">
      <?= isset($errors["foto"])?$errors["foto"]:"" ?>
      <br>

      <?= i18n("Video") ?>:
      <input type="text" name="video" value="<?= isset($_POST["video"])?$_POST["video"]:$ejercicio->getVideo() ?>">
      <?= isset($errors["video"])?$errors["video"]:"" ?>
      <br>

      <?= i18n("Tipo") ?>:
      <input type="text" name="tipo" value="<?= isset($_POST["tipo"])?$_POST["tipo"]:$ejercicio->getTipo() ?>">
      <?= isset($errors["tipo"])?$errors["tipo"]:"" ?>
      <br>


      <input type="hidden" name="id" value="<?= $ejercicio->getId() ?>">
      <input type="submit" name="submit" value="<?= i18n("Modify post") ?>">
</form>
    
