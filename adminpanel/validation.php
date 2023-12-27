<?php
include('connection.php');
$productNameError = $productDescriptionError = $offerPriceError = $actualPriceError = $offerPercentageError = $typeError = $fileError = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate product name
    if (empty($_POST["productName"])) {
        $productNameError = "Product name is required.";
    } else {
        $productName = $_POST["productName"];
    }

    // Validate product description
    if (empty($_POST["productDescription"])) {
        $productDescriptionError = "Product description is required.";
    } else {
        $productDescription = $_POST["productDescription"];
    }

    // Validate offer price
    if (empty($_POST["offerPrice"])) {
        $offerPriceError = "Offer price is required.";
    } else {
        $offerPrice = $_POST["offerPrice"];
    }

    // Validate actual price
    if (empty($_POST["actualPrice"])) {
        $actualPriceError = "Actual price is required.";
    } else {
        $actualPrice = $_POST["actualPrice"];
    }

    // Validate offer percentage
    if (empty($_POST["offerPercentage"])) {
        $offerPercentageError = "Offer percentage is required.";
    } else {
        $offerPercentage = $_POST["offerPercentage"];
    }

    // Validate product type
    if (empty($_POST["category"])) {
        $typeError = "Product category is required.";
    } else {
        $category = $_POST["category"];
    }
    $targetDirectory = "C:/xampp/htdocs/Ecommerce/asset/";
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // // Check if the username exists before uploading the file
    // if (empty($usernameError)) {
        // Check file upload
        if (empty($_FILES["file"]["name"])) {
            $fileError= "File Upload is required.";
            $uploadOk = 0;
        }

        // Check file size
        // else if ($_FILES["file"]["size"] > 500000) {
        //     $fileError=  "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        else if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        else if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";

            // Continue with other validations and database insertion
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    // }
        

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $uploadDir = "C:/xampp/htdocs/Ecommerce/asset/";
        $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
            $fileUrl = "http://localhost/Ecommerce/asset/" . basename($_FILES["file"]["name"]);
        } else {
            echo "File upload failed!";
        }
    }
}


// Check if the form is submitted and there are no validation errors
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($productNameError) && empty($productDescriptionError) && empty($offerPriceError) && empty($actualPriceError) && empty($offerPercentageError) && empty($typeError) && empty($fileError)) {

    // Assuming you have sanitized variables from the form
    $productName =  $_POST['productName'];
    $productDescription =  $_POST['productDescription'];
    $offerPrice =  $_POST['offerPrice'];
    $actualPrice =  $_POST['actualPrice'];
    $offerPercentage =  $_POST['offerPercentage'];
    $category =  $_POST['category'];
    
    // Assuming you have validated and sanitized the file URL
    $fileUrl = "http://localhost/Ecommerce/asset/" . basename($_FILES["file"]["name"]);

    // SQL insertion query
    $sql = "INSERT INTO add_product (productName, productDescription, offerPrice, actualPrice, offerPercentage, category, file)
            VALUES ('$productName', '$productDescription', '$offerPrice', '$actualPrice', '$offerPercentage', '$category', '$fileUrl')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo '<div id="urs" class="container" style="color: green;text-align:center;">Product added successfully</div>';
    } else
    {
        echo "error";
    }
}

?>
    