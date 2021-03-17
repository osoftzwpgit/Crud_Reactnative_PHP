<?php
 
if(isset($_POST["ID"]) && !empty($_POST["ID"])){// Process delete operation after confirmation

    require_once "config.php";    // Include config file

    $sql = "DELETE FROM reguser WHERE ID = ?";    // Prepare a delete statement

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $param_id);        // Bind variables to the prepared statement as parameters
        $param_id = trim($_POST["ID"]);        // Set parameters
        
        if($stmt->execute()){        // Attempt to execute the prepared statement
            header("location: index.php");            // Records deleted successfully. Redirect to landing page
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    $stmt->close();    // Close statement
    $mysqli->close();    // Close connection
} else{
    if(empty(trim($_GET["ID"]))){    // Check existence of id parameter
        header("location: error.php");        // URL doesn't contain id parameter. Redirect to error page
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="ID" value="<?php echo trim($_GET["ID"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>