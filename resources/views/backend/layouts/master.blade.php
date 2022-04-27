<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- End layout styles -->



</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            @include('backend.layouts.navber')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>


    <!-- plugins:js -->
    <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
    <script src="{{ asset('backend/js/file-upload.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $('#dynamic-row').DataTable({
            ordering: false,
            info: false,
        });
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function(value) {
                if (value) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                    window.location.href = url;
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        });
    </script>
    <script>
        $('#dynamic-row').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var img = button.data('img')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Notification : Slip payment file Order number : ' + recipient)
            modal.find('.modal-body img').attr('src', '{{ url('/') }}/slip/' + img)
        })
        $('#returnModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var img_r = button.data('img_r')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Notification : Slip Shipping file Order number : ' + recipient)
            modal.find('.modal-body img').attr('src', '{{ url('/') }}/slipShipping/' + img_r)
        })
    </script>
    <script>
        $(function() { //<-- wrapped here
            $('#other_fine').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g,
                    ''); //<-- replace all other than given set of values
            });

        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var start = $('#start').val();
            var end = $('#end').val();
            // const element = document.getElementById('report-list');
            // console.log(element);
            // element.parentNode.removeChild(element);
            $('#reports').empty();
            $('#reports').append(`
                    <thead>
                        <tr>
                            <th>เลขที่</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ค่าเช่า</th>
                            <th>ค่ามัดจำ</th>
                            <th>ค่าปรับ</th>
                            <th width="15%">ยอดชำระ</th>
                        </tr>
                    </thead>
                    <tbody id="report-tr">

                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <th colspan="2" style="text-align:right">Total:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                `)
            $.ajax({
                url: "{{ route('reports.report_rant') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'start': start,
                    'end': end
                },
                success: function(data) {
                    $('#report').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr id="report-list">' +
                            '<td>' + v.id + '</td>' +
                            '<td>' + v.billing_name + '</td>' +
                            '<td>' + v.billing_subtotal + '</td>' +
                            '<td>' + v.billing_deposit + '</td>' +
                            '<td>' + v.other_fine + '</td>' +
                            '<td>' + v.billing_total + '</td>' +
                            '</tr>';
                    });
                    html = $('#report-tr').html(html);
                    $('#reports').DataTable({
                        "info": false,
                        "searching": false,
                        "ordering": false,
                        "bDestroy": true,
                        "bLengthChange": false,
                        "footerCallback": function(row, data, start, end, display) {
                            var api = this.api();

                            // Remove the formatting to get integer data for summation
                            var intVal = function(i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                    i : 0;
                            };
                            // console.log(api.column(2).data());
                            // // Total over all pages
                            // total = api
                            //     .column(2)
                            //     .data()
                            //     .reduce(function(a, b) {
                            //         return intVal(a) + intVal(b);
                            //     }, 0);

                            // // Total over this page
                            // pageTotal = api
                            //     .column(2, {
                            //         page: 'current'
                            //     })
                            //     .data()
                            //     .reduce(function(a, b) {
                            //         return intVal(a) + intVal(b);
                            //     }, 0);

                            // Total filtered rows on the selected column (code part added)
                            for (var i = 2; i <= 5; i++) {
                                var sum = display.map(el => data[el][i]).reduce((a,
                                        b) => intVal(a) +
                                    intVal(b), 0);
                                console.log(sum);

                                // Update footer
                                $(api.column(i).footer()).html(
                                    '฿' + sum
                                );
                            }
                        }
                    });
                },

            });

        });
    </script>
</body>

</html>
