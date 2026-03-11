<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Card Details</title>
    <link rel="stylesheet" href="payment.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
    <div class="payment-container">
        <h2>Add Card Details</h2>
        <form id="paymentForm" method ="post" action="insert_payment.php" >
        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="cardNumber" placeholder="XXXX - XXXX - XXXX - XXXX" maxlength="19" required oninput="formatCardNumber(this)">
        </div>

            <div class="form-group">
                <label for="expiryDate">Expiry Date</label>
                <input type="month" id="expiryDate" name="expiryDate" required >
            </div>

            <div class="form-group">
                <label for="cvv">CVV Number</label>
                <input type="password" id="cvv" name="cvv" placeholder="CVV" required maxlength="3" oninput="validateCVV(this)">
            </div>

            <div class="form-group">
                <label for="cardName">Card Name</label>
                <input type="text" id="cardName" name="cardName" placeholder="Card Name" required oninput = "capitalization(this)">
            </div>

            <div class="form-group">
                <label for="cardHolderName">Card Holder Name</label>
                <input type="text" id="cardHolderName" name="cardHolderName" placeholder="Card Holder Name" required oninput = "capitalization(this)">
            </div>

            <button name ="submit" type="submit" class="pay-now">SAVE DETAILS</button>
        </form>
    </div>

    <footer>
        <a href="AboutUs.html">About Us</a> |
        <a href="ContactUs.html">Contact Us</a> |
        <a href="Terms&Conditions.html">Terms & Conditions</a> |
        <a href="#">FAQs</a>
    </footer>

    <script src="indexjava.js"></script>
</body>
</html>




