<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery details</title>
    <link rel="stylesheet" href="delivery.css">
</head>
<body>


        <form id="orderForm" method ="post" action="insert_delivery.php">

        <h2>Shipping Details</h2>

            <input type="text" name="name" placeholder="Contact name" required oninput="capitalization(this)"><br>
            
            <input type="text" name="address" placeholder="Address (Street, apt, suit, unit)" required> <br>
            <input type="text" name="city" placeholder="City" required> <br>

            <select name="province" id="province">
                    <option value="Western Province">Western Province</option>
                    <option value="Central Province">Central Province</option>
                    <option value="North Central Province">North Central Province</option>
                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                    <option value="Eastern Province">Eastern Province</option>
                    <option value="Uva Province">Uva Province</option> 
                    <option value="Southern Province">Southern Province</option> 
                    <option value="Northern Province">Northern Province</option>  
                    <option value="North Western">North Western</option> 
                </select> <br>

                <input type="text" id="postalCode" name="postalCode" placeholder="Postal Code" required oninput=checkPostalCode(this)>
                <span id="errorMessage1" style="color: red; font-size: 11px; margin-top: 1px "></span> <br>

                <input type="text" name="phone" placeholder="Phone Number" required oninput="checkPhoneNo(this)">
                <span id="errorMessage2" style="color: red; font-size: 11px; margin-top: 1px "></span> <br>
        
                <button type="submit">SAVE</button>
    </form>

<script src="indexjava.js"></script>
</body>
</html>