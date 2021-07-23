new WOW().init();
$(document).ready(function() {

$('.dtable').DataTable({"bLengthChange": false});
$('.mdb-select').material_select();
$('.collapse').collapse();
// SideNav init
$(".button-collapse").sideNav();
$('#btn-clps').sideNav();
$('.dropdown-trigger').dropdown();
// Custom scrollbar init
var el = document.querySelector('.custom-scrollbar');
Ps.initialize(el);

// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode: {
        401: function(){
            toastr.error('You must login to perform this action.');
        }
    }
});


$("#login_form").on('submit', function(event) {
    event.preventDefault();
    $('button').addClass('disabled');
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
    })
    .done(function(data) {
        $('button').removeClass('disabled');
        if(data == ''){
            window.location.reload();
        }
        else{
            $("#login_response").html(data);
        }

    });    
    return false;
});


$("#register_form").on('submit', function(event) {
    event.preventDefault();
    $('button').addClass('disabled');
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
    })
    .done(function(data) {
        $('button').removeClass('disabled');
        $('#register_response').html(data);
    });
    return false;
});

$("#forgot_form").on('submit', function(event) {
    event.preventDefault();
    $('button').addClass('disabled');
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
    })
    .done(function(data) {
        $('button').removeClass('disabled');
        $('#forgot_response').html(data);
    });
    return false;
});

            //autocomplete
            jQuery("#auto_complete_search").autocomplete({
                source: "/ajax/search",
                minLength: 1,
                select: function(event, ui){

                    // set the value of the currently focused text box to the correct value

                    if (event.type == "autocompleteselect"){
                    
                        var username = ui.item.value;

                        if(ui.item.value == 'View All') {

                            window.location.href = "/search?keyword=all";

                        } else {
                            jQuery('#auto_complete_search').val(ui.item.value);
                            jQuery('#search_form').submit();
                        }

                    }                        
                }     

            }); 
	
});