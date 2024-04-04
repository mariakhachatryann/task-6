$(document).ready(function() {
    $('.counter-plus').click(function() {
        var counterValue = $('.counter-value');
        var currentValue = parseInt(counterValue.text());
        counterValue.text(currentValue + 1);
    });

    $('.counter-minus').click(function() {
        var counterValue = $('.counter-value');
        var currentValue = parseInt(counterValue.text());
        if (currentValue !== 0) {
            counterValue.text(currentValue - 1);
        }
    });

    $('.addToCart').click(function() {
        var productId = "<?= (int) $product['id']; ?>";
        var quantity = parseInt($('.counter-value').text());

        $.ajax({
            type: 'POST',
            url: '../../index.php?action=addToCart',
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function(response) {
                console.log('AJAX request successful');
                console.log('Response:', response);
            },
            error: function(xhr, status, error) {
                console.log('AJAX request failed');
                console.log('Error:', error);
            }
        });
    });
});