<?php 
 //file: view/posts/add.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 
 $ejercicio = $view->getVariable("ejercicio");
 $errors = $view->getVariable("errors");
 
 $view->setVariable("title", "Edit Post");
 
?>
<h1><?= i18n("Create Exercise")?></h1>

      <form action="index.php?controller=ejercicios&amp;action=add" method="POST">

	    <?= i18n("Nombre") ?>: 
	    <input type="text" name="nombre"  value="<?= $ejercicio->getNombre() ?>">
	    <?= isset($errors["ejercicio"])?$errors["ejercicio"]:"" ?>

	    <br>

	    <?= i18n("Añada la foto(hacer un boton de examinar)") ?>: 
	    <input type="text" name="foto"  value="<?= $ejercicio->getFoto() ?>">
	    <?= isset($errors["foto"])?$errors["foto"]:"" ?>

	    <br>

	    <?= i18n("Añada un video explicativo(copiar una URL???)") ?>: 
	    <input type="text" name="video"  value="<?= $ejercicio->getVideo() ?>">
		<?= isset($errors["video"])?$errors["video"]:"" ?>
	    
	    <br>

		<?= i18n("Indique el tipo del ejercicio(hacer un boton de seleccion?)") ?>: 
	    <input type="text" name="tipo"  value="<?= $ejercicio->getTipo() ?>">
	    <?= isset($errors["tipo"])?$errors["tipo"]:"" ?>

	    <br>
	    
	    <?= i18n("Descripcion") ?>: 
	    <br>
	    <textarea name="descripcion" rows="4" cols="50">
	    </textarea>
	    <?= isset($errors["descripcion"])?$errors["descripcion"]:"" ?><br>
	    
	    <input type="submit" name="submit" value="submit">
      </form>
