<?php
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");

   // Create a PDO instance (connect to the database)
   $opt   = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $db = new PDO('pgsql:host=152.74.52.250;port=5432;dbname=Matias;user=matiasmedina;password=Psmlgipxfq1',$opt);
   $data = array();


   // Attempt to query database table and retrieve data
   try {
      $stmt    = $db->query('SELECT * FROM members');
      while($row  = $stmt->fetch(PDO::FETCH_OBJ))
      {
         // Assign each row of data to associative array
         $data[] = $row;
      }

      // Return data as JSON
      echo json_encode($data);
   }
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }
?>
