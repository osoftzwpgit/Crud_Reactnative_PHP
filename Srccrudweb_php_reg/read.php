<?php

if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){// Check existence of id parameter before processing further
    // Include config file
    require_once "config.php";
    
    $sql = "SELECT * FROM reguser WHERE ID = ?";    // Prepare a select statement
    
    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("i", $param_id);        // Bind variables to the prepared statement as parameters
        
        $param_id = trim($_GET["ID"]);          // Set parameters
        
        if($stmt->execute()){                   // Attempt to execute the prepared statement
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){

                $row = $result->fetch_array(MYSQLI_ASSOC);                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                
                $Ucode = $row["Ucode"];                // Retrieve individual field value
                $Ufirstname = $row["Ufirstname"];
                $Ulastname = $row["Ulastname"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Ucode</label>
                        <p class="form-control-static"><?php echo $row["Ucode"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ufirstname</label>
                        <p class="form-control-static"><?php echo $row["Ufirstname"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ulastname</label>
                        <p class="form-control-static"><?php echo $row["Ulastname"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>