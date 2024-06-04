// alert('hello')
;(function($){
    $('.update_balanced').on('click',function(){
        let balaced_input = $('.user_balance').val();
        $.ajax({
            url: localize_data.url,
            method: "POST",
            data: {
                action : 'balance_ajax',
                balanced_val : balaced_input,
            },
            success: function (balance) {
                $('.user_balance_data span').html(balance)
            }
        });
        // console.log(balaced_input);
    })
   
    $(document).on('click','.add_more_package',function(){
        console.log('add more pack');
    })
})(jQuery)