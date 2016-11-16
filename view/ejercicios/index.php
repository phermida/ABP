<?php 
 //file: view/posts/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 
 $ejercicios = $view->getVariable("ejercicios");
 //$currentuser = $view->getVariable("currentusername");
 
 //$view->setVariable("title", "Posts");
 
?><h1>Ejercicios</h1>
<!--
<table border="1">
      <tr>
	<th><?= i18n("Title")?></th><th><?= i18n("Author")?></th><th><?= i18n("Actions")?></th>
      </tr>-->
    
    <?php foreach ($ejercicios as $ejercicio): ?>

    	<div>
    		<?php echo $ejercicio->getNombre() ?>
    		<br/>
    		<?php echo $ejercicio->getDescripicion() ?>
        <br/>
        <?php echo $ejercicio->getFoto() ?>
        <br/>
        <?php echo $ejercicio->getVideo() ?>
        <br/>
        <?php echo $ejercicio->getTipo() ?>

    	</div>

    	<br/>
    	<br/>

    <?php endforeach; ?>


  
      <a href="index.php?controller=ejercicios&amp;action=add"><?= i18n("Añadir Ejercicio") ?></a>
      <br/>
      <a href="index.php?controller=ejercicios&amp;action=edit"><?= i18n("Editar Ejercicio") ?></a>
      <br/>
      <a href="index.php?controller=ejercicios&amp;action=delete"><?= i18n("Eliminar Ejercicio") ?></a>   



    
