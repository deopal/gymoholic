<?php

session_start();
$item_array_id=array();

if(isset($_POST["add"])){
    if(isset($_SESSION["cart"])){
       
        $count=count($_SESSION["cart"]);
            $item_array_id=array_column($_SESSION["cart"],"item_id");
            if(!in_array($_GET["id"],$item_array_id)){
                $_SESSION["cart"][$count]=array(
                           'item_id'=>$_GET["id"],
                           'item_name'=>$_POST["hidden_name"],
                           'item_price'=>$_POST["hidden_price"],
                           'item_quantity'=>$_POST["quantity"]
                       );
            }
            else{
                for($i=0;$i<count($item_array_id);$i++){
                    if($item_array_id[$i]==$_GET["id"]){
                        $_SESSION["cart"][$i]["item_quantity"]+=$_POST["quantity"];
                    }
                }
            }
    }
    else{
        $_SESSION["cart"][0]=array(
            'item_id' => $_GET["id"],
            'item_name'=> $_POST["hidden_name"],
            'item_price'=> $_POST["hidden_price"],
            'item_quantity'=> $_POST["quantity"]
        );
    }
}
if(isset($_GET["action"])){
    if($_GET["action"]=="delete"){
        foreach($_SESSION["cart"] as $keys => $values){
            if($values["item_id"]==$_GET["id"]){
                unset($_SESSION["cart"][$keys]);
                echo "<script> alert('item removed')</script>";
                echo "<script> window.location='cart.php'</script>";
                
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container m-auto d-block">
    <h3 class="bg-dark text-white text-center">Order Details</h3>
    <br><br>
    <div class="table-responsive">
    <table class="table table-bordered">
    <tr>
    <th width="40%">Item Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price</th>
    <th width="15%">Total</th>
    <th width="5%">Action</th>
    </tr>
    <?php
    if(!empty($_SESSION["cart"])){
        $total=0;
        foreach($_SESSION["cart"] as $keys => $values){
            ?>
            <tr>
            <td><?php echo $values["item_name"];?></td>
            <td><?php echo $values["item_quantity"];?></td>
            <td><?php echo $values["item_price"];?></td>
            <td><?php echo number_format($values["item_quantity"]*$values["item_price"],2);?></td>
            <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a></td>
            </tr>
            <?php
            $total=$total+($values["item_quantity"]*$values["item_price"]);
        }
        ?>
        <tr>
        <td colspan="3" align="right">Total</td>
        <th align="right">  &#8377; <?php echo number_format($total,2);?></th>
        <td></td>
        </tr>
        <?php
    }
    ?>
    </table>
    </div>
    </div>
</body>
</html>