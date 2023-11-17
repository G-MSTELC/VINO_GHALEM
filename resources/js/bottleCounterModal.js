document.querySelectorAll('.card-bouteille-qt').forEach(function(counter) {
    let input = counter.querySelector('input');
    let decrementButton = counter.querySelector('.btn-decrement');
    let incrementButton = counter.querySelector('.btn-increment');

    decrementButton.addEventListener('click', function(event) {
        event.preventDefault();
        let currentValue = parseInt(input.value, 10);
        if (currentValue > 0) {
            input.value = currentValue - 1;
        }
    });
    
    incrementButton.addEventListener('click', function(event) {
        event.preventDefault();
        let currentValue = parseInt(input.value, 10);
        input.value = currentValue + 1;
    });
});



