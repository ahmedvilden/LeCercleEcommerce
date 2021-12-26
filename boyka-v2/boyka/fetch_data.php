<?php

//fetch_data.php

include('db_connect.php');

if(isset($_POST["action"]))
{
 $query = "
  SELECT * FROM product WHERE active = '1'
 ";
 if(isset($_POST["cat"]))
 {
  $brand_filter = implode("','", $_POST["cat"]);
  $query .= "
   AND categories_id IN('".$brand_filter."')
  ";
 }
 if(isset($_POST["gender"]))
 {
  $ram_filter = implode("','", $_POST["gender"]);
  $query .= "
   AND gender_id IN('".$ram_filter."')
  ";
 }

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
     <img src="image/'. $row['product_image'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['product_name'] .'</a></strong></p>
    </div>

   </div>
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 var_dump($output);die(); $output;
}

?>