<?php
$idprod = $_GET["id"];
if($_POST["add_to_cart"])  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Product already added !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct='$idprod'\");	
        		</SCRIPT>";  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 } 
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo "<SCRIPT type='text/javascript'> //not showing me this
        		alert('Item removed !');
       			 window.location.replace(\"http://localhost/stock/boyka-v2/boyka/productdetails.php?idproduct='$idprod'\");	
        		</SCRIPT>";
                }  
           }  
      }  
}
?>