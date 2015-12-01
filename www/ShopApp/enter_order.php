<html>
<body>
    <?php
  //connect to DATABASE

  $servername = "localhost:3360";
  $username = "root";
  $password = "root";
  $db = "dbshop";

  //create new connection
  //$connect = new mysqli($servername, $username, $password);

  //check connection
  //if(!$connect)
  {
    //die("connection failed: " . mysqli_connect_error());
  }

  //if(!$database = mysqli_connect($servername, $username, $password, $db)){
    //die("connection failed: " . mysqli_connect_error());
  //}
  //echo "connection successful";
   ?>


  <!--display order to screen-->
  You ordered <?php echo $_POST["num_items"]; ?> items <br>
  Your shopping list is: <?php echo $_POST["shopping_list"]; ?> <br>
  Your order should cost: $<?php echo $_POST["cost"]; ?><br>
  Your desired grocery store is:
  <?php $store = $_POST["grocery_store"];
  if($store == "Other"){
    echo $_POST["alt_store"];
  }
  else{
    echo $store;
  }
  ?>

</body>
</html>
