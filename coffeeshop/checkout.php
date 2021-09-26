<?php 
session_start();
include 'connection.php';
if(isset($_POST["order"])){
    if(isset($_GET["action"])){
        $name = $_POST["name"];
        $address = $_POST["address"];
        $number = $_POST["number"];
        $date = date("Y-m-d");
        $uniqid = uniqid('',true);
        $sql = "INSERT INTO `pending order`(`name`, `address`, `contact`, `date`, `products_uid`) VALUES ('".$name."','".$address."','".$number."','".$date."','".$uniqid."')";
        mysqli_query($conn,$sql);
        foreach($_SESSION["shopping_cart"] as $key => $values){
            $sql2 = "INSERT INTO `ordered_products`(`order_uid`, `product_id`, `quantity`) VALUES ('".$uniqid."','".$values["id"]."','".$values["quantity"]."')";
            mysqli_query($conn,$sql2);
        }
        echo '<script>alert("Order Successfull. Wait for our phone call")</script>';
        unset($_SESSION["shopping_cart"]);
        session_destroy();
        echo '<script>window.location="index.html"</script>';
    }
}

?>
<html>
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width,innitial-scale=1.0">
		<!-- telling the browser to set the widdth as per devices screen-->

	    <meta name="keywords" content="HTML,CSS,JavaScript,PHP">
	    <meta name="Author" content="Shahriar">
	    <title>Coffee shop</title>
        <link rel="icon" href="\coffeeshop\image\logo.png">

	    <link rel="stylesheet" type="text/css" href="\coffeeshop\css\checkout.css">
    </head>
    <body>
        <section>
            <div class="circle"></div>
            <header>
                <a href="index.html" ><img src="\coffeeshop\image\logo.png" class="logo" ></a>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="whatsnew.php">What's New</a></li>
                    <li><a href="contactUs.html">Contact</a></li>
                </ul>
            </header>
            <div class="content">
                <h2>Checkout</h2>
                <div class="checkout-form">
                    <form method="POST" action="checkout.php?action=order">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your name.." required>

                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Your Address.." required>

                        <label for="number">Contact Number</label>
                        <input type="text" id="number" name="number" placeholder="Your Contact Number.." pattern="^(?:\+88|01)?\d{11}\r?$" required>
                        </select>
                    
                        <input type="submit" name="order" value="Order">
                    </form>
                </div>
                <div class=cart>
                    <h2>Your Cart</h2>
                    <div class="cart-table">
                        <table>
                        <tr>
                                <th>
                                    Item name
                                </th>
                                
                                <th>
                                    Price
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Total
                                </th>
                            </tr>
                            <?php
                                if(!empty($_SESSION["shopping_cart"])){
                                    $total = 0;
                                    foreach($_SESSION["shopping_cart"] as $keys => $values){
                                        ?>
                                        <tr>
                                            <td><?php echo $values["name"]; ?></td>
                                            <td><?php echo $values["price"]; ?></td>
                                            <td><?php echo $values["quantity"]; ?></td>
                                            <td><?php echo number_format($values["quantity"] * $values["price"],2); ?></td>
                                            
                                        </tr>
                                <?php 
                                            $total = $total+($values["quantity"] * $values["price"]);
                                        
                                    }
                                ?>
                                <tr>
                                    <td colspan="3" align="right">Total</td>
                                    <td align="right">BDT <?php echo number_format($total,2); ?></td>
                                </tr>
                            <?php
                                    
                                }
                            ?>
                            
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </body>
</html>