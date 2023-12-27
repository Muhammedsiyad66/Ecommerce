<?php
include('adminpan.php');
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $productId = $conn->real_escape_string($_GET["id"]);

    // Retrieve product details from the database
    $sqlSelect = "SELECT * FROM add_product WHERE id = '$productId'";
    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        // Redirect to the product list page if the product is not found
        header("Location: table.php");
        exit();
    }
}


// ... (previous code remains unchanged)

// Check if the form for updating product is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateProduct"])) {
    $productId = $conn->real_escape_string($_POST["productId"]);
    $productName = $conn->real_escape_string($_POST["productName"]);
    $productDescription = $conn->real_escape_string($_POST["productDescription"]);
    $offerPrice = $conn->real_escape_string($_POST["offerPrice"]);
    $actualPrice = $conn->real_escape_string($_POST["actualPrice"]);
    $offerPercentage = $conn->real_escape_string($_POST["offerPercentage"]);
    $category = $conn->real_escape_string($_POST["category"]);
    // Handle image upload
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Check if a new file is uploaded
    if (!empty($fileName)) {
        // If a new file is uploaded, move it to the server and update the file URL
        $fileUrl = "http://localhost/Ecommerce/asset/"  . $fileName;
        move_uploaded_file($fileTmpName, $fileUrl);
    } else {
        // If no new file is uploaded, keep the existing file URL
        $fileUrl = $product['file'];
    }


    // Update product in the database
    $sqlUpdate = "UPDATE add_product SET
                    productName = '$productName',
                    productDescription = '$productDescription',
                    offerPrice = '$offerPrice',
                    actualPrice = '$actualPrice',
                    offerPercentage = '$offerPercentage',
                    category = '$category',
                    file = '$fileUrl'
                  WHERE id = '$productId'";
    $conn->query($sqlUpdate);

    // Redirect to the product list page after updating
   exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Product</title>
</head>

<body>

    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" name="productName" id="productName" value="<?php echo $product['productName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description:</label>
                <textarea class="form-control" name="productDescription" id="productDescription" rows="3"><?php echo $product['productDescription']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="offerPrice">Offer Price:</label>
                <input type="text" class="form-control" name="offerPrice" id="offerPrice" value="<?php echo $product['offerPrice']; ?>" required>
            </div>
            <div class="form-group">
                <label for="actualPrice">Actual Price:</label>
                <input type="text" class="form-control" name="actualPrice" id="actualPrice" value="<?php echo $product['actualPrice']; ?>" required>
            </div>
            <div class="form-group">
                <label for="offerPercentage">Offer Percentage:</label>
                <input type="text" class="form-control" name="offerPercentage" id="offerPercentage" value="<?php echo $product['offerPercentage']; ?>" required>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" name="category" id="category" value="<?php echo $product['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="file">Change Image:</label>
                <input type="file" class="form-control-file" name="file" id="fileInput">
                <input type="hidden" name="existingFile" value="<?php echo $product['file']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="updateProduct">Update Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var fileInput = document.getElementById("fileInput");
            var existingFile = document.querySelector("[name='existingFile']").value;

            if (existingFile) {
                // Create a new Blob object with an empty array as content
                var blob = new Blob([], {
                    type: 'application/octet-stream'
                });

                // Create a new FileReader
                var reader = new FileReader();

                // Set the onload event to create a new File object when the FileReader finishes reading the Blob
                reader.onload = function(e) {
                    var existingFileObj = new File([blob], existingFile.split('/').pop());
                    // Create a new DataTransfer object and add the File object to it
                    var dataTransfer = new DataTransfer();
                    dataTransfer.items.add(existingFileObj);

                    // Set the files property of the file input to the DataTransfer object
                    fileInput.files = dataTransfer.files;
                };

                // Read the Blob
                reader.readAsDataURL(blob);
            }
        });
    </script>




</body>

</html>