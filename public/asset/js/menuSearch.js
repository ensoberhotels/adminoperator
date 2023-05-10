jQuery(document).ready(function(){
    // this js is used for fetch all menus from the table and put in <ul> tag
    jQuery('#searchMenu_inp').on('click', function() {
        var baseurl = jQuery('#urlGrivance').val();
        var val     = jQuery(this).val();
        jQuery('#menu_search_close').show();
        console.log(val);
        jQuery.ajax({
            type: "get",
            url: baseurl+'/menusearch',
            data: {'val':val},
            beforeSend:function(){
                jQuery('#menu_search_loader').show();
            }, 
            success: function(response) {
                jQuery('#menu_search_loader').hide();
                jQuery('#searchMenu_div').show();
                console.log(response);
                jQuery('#searchMenu_ul').html(response);
            }
        });
    });

    // this js is used for filter menus from the all menus which is in ul
    jQuery('#searchMenu_inp').on('change, keyup', function() {
        jQuery('#menu_search_loader').show();
        let input = document.getElementById('searchMenu_inp').value
        input=input.toLowerCase();
        let x = document.getElementsByClassName('search_content');
        for (i = 0; i < x.length; i++) { 
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].closest(".search_li").style.display="none";
            }
            else {
                x[i].closest(".search_li").style.display="contents";                 
            }
        }
        setTimeout(function() {
            jQuery('#menu_search_loader').hide();
        }, 150);
    });

    // This function is use for hide all menus and blank and search input
    jQuery('#menu_search_close').on('click', function() {
        jQuery(this).hide();
        jQuery('#menu_search_loader').hide();
        jQuery('#searchMenu_div').hide();
        jQuery('#searchMenu_inp').val('');
    });
});