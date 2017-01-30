    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("product-id");
            var amount = $(this).attr("amount");

            if(amount != 0) {
                $.post("/cart/addAjax/" + id + "-" + amount, {}, function (data) {
                    $("#cart-count").html(data);
                });
            }
            return false;
        });
    });

    $(document).ready(function(){
        $('#quantity').bind("change keyup input click", function(){
            var quantity = $('#quantity').val();

            $('#amount').attr("amount", quantity);

            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
    });

    $(document).ready(function(){
        $('.cart-input').bind("change keyup input click", function(){
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
    });


    setTimeout("$('.info-box').fadeOut(3000);", 6500);

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
    });
	
    $("span.menu").click(function () {
        $(".top-nav ul").slideToggle(500, function () {
        });
    });
	
    $(function () {
        $('.scroll-pane').jScrollPane();
    });

    $(document).ready(function() {
        $('#input-number1, #input-number2').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    $('#post').click(function () {
        var scroll = $(window).scrollTop();
        Cookies.set('position', scroll);
    });

    $(document).ready(function () {
        if(Cookies.get('position')) {
            var to = Cookies.get('position');
            $(window).scrollTop(to);
            Cookies.remove('position')
        }
    });
