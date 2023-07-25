@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control"> الاعدادت الاساسية       </h4>
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
                        <div id="password-form">
                            <label for="password">Enter Password: </label>
                            <input type="password" id="password">
                            <button id="submit-password">Submit</button>
                        </div>
                        <div class="card-content collapse show " id="dashboard-content" style="" >
                           
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </section>

    </div>
@endsection
@section('script')
    <script>
        $('#have_website').change(function(){
           let v =  $(this).val();
           if(v == 1){
            $('.site_url').css('display','block');
            $('#site_url').prop('required',true);
           }else{
            $('.site_url').css('display','none');
            $('#site_url').prop('required',false);
           }
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#submit-password').on('click', function() {
                var enteredPassword = $('#password').val();
            $.ajax({
                url: "{{ route('check_password') }}",
                type: "GET",
                data: {
                    enteredPassword: enteredPassword
                },
                success: function(response) {
                   if(response.status == 'error'){
                    swal({
                    title: response.message,
                    icon: "error",
                 
                });
                   }else{
                    $('#password-form').hide();
                    $('#dashboard-content').append(response);
                   }
                },

            });
            });
        });
    </script>
@endsection
