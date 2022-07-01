
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 

<?php

include "ajax.php";

?> 

<!DOCTYPE html>

<html>
<head>
        


 
 
<script>
  $(document).ready(function(){

  $("button").click(function(){

  $("temp").load("load-data.php");

  })

});

</script> 


<div id="temp">

  <?php
   


   if ($result = mysqli_query($coneccion, "SELECT * FROM animal")) {
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        echo $row;

  }
  }
  
  mysqli_close($con);


  
  
  ?>




</div>

</body>

</html>



