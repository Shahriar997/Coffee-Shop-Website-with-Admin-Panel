<?php
session_start();
include 'connection.php';
if(isset($_SESSION["admin"])){
    if($_SESSION["admin"]){
        if(isset($_GET['action'])){
            if($_GET['action'] == "reject"){
                $sql = "DELETE FROM `pending order` WHERE id = '".$_GET['id']."'";
                if(mysqli_query($conn, $sql)){
                    echo '<script> alert("Order Has Been Rejected") </script>';
                    echo '<script>window.location="pendingOrders.php"</script>';
                }else{
                    echo '<script> alert("Can not reject! There has been a problem") </script>';
                    echo '<script>window.location="pendingOrders.php"</script>';
                }
            }elseif($_GET['action'] == "accept"){
                $sql = "SELECT `id`, `name`, `address`, `contact`, `date`, `products_uid` FROM `pending order` WHERE id = '".$_GET['id']."'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $arr = mysqli_fetch_array($result);
                $sql = "SELECT `id`, `order_uid`, `product_id`, `quantity` FROM `ordered_products` WHERE order_uid = '".$arr['products_uid']."'";
                $items = mysqli_query($conn, $sql);
                $itemsCount = mysqli_num_rows($items);
                if($itemsCount > 0){
                    while($item = mysqli_fetch_array($items)){
                        $sql = "INSERT INTO `sales`(`name`, `address`, `number`, `date`, `product id`, `quantity`) 
                                VALUES ('".$arr['name']."','".$arr['address']."','".$arr['contact']."','".$arr['date']."','".$item['product_id']."','".$item['quantity']."')";
                        mysqli_query($conn, $sql);
                        
                    }
                }
                $sql = "DELETE FROM `pending order` WHERE id = '".$_GET['id']."'";
                if(mysqli_query($conn, $sql)){
                    echo '<script> alert("Order Has Been Accepted") </script>';
                    echo '<script>window.location="pendingOrders.php"</script>';
                } else{
                    echo '<script> alert("Can not Accept! There has been a problem") </script>';
                    echo '<script>window.location="pendingOrders.php"</script>';
                }
                
            }
        }
    }
}
?>