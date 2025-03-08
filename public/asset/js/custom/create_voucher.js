// Save quotatio details
function createVoucher(){
    if(!validateLeadDetails()){
        return false;
    }
    //var editor = CKEDITOR.instances['editor'].getData();
    //alert(editor);
    //return false;
    //var datas = jQuery("#quotation").serialize();
    jQuery(".generate_send_quo").text('Processing...');
    jQuery(".generate_send_quo").css({"color":"#fff"}); 
    jQuery(".generate_send_quo").prop('disabled', true);
    jQuery.ajax({
        type: 'post',
        url: '/operator/generatevoucher',
        cache: false,
        async: true,
        data: jQuery("#quotation").serialize(),
        success: function(res){
            console.log(res);
            jQuery(".send_quotation_msg").hide();
            var obj = JSON.parse(res);
            if(obj.status == false){
                alert(obj.msg);
                jQuery(".generate_send_quo").text('Generate');
                jQuery(".generate_send_quo").prop('disabled', false);
                return false;
            }
            if ($.isFunction(window.redirectToUpdateMode)){
                redirectToUpdateMode(obj.send_quotation_no);
            }
            jQuery(".generate_send_quo").text('Generate');
            jQuery(".generate_send_quo").prop('disabled', false);
            jQuery(".btn_send_quo").show();
            jQuery(".btn_copy_quo").show();
            jQuery(".fgsilement").show();
            jQuery(".email_body").html(obj.send_message);  
            jQuery("#email_message").text(obj.email_body);  
            jQuery("#email_subject").val(obj.subject);  
            jQuery(".quotation_update_rate").html(obj.quotation_rate);
            jQuery(".btn_edit_rate_quo").show();
            jQuery("#send_quotation_no").val(obj.send_quotation_no);  
            jQuery(".final_cost_val").text('Final Cost: '+obj.final_cost_val); 
            jQuery(".update_mode_t_price").text(obj.final_cost_val); 
            jQuery("#total_price").val(obj.final_cost_val); 
            checkFinalCostAply();
            console.log(obj.open_img_popup);
            if(obj.open_img_popup == 1){
                jQuery(".upload_image_popup").bPopup();
            }
            
            ClassicEditor.create( document.querySelector( '.editor_hide' ), { 
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            }).then( editor => {
                window.editor = editor;
            }).catch( err => {
                console.error( err.stack );
            });
        }
    });			
}