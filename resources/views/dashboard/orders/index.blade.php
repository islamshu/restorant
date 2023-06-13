@extends('layouts.backend')
@section('css')
    <style>
        .tablestyle {
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">الحجوزات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-content collapse show">

                                <div class="card-body card-dashboard">

                                    @include('dashboard.parts._error')
                                    @include('dashboard.parts._success')
                                    {{-- <a class="btn btn-success" href="{{ route('booking.create') }}">اضف حجز جديد</a> --}}
                                    <br>
                                    <a href="{{ route('get_orders') }}?status=" class="btn btn-primary">الكل</a>

                                    <a href="{{ route('get_orders') }}?status=1" class="btn btn-success">المنتهية</a>
                                    <a href="{{ route('get_orders') }}?status=2" class="btn btn-info">في الانتظار</a>

                                    <table
                                        class="table table-striped table-bordered zero-configuration table_calss tablestyle">





                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> المدة </th>
                                                <th>بيانات المستخدم </th>
                                                <th>الملاحظات </th>
                                                <th width="100">الحالة</th>
                                                <th>نوع الطاولة</th>
                                                {{-- <th>Place Type</th> --}}
                                                <th>الاشخاص</th>
                                                <th>انشأت في </th>
                                                <th> الاجاراءات</th>


                                            </tr>
                                        </thead>
                                        <tbody id="my-table" class="tablestyle">

                                            @include('dashboard.orders._table')
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>
@endsection
@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            setInterval(function() {
                var urlParams = new URLSearchParams(window.location.search);
                var st = urlParams.get('status');
                $.ajax({
                    url: "{{ route('refresh') }}",
                    type: "GET",
                    data: {
                        status: st
                    },
                    success: function(response) {
                        // Update the table with the retrieved data
                        // For example, assuming you have a <table> element with the id "my-table"
                        $("#my-table").html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }, 10000);
            $('.timeHandlerClosed').each(function() {
                var startTime = $(this).data('time-start');
                var endTime = $(this).data('time-end');
                var startTime = new Date(startTime);
                var endTime = new Date(endTime);

                $(this).html(calculateTimeDifference(startTime, endTime));
            });


            var orderTimer = function() {
                $('.timeHandlerLoading').each(function() {
                    var startTime = $(this).data('time-start');
                    var diff = new Date(startTime);
                    var current = new Date();

                    $(this).html(calculateTimeDifference(diff, current));
                });

            };


            function calculateTimeDifference(start_time, end_time) {
                //Get 1 day in milliseconds
                var one_day = 1000 * 60 * 60 * 24;
                // Convert both dates to milliseconds
                var date1_ms = start_time.getTime();
                var date2_ms = end_time.getTime();
                // Calculate the difference in milliseconds
                var difference_ms = date2_ms - date1_ms;
                //take out milliseconds
                difference_ms = difference_ms / 1000;
                var seconds = Math.floor(difference_ms % 60);
                difference_ms = difference_ms / 60;
                var minutes = Math.floor(difference_ms % 60);
                difference_ms = difference_ms / 60;
                var hours = Math.floor(difference_ms % 24);
                var days = Math.floor(difference_ms / 24);
                if (("0" + hours).slice(-2) !== "aN") {
                    if (Number(("0" + hours).slice(-2)) >= 0) {
                        hours = ("0" + hours).slice(-2);
                    } else {
                        hours = "00";
                    }
                }
                if (("0" + minutes).slice(-2) !== "aN") {
                    if (Number(("0" + minutes).slice(-2)) >= 0) {
                        minutes = ("0" + minutes).slice(-2);
                    } else {
                        minutes = "00";
                    }
                }
                if (("0" + seconds).slice(-2) !== "aN") {
                    if (Number(("0" + seconds).slice(-2)) >= 0) {
                        seconds = ("0" + seconds).slice(-2);
                    } else {
                        seconds = "00";
                    }
                }
                return (hours + ":" + minutes + ":" + seconds)
            }
            setInterval(orderTimer, 1000);

        });

        function changestatus(id) {
            var selected_id = 'selected_' + id;
            var st = $('#' + selected_id).val();
            $.ajax({
                url: "{{ route('change_status') }}",
                type: "GET",
                data: {
                    status: st,
                    order_id: id
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('#' + selected_id).removeClass("btn-info").addClass("btn-success")
                    } else if (response.status == 2) {
                        $('#' + selected_id).removeClass("btn-success").addClass("btn-info")

                    }
                },

            });

        }
        // function get_data(st){
        //     $.ajax({
        //             url: "{{ route('refresh') }}",
        //             type: "GET",
        //             data: { status: st },
        //             success: function(response) {
        //                 // Update the table with the retrieved data
        //                 // For example, assuming you have a <table> element with the id "my-table"
        //                 $("#my-table").html(response);
        //             },
        //             error: function(xhr) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        // }
    </script>
@endsection