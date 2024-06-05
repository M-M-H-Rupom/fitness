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
    
    $(document).on('click','.add_more_package .more_package',function(){
        let all_terms = terms_data[0];
        let term_options = ''
        all_terms.forEach(function(item,index){
            term_options += `<option value="${item.slug}"> ${item.name} </option>`
        })
        let pack_row_count = $('#pack_count').val()
        let img_src = $('.package_close_img img').attr('src');
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
                    <img src="${img_src}" alt="">
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
   if($('#bkng_days').length > 0){
        let select_box = $('#bkng_days').select2({
            placeholder: "Select days",
            allowClear: true
        })
   }
   if( $('#selected_days').length > 0) {
        let selected_days = $('#selected_days').val()
        $('#bkng_days').val(selected_days.split(',')).trigger('change')
    }
    $('#bkng_days').on('change.select2',function(e){
        let data = $(this).select2('data')
        data = data.map(( option ) => {
            return option.id
        })
        $('#selected_days').val(data.join(','))
    });
    $('.add_customer_pack').on('click',function(){
        console.log('cus');
    })

})(jQuery)