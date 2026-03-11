//validate CVV number

function validateCVV(input) {
    // Allow only digits and limit the input to 3 characters
    input.value = input.value.replace(/[^0-9]/g, '').slice(0, 3);
}

//Format Card Number

function formatCardNumber(input) {
    // Remove all non-digit characters
    const value = input.value.replace(/\D/g, '');
    
    // Format the value into groups of 4 digits
    let formattedValue = '';
    for (let i = 0; i < value.length; i++) {
        // Add a space after every 4 digits
        if (i > 0 && i % 4 === 0) {
            formattedValue += ' ';
        }
        formattedValue += value[i];
    }
    
    // Update the input value with the formatted value
    input.value = formattedValue.trim();
}

//Capitalize all characters in Name input

function capitalization(input) {
    if (input.value) {
        input.value = input.value.toUpperCase();
    }
}
