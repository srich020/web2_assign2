$(function () {

    // initialize semanticUI components

    $('.ui.menu .ui.dropdown').dropdown({
        on: 'hover'
    });

    
    /*
    $("#cart").on("click", function () {
        $("#cartModal.ui.fullscreen.modal").modal("show");
    });
    
    
    
     $('.ui.menu a.item')
     .on('click', function() {
     $(this).addClass('active')
     .siblings()
     .removeClass('active');
     
     
     });*/

    $('.menu .item').tab();

    $('.event.example .image').dimmer({
        on: 'hover'
    });


    $('#artwork').on('click', function () {
        $('.ui.basic.modal').modal('show');
    });

    //Add to Cart Button


    //Add to Favorites Button

    $('.ui.button').on('click', function () {


    });




});