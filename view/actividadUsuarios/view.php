<?php
 //file: view/posts/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/Usuario.php");

 $view = ViewManager::getInstance();

 $idActivity = $view->getVariable("idActivity");
 $dateToday = strftime('%D');

 $usuarios = $view->getVariable("usuarios");
 $actividades = $view->getVariable("ActividadUsuarios");
 //$currentuser = $view->getVariable("currentusername");
 //$newcomment = $view->getVariable("comment");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "View Actividad");


?><h1><?= i18n("Usuarios que participan en la actividad") ?></h1>


<h2>Actividad ID: <?= i18n($idActivity) ?></h2>
      <?php

      foreach($actividades as $actividad): ?>
      <div>
      <?php

       echo $actividad->getNombre(); ?>

      <br/>
      </div>

    <?php endforeach; ?>

    <form action="index.php?controller=actividadesusuarios&amp;action=add" method="POST">

    <select name="usuarios">
      <?php foreach ($usuarios as $usuario) { ?>

        <option value=" <?php echo $usuario->getIdusuario();?>" >
          <?php echo $usuario->getNombre();?>
        </option>

      <?php } ?>
    </select>
    <input type="hidden" name="idActivity" value="<?= $idActivity ?>">
    <input type="hidden" name="dateToday" value="<?= $dateToday ?>">
    <input type="submit" name = "submit" value="submit">


  </form>
<br/>
