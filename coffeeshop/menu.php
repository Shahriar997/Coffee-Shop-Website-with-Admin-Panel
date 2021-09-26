<?php 

    session_start();
    include 'connection.php';
    
    if(isset($_POST["add_to_cart"])){
        if(isset($_SESSION["shopping_cart"])){
            $item_array_id = array_column($_SESSION["shopping_cart"],'id');
            if(!in_array($_GET["id"], $item_array_id)){
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'id' => $_GET["id"],
                    'name' => $_POST["name"],
                    'quantity' => $_POST["quantity"],
                    'price' => $_POST["price"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
            }else{
                echo '<script>alert("Item Already Added")</script>';
                echo '<script>window.location="menu.php"</script>';
            }

        }else{
            $item_array = array(
                'id' => $_GET["id"],
                'name' => $_POST["name"],
                'quantity' => $_POST["quantity"],
                'price' => $_POST["price"]
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["shopping_cart"] as $key => $values){
                if($values["id"] == $_GET["id"]){
                    unset($_SESSION["shopping_cart"][$key]);
                    echo '<script>window.location="menu.php";</script>';
                }
            }
        }
    }
    if(isset($_GET["action"])){
        if($_GET["action"] == "clear"){
            unset($_SESSION["shopping_cart"]);
            echo '<script>window.location="menu.php";</script>';
        }
    }
    if(isset($_POST["checkout"])){
        if(isset($_GET["action"])){
            if($_GET["action"] == "checkout"){
                if(isset($_SESSION["shopping_cart"])){
                    echo '<script>window.location="checkout.php"</script>';
                }else{
                    echo '<script>alert("Please select a Coffee!!");</script>';
                    echo '<script>window.location="menu.php";</script>';
                }
            }
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

	    <link rel="stylesheet" type="text/css" href="\coffeeshop\css\menu-style.css">
    </head>
    <title> Menu </title>
    <body>
        <section>
            <header>
            <a href="index.html" ><img src="\coffeeshop\image\logo.png" class="logo" ></a>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="whatsnew.php">What's New</a></li>
                    <li><a href="contactUs.html">Contact</a></li>
                </ul>
            </header>
            <div class = "Content">
                <h2>Menu</h2>
                <div class = "foods">
                    <?php
                    include 'connection.php';
                        $query = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` ORDER BY id ASC";
                        $query_fire = mysqli_query($conn, $query);
                        $num = mysqli_num_rows($query_fire);
                        
                        if($num > 0){
                            while($product = mysqli_fetch_array($query_fire)){
                                ?>
                                <form method = "POST" action="menu.php?action=add&id=<?php echo $product['id']; ?>">
                                    <div class = "row">
                                        <div class="img"><img src="\coffeeshop\products\<?php echo $product['image']?>" alt="<?php echo $product['Name'];?>"></img></div>
                                        <div class = "text">
                                            <b>Name:</b> <?php echo $product['Name'];?> <br>
                                            <b>Description:</b> <?php echo $product['Description'];?><br>
                                            <b>Price:</b> <?php echo $product['price'];?> BDT<br>
                                            <b>Quantity: </b><input type="text" name="quantity" value = 1>
                                            <input type="hidden" name = "price" value=<?php echo $product['price'];?>>
                                            <input type="hidden" name = "name" value=<?php echo $product['Name'];?>>
                                            <div class="btn"><input type="submit" name = "add_to_cart" value = "Add to cart"></div>
                                        </div>
                                        
                                    </div>
                                </form>

                                <?php
                            }
                        }
                    ?>
                </div>
                <div class="cart-container">
                    <h2>Order Summary</h2>
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
                                <th>
                                    Action
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
                                            <td><a href="menu.php?action=delete&id=<?php echo $values['id']; ?>">Remove</a></td>
                                        </tr>
                                <?php 
                                            $total = $total+($values["quantity"] * $values["price"]);
                                        
                                    }
                                ?>
                                <tr>
                                    <td colspan="4" align="right">Total</td>
                                    <td align="right">BDT <?php echo number_format($total,2); ?></td>
                                </tr>
                            <?php
                                    
                                }
                            ?>
                            <tr>
                                <td colspan="5" align="center"><a href="menu.php?action=clear">Clear Cart</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <form method="POST" action="menu.php?action=checkout"><div class="checkout"><input type="submit" name="checkout" value="Checkout"></div></form>
            
        </section>
        
    </body>
</html>
