<?php 
    session_start();
    include 'connection.php';
    if(isset($_SESSION["admin"])){
        if($_SESSION["admin"]){

            #Getting info for Drawing Charts
            $q = "SELECT `id`, `name`, `address`, `number`, `date`, `product id`, `quantity` FROM `sales`";
            $query_fire = mysqli_query($conn, $q);
            $num = mysqli_num_rows($query_fire);
            $saleArray = array();
            $chart_data = '';
            if($num>0){
                while($rows = mysqli_fetch_array($query_fire)){
                    $sql = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` WHERE id = '".$rows['product id']."'";
                    $query_fire2 = mysqli_query($conn, $sql);
                    $productNum = mysqli_num_rows($query_fire2);
                    
                    if($productNum>0){
                        while($products = mysqli_fetch_array($query_fire2)){
                            $amount = ((int)$rows['quantity'])*((int)$products['price']);
                            if(array_key_exists($products['Name'],$saleArray)){
                                $saleArray[$products['Name']] = $saleArray[$products['Name']] + $rows['quantity'];
                            } else{
                                $saleArray[$products['Name']] = $rows['quantity'];
                            }
                            
                        }
                    }
                }
            }
           
            
            #Remove item from menu
            if(isset($_GET['action'])){
                if($_GET['action'] == "removeMenu"){
                    if(isset($_GET['id'])){
                        echo $_GET['id'];

                        $sql = "DELETE FROM `menu` WHERE id ='" .$_GET['id']."'";
                        $sql2 = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` WHERE id ='" .$_GET['id']."'";
                        $result = mysqli_query($conn, $sql2);
                        $products = mysqli_fetch_array($result);
                        if(mysqli_query($conn, $sql)){
                            echo '<script> alert("Item deleted"); </script>';
                            unlink("products/".$products['image']);
                        }
                        else{
                            
                            echo '<script> alert("Item not deleted due to some db error"); </script>';
                        }
                        
                        echo '<script>window.location="dashboard.php";</script>';
                    }
                }
            }

            #Remove Advertisement
            if(isset ($_GET['action'])){
                if($_GET['action'] == "removeAdv"){
                    if(isset($_GET['id'])){
                        $sql = "DELETE FROM `advertisements` WHERE id = '" .$_GET['id']."'";
                        $sql2 = "SELECT `id`, `img`, `name`, `headline`, `description`, `Date` FROM `advertisements` WHERE id = '".$_GET['id']."'";
                        $result = mysqli_query($conn, $sql2);
                        $products = mysqli_fetch_array($result);
                        
                        if(mysqli_query($conn, $sql)){
                            echo '<script> alert("Advertisement deleted"); </script>';
                            unlink("advertisementImages/".$products['img']);
                        }
                        else{
                            
                            echo '<script> alert("Advertisement deleted due to some db error"); </script>';
                        }
                        echo '<script>window.location="dashboard.php";</script>';
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

                    <link rel="stylesheet" type="text/css" href="\coffeeshop\css\dashboard.css">
                    
                    <!-- JS Google charts -->

                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        var count = <?php echo count($saleArray); ?>;
                        count = parseInt(count);
                        var arr = [['Coffee Name', 'Quantity']];
                        var x = [];
                        var y = [];

                        <?php 
                            foreach($saleArray as $key => $value){
                                ?>
                                x.push("<?php echo $key ?>");
                                y.push(<?php echo $value ?>);
                                <?php
                            }
                        ?>
                        console.log(x);
                        console.log(y);
                        for(let i = 0; i < x.length; i++){
                            var temp = [x[i],y[i]];
                            arr.push(temp);
                        }
                        console.log(arr);
                        
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable(arr);

                            var options = {
                            title: 'Coffee Popularity Chart',
                            pieHole: 0.4,
                            backgroundColor: '#AB6B51'
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                            chart.draw(data, options);
                        }
                    </script>



                    <title> Dashboard </title>
                </head>
                
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
                            <h2>Admin Dashboard</h2>
                            <div class="status">

                                    <!-- Total Order -->

                                    <?php
                                        $sql = "SELECT `id`, `name`, `address`, `number`, `date`, `product id`, `quantity` FROM `sales`";
                                        $query_fire = mysqli_query($conn, $sql);
                                        $num = mysqli_num_rows($query_fire);
                                        
                                        
                                    ?>
                                    <div class="totalOrder"><b>Total count:</b> <br><?php echo $num;?></div>

                                    <!-- Pending Order -->

                                    <?php
                                    $sql = "SELECT * FROM `pending order`";
                                    $result = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($result);
                                    ?>
                                    <div class="pendingOrder"><b>Pending Order: </b> <br> <?php echo $count;?> </div>

                                    <!-- Total Sale -->

                                    <?php
                                    
                                    $totalSale = 0;
                                    
                                        if($num>0){
                                            while($rows = mysqli_fetch_array($query_fire)){
                                                $sql = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` WHERE id = '".$rows['product id']."'";
                                                $query_fire2 = mysqli_query($conn, $sql);
                                                $productNum = mysqli_num_rows($query_fire2);
                                                $price = 0;
                                                
                                                if($productNum>0){
                                                    while($products = mysqli_fetch_array($query_fire2)){
                                                        $price = $price + ((int)$products['price']);
                                                    }
                                                }
                                                
                                                $totalSale = $totalSale + ($price * ((int)$rows['quantity']));
                                            }
                                        }
                                        
                                        $totalSale = number_format($totalSale,2);
                                        
                                    ?>
                                    <div class="totalSale"> <b>Total Sale:</b> BDT <?php echo $totalSale; ?></div>
                                    <?php
                                        $totalSale=0;
                                        $sql = "SELECT `id`, `name`, `address`, `number`, `date`, `product id`, `quantity` FROM `sales` WHERE date > now() - INTERVAL 30 day";
                                        $query_fire3 = mysqli_query($conn, $sql);
                                        $saleLastMonthNum = mysqli_num_rows($query_fire3);
                                        if($num>0){
                                            while($rows = mysqli_fetch_array($query_fire3)){
                                                $sql = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` WHERE id = '".$rows['product id']."'";
                                                $query_fire4 = mysqli_query($conn, $sql);
                                                $productNum = mysqli_num_rows($query_fire4);
                                                $price = 0;
                                                if($productNum>0){
                                                    while($products = mysqli_fetch_array($query_fire4)){
                                                        $price = $price + ((int)$products['price']);
                                                    }
                                                }
                                                
                                                $totalSale = $totalSale + ($price * ((int)$rows['quantity']));
                                            }
                                        }
                                        $totalSale = number_format($totalSale,2);
                                    ?>
                                    
                                    <div class="monthlySale"><b>Last 1 Month Sale:</b> BDT <?php echo $totalSale; ?></div>
                            </div>
                            <!-- Charts -->
                            <div class="menu">
                                <h2>Coffee Popularity</h2>
                                <div class="chartContainer">
                                <div id="donutchart" style="width: 800px; height: 500px; "></div>
                                </div>

                            </div>
                            <!-- Menu -->
                            <div class="menu">
                                <h2>Menu</h2>
                                <table>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                        $query = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` ORDER BY id ASC";
                                        $query_fire = mysqli_query($conn, $query);
                                        $num = mysqli_num_rows($query_fire);
                                        if($num > 0){
                                            while($product = mysqli_fetch_array($query_fire)){
                                    ?>
                                                <tr>
                                                    <td><img src="\coffeeshop\products\<?php echo $product['image'];?>" alt="<?php echo $product['Name'];?>"></td>
                                                    <td><?php echo $product['Name'];?></td>
                                                    <td><?php echo $product['Description'];?></td>
                                                    <td><?php echo $product['price'];?></td>
                                                    <td><a href="dashboard.php?action=removeMenu&id=<?php echo $product['id'];?>">Remove</a></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </table>

                            </div>
                                <!-- What's New -->
                            <div class="menu">
                                <h2>Whats New</h2>
                                <table>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Headline</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                        $query = "SELECT `id`, `img`, `name`, `headline`, `description`, `Date` FROM `advertisements` ORDER BY id DESC";
                                        $query_fire = mysqli_query($conn, $query);
                                        $num = mysqli_num_rows($query_fire);
                                        if($num > 0){
                                            while($product = mysqli_fetch_array($query_fire)){
                                    ?>
                                                <tr>
                                                    <td><img style="width: 150;" src="\coffeeshop\advertisementImages\<?php echo $product['img'];?>" alt="<?php echo $product['name'];?>"></td>
                                                    <td><?php echo $product['name'];?></td>
                                                    <td><?php echo $product['headline'];?></td>
                                                    <td><?php echo $product['description'];?></td>
                                                    <td><?php echo $product['Date'];?></td>
                                                    <td><a href="dashboard.php?action=removeAdv&id=<?php echo $product['id'];?>">Remove</a></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </table>

                            </div>
                            <!-- Order History-->
                            <div class="menu">
                                <h2>Order History</h2>
                                <table>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                    <?php
                                        
                                        $query = "SELECT `id`, `name`, `address`, `number`, `date`, `product id`, `quantity` FROM `sales` ORDER BY id DESC";
                                        $query_fire = mysqli_query($conn, $query);
                                        $num = mysqli_num_rows($query_fire);
                                        if($num > 0){
                                            while($sales = mysqli_fetch_array($query_fire)){
                                                $history = array();
                                                $history['name'] = $sales['name'];
                                                $history['address'] = $sales['address'];
                                                $history['number'] = $sales['number'];
                                                $history['date'] = $sales['date'];
                                                $history['quantity'] = $sales['quantity'];

                                                $query2 = "SELECT `id`, `Name`, `Description`, `image`, `price` FROM `menu` WHERE id = '".$sales['product id']."'";
                                                $query_fire2 = mysqli_query($conn, $query2);
                                                $num2 = mysqli_num_rows($query_fire2);
                                                if($num2 > 0){
                                                    while($product = mysqli_fetch_array($query_fire2)){
                                                        $history['productName'] = $product['Name'];
                                                        $history['price'] = $product['price'];
                                                        $history['total'] = ((int)$sales['quantity'])*((int)$product['price']);

                                                    }
                                                }

                                    ?>
                                                <tr>
                                                    <td><?php echo $history['name'];?></td>
                                                    <td><?php echo $history['address'];?></td>
                                                    <td><?php echo $history['number'];?></td>
                                                    <td><?php echo $history['date'];?></td>
                                                    <td><?php echo $history['productName'];?></td>
                                                    <td><?php echo $history['quantity'];?></td>
                                                    <td><?php echo $history['price'];?></td>
                                                    <td><?php echo number_format($history['total'],2);?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </table>

                            </div>
                        </div>
                    </section>
                </body>
            </html>
            
<?php
        }else{
            echo '<script> alert("not logged in"); </script>';
            echo '<script>window.location="admin.php"</script>';
        }
    }else{
        echo '<script> alert("not logged in"); </script>';
        echo '<script>window.location="admin.php"</script>';
    }
?>