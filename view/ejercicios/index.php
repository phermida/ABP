<?php 
 //file: view/posts/index.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 
 $ejercicios = $view->getVariable("ejercicios");
 //$currentuser = $view->getVariable("currentusername");
 
 $view->setVariable("title", "Exercise");
 
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
        <?php echo $ejercicio->getDescripcion() ?>
        <br/>
        <?php echo $ejercicio->getFoto() ?>
        <br/>
        <?php echo $ejercicio->getVideo() ?>
        <br/>
        <?php echo $ejercicio->getTipo() ?>
        <br/>
        
         <form        
        method="POST" 
        action="index.php?controller=ejercicios&amp;action=delete" 
        id="delete_ejercicio_<?= $ejercicio->getId(); ?>"
        style="display: inline" 
        >
      
        <input type="hidden" name="id" value="<?= $ejercicio->getId() ?>">
      
        <a href="#" 
          onclick="
          if (confirm('<?= i18n("are you sure?")?>')) {
          document.getElementById('delete_ejercicio_<?= $ejercicio->getId() ?>').submit() 
          }"
        ><?= i18n("Delete") ?></a>
      
      </form>


        <br/>
        <a href="index.php?controller=ejercicios&amp;action=edit&amp;id=<?= $ejercicio->getId() ?>"><?= i18n("Edit") ?></a>
      </div>

      <br/>
      <br/>

    <?php endforeach; ?>

      <a href="index.php?controller=ejercicios&amp;action=add"><?= i18n("Añadir Ejercicio") ?></a>
      <br/>
      
      <br/>
      

