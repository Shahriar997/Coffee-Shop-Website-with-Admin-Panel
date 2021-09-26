<?php 
    if(isset($_POST["login"])){
        $id = $_POST["uid"];
        $pass = $_POST["pass"];
        if($id == "admin" && $pass == "admin"){
            session_start();
            $_SESSION["admin"] = true;
            echo '<script>window.location="dashboard.php"</script>';
        } else{
            echo '<script>alert("Wrong id or password")</script>';
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
	    <title>Coffee shop Admin</title>
        <link rel="icon" href="\coffeeshop\image\logo.png">
        <link rel="stylesheet" type="text/css" href="\coffeeshop\css\admin.css">
    </head>
    <body>
        <section>
            <header>
                <a href="admin.php" ><img src="\coffeeshop\image\logo.png" class="logo" ></a>
            </header>
            <div class="container">
                <h2>Welcome Admin</h2>
                <div class="login">
                    <form method="POST" action="admin.php?action=login">
                        <label for="uid">User ID</label>
                        <input type="text" id="uid" name="uid" placeholder="admin">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="pass" placeholder="admin">
                        <input type="submit" name=login value="Login" >
                    </form>
                </div>
            </div>
        
    </body>
</html>