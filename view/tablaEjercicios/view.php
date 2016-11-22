<?php
 //file: view/posts/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/Ejercicio.php");

 $view = ViewManager::getInstance();

 $idTabla = $view->getVariable("idTabla");

 $ejercicios = $view->getVariable("ejercicios");
 $tablaEjercicios = $view->getVariable("tablaEjercicios");
 //$currentuser = $view->getVariable("currentusername");
 //$newcomment = $view->getVariable("comment");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "View Tabla");

?><h1><?= i18n("Ejercicios que contiene la tabla") ?></h1>



      <?php

      foreach($tablaEjercicios as $ejercicio): ?>
      <div>
      <?php

       echo $ejercicio->getNombre() ?>

      <br/>
      </div>

    <?php endforeach; ?>

    <form action="index.php?controller=tablasEjercicios&amp;action=add" method="POST">

    <select name="ejercicios">
      <?php foreach ($ejercicios as $ejercicio) { ?>

        <option value=" <?php echo $ejercicio->getId();?>" >
          <?php echo $ejercicio->getNombre();?>
        </option>

      <?php } ?>
    </select>
    <input type="hidden" name="idTabla" value="<?= $idTabla ?>">
    <input type="submit" name = "submit" value="submit">


  </form>
<br/>
