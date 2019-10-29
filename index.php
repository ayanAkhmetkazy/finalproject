<?php session_start();?>
<?php

   function __autoload($className){
      require_once($className.'.php');
   }
   use controllers\MainController;
   $controller = new MainController();
   require_once "views/".$controller->process().".php";
?>