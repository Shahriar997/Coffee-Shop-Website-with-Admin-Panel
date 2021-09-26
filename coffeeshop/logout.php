<?php
    session_start();
    if(isset($_GET["action"])){
        if($_GET["action"] == "logout"){
            unset($_SESSION["admin"]);
            session_destroy();
            echo '<script> alert("Logged Out") </script>';
            echo '<script>window.location="admin.php"</script>';
        }
    }
?>