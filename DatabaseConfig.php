<?php
 //Define your Server host name here.
 $HostName = "localhost";

 //Define your Database User Name here.
 $HostUser = "root";

  //Define your Database Password here.
  $HostPass = "";
 
 //Define your MySQL Database Name here.
 $DatabaseName = "foodforall_backend";

 $connection = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
