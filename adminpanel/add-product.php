<?php

include('validation.php');
include('adminpan.php');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
  <style>
  #nav-log{
  justify-content: flex-end !important;
}
  </style>

  <div class="container mt-5">
    <div id="messages">

    </div>
    <div class="row justify-content-center">
      <div id="reg" class="col-md-6">
        <form method="post" action="add-product.php" enctype="multipart/form-data">
          <div class="mb-3 ">
            <input type="text" class="form-control" id="productName" name="productName" placeholder="product name">
            <span class="text-danger"><?php echo $productNameError; ?></span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="productDescription" name="productDescription" placeholder="product description">
            <span class="text-danger"><?php echo $productDescriptionError; ?></span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="offerPrice" name="offerPrice" placeholder="offer Price">
            <span class="text-danger"><?php echo $offerPriceError; ?></span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="actualPrice" name="actualPrice" placeholder="actual Price">
            <span class="text-danger"><?php echo $actualPriceError; ?></span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="offerPercentage" name="offerPercentage" placeholder="offer Percentage">
            <span class="text-danger"><?php echo $offerPercentageError; ?></span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="category" name="category" placeholder="category">
            <span class="text-danger"><?php echo $typeError; ?></span>
          </div>

          <div class="mb-3">
            <input type="file" class="form-control" id="file" name="file">
            <span class="text-danger"><?php echo $fileError; ?></span>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>

        </form>

      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>