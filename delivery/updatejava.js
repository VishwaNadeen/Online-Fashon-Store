
//Validate PostalCode
function checkPostalCode(input) {
    const errorMessageElement = document.getElementById('errorMessage1');

    // Set field to only input numbers
    if (/\D/.test(input.value)) {
        errorMessageElement.textContent = "Enter numerics only.";
    } else {
        errorMessageElement.textContent = "";
    }

    // Remove non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    // Limit postalcode to 5 characters
    if (input.value.length > 5) {
        input.value = input.value.slice(0, 5);
    }
}

//Validate Phone Number
function checkPhoneNo(input) {
    const errorMessageElement = document.getElementById('errorMessage2');

    // Set field to only input numbers
    if (/\D/.test(input.value)) {
        errorMessageElement.textContent = "Enter a valid phone number.";
    } else {
        errorMessageElement.textContent = "";
    }

    // Remove non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    // Limit input to 10 characters
    if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);
    }
}


//Capitalize all characters in Name input
function capitalization(input) {
    if (input.value) {
        input.value = input.value.toUpperCase();
    }
}


