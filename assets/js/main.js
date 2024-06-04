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
   $('.add_more_package .more_package').on('click',function(){
        // $('.gmf_package').eq(0).clone().appendTo('.gmf_package_container');
        let all_terms = terms_data[0];
        let term_options = ''
        all_terms.forEach(function(item,index){
            term_options += `<option value="${item.slug}"> ${item.name} </option>`
        })
        let pack_row_count = $('#pack_count').val()
        console.log(pack_row_count);
        let new_package = `
            <div class="gmf_package">
                <div class="package_select">
                    <select name="package_options[${pack_row_count}][package]" id="">
                        ${term_options}
                    </select>
                </div>
                <div class="package_discount_field">
                    <input type="number" name="package_options[${pack_row_count}][price]" id="" class="balance_discount">
                </div>
                <div class="package_close_img">
                    <img src="https://placehold.co/30x30" alt="">
                </div>
            </div>
        `
        $('.gmf_package_container').append(new_package);
        pack_row_count++
        $('#pack_count').val(pack_row_count)
   });
   $(document).on('click','.package_close_img',function(){
        if($('.gmf_package').length == 1){
            return;
        }
        $(this).closest('.gmf_package').remove();
   })
   

})(jQuery)