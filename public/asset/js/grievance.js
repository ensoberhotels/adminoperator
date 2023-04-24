jQuery(document).ready(function(){
    jQuery("#modelGrievance").on('click', function () {
        jQuery('#modal-Grievance').show();
        jQuery('#successGrievance').hide();
        jQuery("#staticBackdrop").bPopup({
            modalClose: false,
            // speed: 650,
            // transition: 'slideIn',
	        // transitionClose: 'slideBack'
        });
    });

    jQuery('#grievance_form').on('submit', function(e){
        e.preventDefault();
        var title       = jQuery('.titleGrievance').val();
        var description = jQuery('.descriptionGrievance').val();
        var attachment = jQuery('.attachmentGrievance').val();

        // // validation for blank title
        if (title=='') {
            jQuery('.titleGrievance').css({'border' : '1px solid red'});
            return false;
        } else {
            jQuery('.titleGrievance').css({'border' : '1px solid black'});
        }

        // validation for blank description
        if (description=='') {
            jQuery('.descriptionGrievance').css({'border' : '1px solid red'});
            return false;
        } else {
            jQuery('.descriptionGrievance').css({'border' : '1px solid black'});
        }

        // validation for blank attachment
        if (attachment=='') {
            jQuery('.attachmentGrievance').css({'border' : '1px solid red'});
            return false;
        } else {
            jQuery('.attachmentGrievance').css({'border' : '1px solid black'});
        }

        var baseurl = jQuery('#urlGrivance').val();
        var form=new FormData(document.getElementById('grievance_form'));
        console.log(form);
        jQuery.ajax({
            type: "POST",
            url: baseurl+'/grievance/store',
            data: form,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend:function(){
            jQuery('#po_search_loader1').show();
            },
            success: function(response) {
                jQuery('#po_search_loader1').hide();
                console.log(response);
                if (response.status == 1) {
                    jQuery('#grievance_form').trigger('reset');
                    jQuery('#errorGrievance').css({'color' : 'green'}).html('New Grievance Raised Successfully ');
                    setTimeout(function() {
                        jQuery('#errorGrievance').html('&nbsp;');
                        jQuery('#modal-Grievance').hide();
                        jQuery('#successGrievance').show();
                    }, 3000);
                    jQuery("#staticBackdrop").bPopup({
                        autoClose: 1000 //Auto closes after 1000ms/1sec
                    });
                }else{
                    jQuery('#errorGrievance').css({'color' : 'red'}).html('Error While Submitting');
                    setTimeout(function() {
                        jQuery('#errorGrievance').html('&nbsp;');
                    }, 2500);
                }
            }
       });
    });
});