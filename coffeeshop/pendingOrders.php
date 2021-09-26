<?php 
    session_start();
    include 'connection.php';
    if(isset($_SESSION["admin"])){
        if($_SESSION["admin"]){
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

                    <link rel="stylesheet" type="text/css" href="\coffeeshop\css\pendingOrder.css">
                    <link href='https://css.gg/check-o.css' rel='stylesheet'>
                    <link href='https://css.gg/close-o.css' rel='stylesheet'>
                </head>
                <title> Menu </title>
                <body>
                    <section>
                        <header>
                        <a href="index.html" ><img src="\coffeeshop\image\logo.png" class="logo" ></a>
                            <ul>
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><a href="pendingOrders.php">Orders</a></li>
                                <li><a href="postadd.php">Advertisements</a></li>
                                <li><a href="addMenu.php">Add to menu</a></li>
                                <li><a href="logout.php?action=logout">Log out</a></li>
                            </ul>
                        </header>
                        <div class="container">
                            <h2>Pending Orders</h2>
                        
                            <div class = "table">
                                <table>
                                    <tr>
                                        <th >Name</th>
                                        <th >Address</th>
                                        <th>Contact</th>
                                        <th >Date</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $sql = "SELECT `id`, `name`, `address`, `contact`, `date`, `products_uid` FROM `pending order`";
                                    $result = mysqli_query($conn, $sql);
                                    $totalOrder =  mysqli_num_rows($result);
                                    $total_Amount = 0;
                                    if($totalOrder > 0){
                                        while($order = mysqli_fetch_array($result)){  #per order loop
                                            $sql2 = "SELECT `id`, `order_uid`, `product_id`, `quantity` FROM `ordered_products` WHERE order_uid = '".$order['products_uid']."'";
                                            $product_result = mysqli_query($conn, $sql2);
                                            $item_count = mysqli_num_rows($product_result);
                                            $firstIten = true;
                                            
                                            ?>
                                            <tr>
                                                <td rowspan="<?php echo $item_count ?>"> <?php echo $order['name'] ?> </td>
                                                <td rowspan="<?php echo $item_count ?>"> <?php echo $order['address'] ?> </td>
                                                <td rowspan="<?php echo $item_count ?>"> <?php echo $order['contact'] ?> </td>
                                                <td rowspan="<?php echo $item_count ?>"> <?php echo $order['date'] ?> </td>
                                                <?php 
                                                if($item_count > 0){
                                                    while($items = mysqli_fetch_array($product_result)){ #per item in a order loop
                                                        $sql3 = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` WHERE id = '".$items['product_id']."'";
                                                        $get_item = mysqli_query($conn, $sql3);
                                                        $arr = mysqli_fetch_array($get_item);

                                                        if($firstIten){
                                                            $firstIten = false;
                                                        ?>
                                                        <td> <?php echo $arr['Name']; ?> </td>
                                                        <td> <?php echo $items['quantity']; ?> </td>
                                                        <td> <?php 
                                                        $total_Amount = $total_Amount+($items["quantity"] * $arr["price"]);
                                                        echo number_format($items["quantity"] * $arr["price"],2);
                                                        ?> </td>
                                                        <td rowspan = "<?php echo $item_count ?>" align="center">     <!-- action -->
                                                        <a href="orderManagement.php?action=accept&id=<?php echo $order['id']; ?>"><i class="gg-check-o"></i></a><br>
                                                        <a href="orderManagement.php?action=reject&id=<?php echo $order['id']; ?>"><i class="gg-close-o"></i></a>
                                                        </td> 
                                                        </tr>
                                                        <?php
                                                        } else{
                                                            ?>
                                                            <tr>
                                                                <td> <?php echo $arr['Name']; ?> </td>
                                                                <td> <?php echo $items['quantity']; ?> </td>
                                                                <td> <?php 
                                                        $total_Amount = $total_Amount+($items["quantity"] * $arr["price"]);
                                                        echo number_format($items["quantity"] * $arr["price"],2);
                                                        ?>      
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                        }
                                                    
                                                    }
                                                }
                                                
                                            
                                            
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan = "6" align="right">Total Amount:</td>
                                        <td align = "right"><?php echo $total_Amount; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </section>
                </body>
            </html>



        <?php 
        }else{
                echo '<script> alert("not logged in") </script>';
                echo '<script>window.location="admin.php"</script>';
            }
    }else{
            echo '<script> alert("not logged in") </script>';
            echo '<script>window.location="admin.php"</script>';
    } 
?>