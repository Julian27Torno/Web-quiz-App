document.addEventListener('DOMContentLoaded', function() {
    const completeNameInput = document.getElementById('complete_name');
    const emailInput = document.getElementById('email');
    const nextButton = document.getElementById('nextButton');

    function validateForm() {
        const name = completeNameInput.value.trim();
        const email = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        
        const isNameValid = name !== '';
        const isEmailValid = emailPattern.test(email);

     
        if (isNameValid && isEmailValid) {
            nextButton.disabled = false;
        } else {
            nextButton.disabled = true;
        }
    }

   
    completeNameInput.addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);
});
