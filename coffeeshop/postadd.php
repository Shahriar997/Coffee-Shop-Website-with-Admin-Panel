<?php 
    session_start();
    include 'connection.php';
    if(isset($_SESSION["admin"])){
        if($_SESSION["admin"]){
            if(isset($_POST["post"])){
                if(isset($_GET["action"])){
                    $files = $_FILES['img'];

                    $fileName = $_FILES['img']['name'];
                    $fileTmpName = $_FILES['img']['tmp_name'];
                    $fileSize = $_FILES['img']['size'];
                    $fileError = $_FILES['img']['error'];
                    $fileType = $_FILES['img']['type'];

                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));

                    $allowed = array('jpg', 'jpeg', 'png');
                    if(in_array($fileActualExt,$allowed)){
                        if($fileError === 0){
                            if($fileSize < 500000){
                                $fileNameNew = uniqid('',true).".".$fileActualExt;
                                $fileDestination = 'advertisementImages/'.$fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);
                                
                                #inserting data to database
                                $name = $_POST['name'];
                                $headline = $_POST['headline'];
                                $description = $_POST['description'];
                                $date = date("Y-m-d");
                                $sql = "INSERT INTO `advertisements`(`img`, `name`, `headline`, `description`, `Date`) VALUES ('".$fileNameNew."','".$name."','".$headline."','".$description."', '".$date."')";
                                if(mysqli_query($conn,$sql)){
                                    echo '<script> alert("Advertisement Posted"); </script>';
                                } else{
                                    echo '<script> alert("Data Insertion Error"); </script>';
                                    echo '<script>window.location="dashboard.php"</script>';
                                }
                            } else{
                                echo '<script> alert("Image size too large. Please upload image below 5mb"); </script>';
                            }
                            
                        } else{
                            echo '<script> alert("Error in uploading your file"); </script>';
                        }
                    } else{
                        echo '<script> alert("Invalid type Image. The image should be in jpg, jpeg or png format"); </script>';
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

                    <link rel="stylesheet" type="text/css" href="\coffeeshop\css\postadd.css">
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
                            <h2>Post Advertisement</h2>
                            <div class = add-form>
                                <form method="POST" action="postadd.php?action=post" enctype="multipart/form-data">
                                    <label for="img">Select image:</label>
                                    <input type="file" id="img" name="img" accept="image/*">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" placeholder="Item Name" required>
                                    <label for="headline">Head Line</label>
                                    <input type="text" id="headline" name="headline" placeholder="Head Line" required>
                                    <label for="description">Description</label>
                                    <textarea required="required" name="description" placeholder = "Description"></textarea>
                                    <input type="submit" name="post" value="POST">
                                </form>
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