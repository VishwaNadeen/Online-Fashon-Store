<?php
    include('config.php');

    if(isset($_POST['insert_product']))
    {
        $p_title=$_POST['product_title'];
        $p_category=$_POST['product_category'];
        $p_keyword=$_POST['keyword'];
        $p_price=$_POST['product_price'];

        $p_image=$_FILES['product_image']['name'];
        $temp_image=$_FILES['product_image']['tmp_name'];

        move_uploaded_file($temp_image,"./product_image/$p_image");

        $insert_products="INSERT INTO `product`(product_title,category_id,product_keyword,product_image,product_price) VALUES ('$p_title','$p_category','$p_keyword','$p_image','$p_price')";
    
        $result_query=mysqli_query($conn,$insert_products);
        if($result_query)
        {
            echo "<script>alert('Sucessfully inserted')</script>";
        }

    }
   


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product-Admin</title>
    <link rel="stylesheet" href="insert_product.css">
</head>
<body>

    <div class="container">
    <h1>Insert Products</h1>
        

        <!--form-->
        <form action="" method="post" enctype="multipart/form-data" >
            <!--title-->
            <div class="input-container">
                <label for="product_title">Product title</label>
                <input type="text" id="product_title" name="product_title" placeholder="Enter product title" class="form_text" required>
            </div>

            <!--category-->
            <div class="input-container">
                <select name="product_category" id="" class="form_text">
                <option value=''>Select category</option>
                    <?php
                    $select_query="select * from `catagories`";
                    $result_query=mysqli_query($conn,$select_query);

                    while($row=mysqli_fetch_assoc($result_query))
                    {
                        $category_title=$row['category_name'];
                        $category_id=$row['category_id'];
                        echo"<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                    
                </select>
            </div>

            <!--keyword-->
            <div class="input-container">
                <label for="keyword">Product keyword</label>
                <input type="text" id="keyword" name="keyword" placeholder="Enter product keyword" class="form_text" required>
            </div>
             <!--image-->
             <div class="input-container">
                <label for="image">Product image</label>
                <input type="file" id="image" name="product_image" class="form_text" required>
            </div>
            <!--price-->
            <div class="input-container">
                <label for="price">Description</label>
                <input type="text" id="price" name="product_price" placeholder="Enter product price" class="form_text" required>
            </div>
            <!--submit-->
            <div class="input-container">
              
                <input type="submit" name="insert_product" class="form_text" value="Insert Product">
            </div>



        </form>
    </div>
    
</body>
</html>