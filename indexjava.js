//Set all words of Name capital
function capitalization(input) {
    if (input.value) {
        input.value = input.value.toUpperCase();
    }
}


function checkLength(input) { 
    const errorMessageElement = document.getElementById('errorMessage');
    const maxLength = 10; // Set the maximum allowed length

    // Set field to only input numbers
    if (/\D/.test(input.value)) {
        errorMessageElement.textContent = "Enter valid phone number.";
    } else if (input.value.length > maxLength) {
        errorMessageElement.textContent = `Phone number cannot exceed ${maxLength} digits.`;
    } else {
        errorMessageElement.textContent = "";
    }

    // Remove any non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    // Ensure the value doesn't exceed max length
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}
