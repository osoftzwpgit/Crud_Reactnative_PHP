<?php
require_once "config.php";              // Include config file

$Ucode = $Ufirstname = $Ulastname = "";                 // Define variables and initialize with empty values
$Ucode_err = $Ufirstname_err = $Ulastname_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){               // Processing form data when form is submitted

    $input_Ucode = trim($_POST["Ucode"]);    // Validate Ucode
    if(empty($input_Ucode)){
        $Ucode_err = "Please enter an Ucode.";     
    } else{
        $Ucode = $input_Ucode;
    }    

    $input_Ufirstname = trim($_POST["Ufirstname"]);    // Validate Ufirstname
    if(empty($input_Ufirstname)){
        $Ufirstname_err = "Please enter an Ufirstname.";     
    } else{
        $Ufirstname = $input_Ufirstname;
    }
    
    $input_Ulastname = trim($_POST["Ulastname"]);    // Validate Ulastname
    if(empty($input_Ulastname)){
        $Ulastname_err = "Please enter an Ulastname.";     
    } else{
        $Ulastname = $input_Ulastname;
    } 

    if(empty($Ucode_err) && empty($Ufirstname_err) && empty($Ulastname_err)){    // Check input errors before inserting in database
        $sql = "INSERT INTO reguser (Ucode, Ufirstname, Ulastname) VALUES (?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("sss", $param_Ucode, $param_Ufirstname, $param_Ulastname);            // Bind variables to the prepared statement as parameters
            
            $param_Ucode = $Ucode;            // Set parameters
            $param_Ufirstname = $Ufirstname;
            $param_Ulastname = $Ulastname;
            
            if($stmt->execute()){                                     // Attempt to execute the prepared statement
                header("location: insertwebuser.php");                // Records created successfully. Redirect to landing page
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        $stmt->close();        // Close statement
    }
    $mysqli->close();    // Close connection
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add the record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

