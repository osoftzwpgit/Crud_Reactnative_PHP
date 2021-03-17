<?php
//https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php

// Include config file
require_once "config.php";

$Ucode = $Ufirstname = $Ulastname = "";                 // Define variables and initialize with empty values
$Ucode_err = $Ufirstname_err = $Ulastname_err = "";

if(isset($_POST["ID"]) && !empty($_POST["ID"])){        // Processing form data when form is submitted
    $id = $_POST["ID"];           // Get hidden input value

    // // Validate name
    // $input_name = trim($_POST["name"]);
    // if(empty($input_name)){
    //     $name_err = "Please enter a name.";
    // } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $name_err = "Please enter a valid name.";
    // } else{
    //     $name = $input_name;
    // }

    // Validate Ucode
    $input_Ucode = trim($_POST["Ucode"]);
    if(empty($input_Ucode)){
        $Ucode_err = "Please enter an Ucode.";     
    } else{
        $Ucode = $input_Ucode;
    } 

    // Validate Ufirstname 
    $input_Ufirstname = trim($_POST["Ufirstname"]);
    if(empty($input_Ufirstname)){
        $Ufirstname_err = "Please enter an Ufirstname.";     
    } else{
        $Ufirstname = $input_Ufirstname;
    }

    // Validate Ulastname 
    $input_Ulastname = trim($_POST["Ulastname"]);
    if(empty($input_Ulastname)){
        $Ulastname_err = "Please enter an Ulastname.";     
    } else{
        $Ulastname = $input_Ulastname;
    }    

    // // Validate salary
    // $input_salary = trim($_POST["salary"]);
    // if(empty($input_salary)){
    //     $salary_err = "Please enter the salary amount.";     
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    // } else{
    //     $salary = $input_salary;
    // }
    
    // Check input errors before inserting in database

    if(empty($Ucode_err) && empty($Ufirstname_err) && empty($Ulastname_err)){
        $sql = "UPDATE reguser SET Ucode=?, Ufirstname=?, Ulastname=? WHERE ID=?";        // Prepare an update statement
 
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sssi", $param_Ucode, $param_Ufirstname, $param_Ulastname, $param_id);            // Bind variables to the prepared statement as parameters
            
            // Set parameters
            $param_Ucode = $Ucode;
            $param_Ufirstname = $Ufirstname;
            $param_Ulastname = $Ulastname;
            $param_id = $id;
            
            if($stmt->execute()){            // Attempt to execute the prepared statement
                header("location: index.php");                // Records updated successfully. Redirect to landing page
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();        // Close statement
    }
    
    $mysqli->close();    // Close connection
} else{
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){    // Check existence of id parameter before processing further

        $id =  trim($_GET["ID"]);        // Get URL parameter
        $sql = "SELECT * FROM reguser WHERE ID = ?";        // Prepare a select statement

        if($stmt = $mysqli->prepare($sql)){

            $stmt->bind_param("i", $param_id);            // Bind variables to the prepared statement as parameters
            
            $param_id = $id;            // Set parameters
            
            if($stmt->execute()){            // Attempt to execute the prepared statement
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){

                    $row = $result->fetch_array(MYSQLI_ASSOC);                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    
                    $Ucode = $row["Ucode"];                    // Retrieve individual field value
                    $Ufirstname = $row["Ufirstname"];
                    $Ulastname = $row["Ulastname"];
                } else{
                    header("location: error.php");                    // URL doesn't contain valid id. Redirect to error page
                    exit();
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        $stmt->close();        // Close statement
        $mysqli->close();        // Close connection
    }  else{
        header("location: error.php");        // URL doesn't contain id parameter. Redirect to error page
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($Ucode_err)) ? 'has-error' : ''; ?>">
                            <label>Ucode</label>
                            <input type="text" name="Ucode" class="form-control" value="<?php echo $Ucode; ?>">
                            <span class="help-block"><?php echo $Ucode_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Ufirstname_err)) ? 'has-error' : ''; ?>">
                            <label>Ufirstname</label>
                            <!-- <textarea name="Ufirstname" class="form-control">< ?php echo $Ufirstname; ?></textarea> -->
                            <input type="text" name="Ufirstname" class="form-control" value="<?php echo $Ufirstname; ?>">
                            <span class="help-block"><?php echo $Ufirstname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Ulastname_err)) ? 'has-error' : ''; ?>">
                            <label>Ulastname</label>
                            <input type="text" name="Ulastname" class="form-control" value="<?php echo $Ulastname; ?>">
                            <span class="help-block"><?php echo $Ulastname_err;?></span>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>