document.addEventListener('DOMContentLoaded', function() {
    const incrementButtons = document.querySelectorAll('.qnt_menor_maior[value="+"]');
    const decrementButtons = document.querySelectorAll('.qnt_menor_maior[value="-"]');
    
    //Botão de aumentar valor
    incrementButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productID = button.parentElement.getAttribute('data-product');
            const quantityInput = button.parentElement.querySelector('.quanti');
            const currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;

            simulateFormSubmission();
        });
    });

    //Botão de diminuir valor
    decrementButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productID = button.parentElement.getAttribute('data-product');
            const quantityInput = button.parentElement.querySelector('.quanti');
            const currentValue = parseInt(quantityInput.value);
            
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                simulateFormSubmission();
            }
        });
    });
    function simulateFormSubmission() {
        const form = document.querySelector('form');
        form.submit();
    }
});