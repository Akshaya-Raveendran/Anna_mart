<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: sign-up form.php");
   }
?>