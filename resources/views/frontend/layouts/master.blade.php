<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('backend/vendors/mdi/css/materialdesignicons.min.css') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('easyzoom/css/easyzoom.css')}}" />

    <!-- datepicker-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

</head>

<body>
    <div class="main-panel">
        @include('frontend.layouts.navbar')
        <div class="container ">
            @yield('content')
        </div>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{asset('easyzoom/js/easyzoom.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);

        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });
    </script>
    <script>
    $(document).hover('click', '.dropdown-menu', function(e) {
        e.stopPropagation();
    });
    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
        $('.dropdown-menu a').click(function(e) {
            e.preventDefault();
            if ($(this).next('.submenu').length) {
                $(this).next('.submenu').toggle();
            }
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.submenu').hide();
            })
        });
    }
    </script>
    <script>
    $('#UploadModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        document.getElementById("form_id").action = 'orders' + '/' + recipient;
        modal.find('.modal-title').text('Notification : Slip payment file Order number : ' + recipient);
       
    })
    $('#ShowModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var img = button.data('img')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Notification : Slip payment file Order number : ' + recipient)
        modal.find('.modal-body img').attr('src', '{{url('')}}/slip/' + img)
    })
    $('#returnModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var img_r = button.data('img_r')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Notification : Slip payment file Order number : ' + recipient)
        modal.find('.modal-body img').attr('src', '{{url(' / ')}}/slipShipping/' + img_r)
    })
    </script>
    <script>
    $(function() { //<-- wrapped here
        $('#name').on('input', function() {
            this.value = this.value.replace(/[^a-zA-Zก-๙]/g,
                ''); //<-- replace all other than given set of values
        });
        $('#surname').on('input', function() {
            this.value = this.value.replace(/[^a-zA-Zก-๙]/g,
                ''); //<-- replace all other than given set of values
        });
        $('#account_name').on('input', function() {
            this.value = this.value.replace(/[^a-zA-Zก-๙]/g,
                ''); //<-- replace all other than given set of values
        });
        $('#account_no').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g,
                ''); //<-- replace all other than given set of values
        });
        $('#mobile').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g,
                ''); //<-- replace all other than given set of values
        });

    });
    </script>
    <script>
    var msg = '{{Session::get('
    message ')}}';
    var exist = '{{Session::has('
    message ')}}';
    if (exist) {
        alert(msg);
    }
    </script>
    <script>
    if (window.location.pathname == '/orders') {
        // $('.sub-menu-item.profile').addClass('active');
        $('.menu-account-item.orderlist-menu').addClass('active');
    } else if (window.location.pathname == '/myaccount') {
        $('.sub-menu-item.profile').addClass('active');

    }
    </script>
</body>

</html>