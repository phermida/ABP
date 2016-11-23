<?php
 //file: view/layouts/default.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
  <head>
    <title><?= $view->getVariable("title", "no title") ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
  </head>
  <body>
    <!-- header -->
    <header>
      <h1>MO-GYM</h1>
      <nav id="menu" style="background-color:grey">
	<ul>
	<li><a href="index.php?controller=ejercicios&amp;action=index">Gestion Ejercicios</a></li>
  <li><a href="index.php?controller=tablas&amp;action=index">Gestión Tablas</a></li>
  <li><a href="index.php?controller=activities&amp;action=index">Gestión Actividades</a></li>
  <li><a href="index.php?controller=ActividadesUsuarios&amp;action=index">Gestión Participaciones</a></li>

	<?php if (isset($currentuser)): ?>
	  <li><?= sprintf(i18n("Hello %s"), $currentuser) ?>
	  <a 	href="index.php?controller=users&amp;action=logout">(Logout)</a>
	  </li>

	<?php else: ?>
	  <li><a href="index.php?controller=users&amp;action=login"><?= i18n("Login") ?></a></li>
	  <?php endif ?>
	</ul>
      </nav>
    </header>

    <main>
      <div id="flash">
	       <?= $view->popFlash() ?>
      </div>
      <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </main>

    <!--<footer>
      <?php
      include(__DIR__."/language_select_element.php");
      ?>
    </footer>-->

  </body>
</html>
