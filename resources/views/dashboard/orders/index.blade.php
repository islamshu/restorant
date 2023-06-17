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
                                {{-- <input type="checkbox" data-id="{{ get_general_value('is_open') }}"class="js-switch"
                                {{ get_general_value('is_open') == 1 ? 'checked' : '' }}> --}}
                                <div class="modal fade" id="examplelock" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">اغلاق الحجوزات </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('add_general') }}">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">الرسالة عند
                                                            الاغلاق
                                                        </label>
                                                        <textarea name="general[close_message]" class="form-control ckeditor" id="" cols="30" rows="3">{{ get_general_value('close_message') }}</textarea>

                                                    </div>
                                                    <button type="submit" class="btn btn-info">ارسال</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <input type="checkbox" data-id="{{ get_general_value('is_open') }}"class="js-switch"
                                    {{ get_general_value('is_open') == 1 ? 'checked' : '' }}>

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
                                    <div style="text-align: center">
                                        <img width="100" height="100" src={{ asset('backend/watitng-list.png') }}>
                                    </div>
                                    {{-- <a class="btn btn-success" href="{{ route('booking.create') }}">اضف حجز جديد</a> --}}
                                    <br>
                                    <a href="{{ route('get_orders') }}?status=2" class="btn btn-info">جديد </a>

                                    <a href="{{ route('get_orders') }}?status=" class="btn btn-primary">الكل</a>

                                    <a href="{{ route('get_orders') }}?status=1" class="btn btn-success">المنتهية</a>
                                    <a href="{{ route('get_orders') }}?status=3" class="btn btn-danger">المرفوضة</a>
                                    <form action="" style="display: inline-flex">
                                    <div class="form-group">
                                    <input type="hidden" value="{{ $request->status }}" name="status" id="">
                                    <input type="date" name="from" class="class-control" value="{{ $request->from }}" >
                                    <input type="date" name="to" class="class-control" value="{{ $request->to }}" >
                                    <input type="submit" class="btn btn-success" value="فلتر">
                                    </div>
                                </form>
                                    <!-- Button trigger modal -->
                                    <button type="button" style="float: left" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>

                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تصدير اكسيل</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="get" action="{{ route('export') }}">
                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">الحالة:</label>
                                                            <select name="status" class="form-control" id="">
                                                                <option value="" selected></option>
                                                                <option value="1">قبول</option>
                                                                <option value="2">انتظار</option>
                                                                <option value="3">مرفوضة</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">المكان
                                                            </label>
                                                            <select name="table_type" class="form-control"
                                                                id="">
                                                                <option value="" selected></option>
                                                                <option value="Public">عام</option>
                                                                <option value="External">خارجي</option>
                                                                <option value="Internal">داخلي</option>

                                                            </select>

                                                        </div>
                                                        <button type="submit" class="btn btn-info">ارسال</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

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
            <div class="notifications_sounds">
            </div>
            <audio id="audioPlayer" src="https://dashboard.yalago.net/noti/notiSound.mp3"></audio>


        </div>

    </div>
@endsection
@section('script')
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        $(document).ready(function() {

            


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
                    // var current = new Date();
                    var d = new Date();
                    var local = d.getTime();
                    var offset = d.getTimezoneOffset() * (60 * 1000);
                    var utc = new Date(local + offset);
                    var current = new Date(utc.getTime() + (0 * 60 * 60 * 1000));
                    // alert(current);

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

                    } else if (response.status == 3) {
                        $('#' + selected_id).removeClass("btn-info").addClass("btn-danger")

                    }
                    fetchdata();
                },

            });

        }

        function fetchdata() {
            // setInterval(function() {
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
            // }, 10000);
        }
    </script>
    <script>
        $(".js-switch").change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            $.ajax({
                type: "post",
                dataType: "json",
                url: '{{ route('add_general') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'general[is_open]': status,
                },
                success: function(data) {
                    console.log(data.message);
                }
            });
            if (status == 0) {
                $('#examplelock').modal('show');

            }
        });
    </script>
    <script>
        // Initialize Pusher
        Pusher.logToConsole = true;

        var pusher = new Pusher('ecfcb8c328a3a23a2978', {
            cluster: 'ap2'
        });
    </script>
    <script>
        // Subscribe to the channel
        const channel = pusher.subscribe('notifications');

        channel.bind('new-notification', function() {
            var audioPlayer = document.getElementById('audioPlayer');

            // Check if the browser can play audio without user interaction
            var playPromise = audioPlayer.play();

            // setInterval(function() {??/
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
            // }, 10000);

            if (playPromise !== undefined) {
                playPromise.then(function() {
                    // Autoplay started successfully
                }).catch(function(error) {
                    // Autoplay was prevented, handle error or show a UI element to allow user interaction
                    console.log('Autoplay prevented:', error);
                });
            }
        });
    </script>
@endsection
