<?php
    include 'connection.php';
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

	    <link rel="stylesheet" type="text/css" href="\coffeeshop\css\whatsnew.css">
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
            <div class="container">
                <h2>Whats New On Our Shop??</h2>
                <?php
                $sql = "SELECT `id`, `img`, `name`, `headline`, `description`, `Date` FROM `advertisements` ORDER BY id DESC";
                $query_fire = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query_fire);
                if($num>0){
                    while($news = mysqli_fetch_array($query_fire)){
                ?>
                        <div class="news">
                            <div class="img"><img src="\coffeeshop\advertisementImages\<?php echo $news['img']; ?>" alt="<?php echo $news['name']; ?>"></div>
                            <div class="text">
                                <h2><?php echo $news['headline']; ?></h2>  <br>  
                                <h3><?php echo $news['name']; ?></h3> <br>
                                <p><?php echo $news['description']; ?></p><br>
                                <strong>Date: </strong><?php echo $news['Date']; ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </body>
</html>