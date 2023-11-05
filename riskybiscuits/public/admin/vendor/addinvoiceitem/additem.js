$(document).ready(function() {

        

    

    $(document).on('change', '.quantity-input', function() {
        var quantity = $(this).val();
        var packagePrice = $(this).closest('.row').find('.package-select option:selected').data('price');
        
        // Log values for debugging
        console.log('Quantity:', quantity);
        console.log('Package Price:', packagePrice);
        
        var total = quantity * packagePrice;
        $(this).closest('.row').find('.package-total').text(total);
    });

    $('.package-select').each(function() {
        var packagePrice = $(this).find('option:selected').data('price');
        $(this).closest('.row').find('.package-price').data('price', packagePrice);
    });

    $(document).on('change', '.package-select', function() {
        var packagePrice = $(this).find('option:selected').data('price');
        $(this).closest('.row').find('.package-price').text(packagePrice);
    });

    /*
    $('#add-package').click(function() {
        // Clone and append new package fields
        var clonedPackage = $('#package-container').find('.row').first().clone();
        clonedPackage.find('.quantity-input').val(1);
        clonedPackage.find('.package-total').text('0');
        $('#package-container').append(clonedPackage);
    });
    */
});
