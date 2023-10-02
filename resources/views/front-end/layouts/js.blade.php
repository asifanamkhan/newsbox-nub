<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/front-end/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('public/front-end/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Template Javascript -->

<script src="{{asset('front-end/js/main.js')}}"></script>
<script>
    $('.dropdown-submenu > a').on("click", function(e) {
        var submenu = $(this);
        var parentLI = submenu.parent().attr('id');
        var currentlyShowing = $('.subUL.show').parent().attr('id');
        if(parentLI == currentlyShowing){
            $('.dropdown-submenu .dropdown-menu').removeClass('show');
        } else {
            $('.dropdown-submenu .dropdown-menu').removeClass('show');
            submenu.next('.dropdown-menu').addClass('show');
        }
        e.stopPropagation();
    });

    $('.dropdown').on("hidden.bs.dropdown", function() {
        // hide any open menus when parent closes
        $('.dropdown-menu.show').removeClass('show');
    });
</script>

<script src="{{asset('public/front-end/js/main.js')}}"></script>