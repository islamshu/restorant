@extends('layouts.backend')
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <style>
        .10pre {
            width: 10% !important
        }

        .my-tbody {
            display: block;
            overflow-x: scroll;
            width: 100%;
        }

        .stwitchh {
            width: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control"> انشاء حجز جديد </h4>
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
                            <div class="card-body">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')

                                <form class="form" method="post" action="{{ route('booking.update',$booking->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    

                                <div class="form-body  ">
                                    <h4 class="form-section"><i class="ft-user"></i> معلومات أساسية</h4>
                                    <div class="row">
                                        <div class="form-group col-md-4 ">
                                            <label class="label-control" for="projectinput1">نوع العرض</label>
                                            <select name="type_offer"  class="form-control" id="">
                                                <option value=""  disabled>اختر العرض</option>
                                                <option value="نجمة" @if($booking->type_offer == 'نجمة' ) selected @endif > نجمة </option>
                                                <option value="نجمتان" @if($booking->type_offer == 'نجمتان' ) selected @endif> نجمتان </option>
                                                <option value="3 نجوم" @if($booking->type_offer == '3 نجوم' ) selected @endif> 3 نجوم</option>
                                                <option value="4 نجوم" @if($booking->type_offer == '4 نجوم' ) selected @endif> 4 نجوم</option>
                                                <option value="5 نجوم" @if($booking->type_offer == '5 نجوم' ) selected @endif> 5 نجوم</option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">الوجهة </label>
                                            
                                                <select name="destination"  class="form-control" id="">
                                                    <option value="" disabled>اختر الوجهة</option>
                                                    <option value="أذربيجان" @if($booking->destination == 'أذربيجان' )selected @endif> أذربيجان </option>
                                                    <option value="جورجيا" @if($booking->destination == 'جورجيا' )selected @endif> جورجيا </option>
                                                    <option value="تركيا" @if($booking->destination == 'تركيا' )selected @endif>  تركيا</option>
                                                    <option value="البوسنة والهرسك" @if($booking->destination == 'البوسنة والهرسك' )selected @endif>البوسنة والهرسك</option>
    
                                                </select>
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">الاسم </label>
                                            <input type="text" class="form-control" value="{{ $booking->name }}" name="name" 
                                                id="">
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">الجوال </label>
                                            <input type="text" class="form-control" value="{{ $booking->phone }}" name="phone" 
                                                id="">
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">تاريخ الوصول </label>
                                            <input type="date" class="form-control" value="{{ $booking->date_of_arrival }}"  name="date_of_arrival"
                                                id="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">عدد الليالي </label>
                                            
                                                <select name="night_number" class="form-control" id="">
                                                    <option value="" >الليالي</option>
                                                    @php

                                                        for ($i = 1; $i <= 20; $i++) {
                                                            if ($i == $booking->night_number) {
                                                                echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                                            } else {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                        }
                                                    @endphp                                                    
                                                </select>
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">البالغين </label>
                                            
                                                <select name="adult" class="form-control" id="">
                                                    <option value="" >البالغين</option>
                                                    @php

                                                    for ($i = 0; $i <= 10; $i++) {
                                                        if ($i == $booking->adult) {
                                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                                        } else {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                    }
                                                @endphp                                                    
                                                </select>
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">الأطفال </label>
                                           
                                                <select name="child" class="form-control" id="">
                                                    <option value="" >الأطفال</option>
                                                    @php

                                                    for ($i = 0; $i <= 10; $i++) {
                                                        if ($i == $booking->child) {
                                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                                        } else {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                    }
                                                @endphp                                                      
                                                </select>
                                        </div>
                                        <div class="form-group col-md-3 ">
                                            <label class="label-control" for="projectinput1">تاريخ المغادرة </label>
                                            <input type="date" class="form-control" value="{{ $booking->date_of_departure }}" name="date_of_departure" 
                                                id="">
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="form-body  ">
                                    <h4 class="form-section"><i class="ft-user"></i> الفنادق</h4>
                                    <div class="row">
                                        <div class="form-group col-md-12 ">
                                            <table class="table my-tbody">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">المدينة</th>
                                                        <th scope="col">اسم الفندق</th>
                                                        <th scope="col">نوع الغرفة</th>
                                                        <th scope="col">عدد الليالي</th>
                                                        <th scope="col">الوجبات </th>
                                                        <th scope="col">__ </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="main_row">
                                                    @php
                                                        $count = $booking->hotels->count() ;
                                                    @endphp
                                                    @foreach ($booking->hotels as $key=> $item)
                                                        
                                                    <tr>
                                                        <th scope="row"><input type="text" name="hotel[{{$key}}][city]"
                                                                class="form-control" value="{{ $item->city }}" placeholder="المدينة"
                                                                id=""></th>
                                                        <th scope="row"><input type="text" class="form-control"
                                                                name="hotel[{{$key}}][name]" value="{{ $item->name }}" placeholder="اسم الفندق"
                                                                id=""></th>
                                                        <th scope="row"><input type="text" class="form-control"
                                                                name="hotel[{{$key}}][type]" value="{{ $item->type }}" placeholder="نوع الفندق"
                                                                id=""></th>
                                                        <th scope="row"><input type="number" class="form-control"
                                                                name="hotel[{{$key}}][night]" value="{{ $item->night }}" placeholder="عدد الليالي"
                                                                id=""></th>
                                                        <th scope="row"><input type="text" class="form-control"
                                                                name="hotel[{{$key}}][eat]" value="{{ $item->eat }}" placeholder="الوجبات"
                                                                id=""></th>
                                                        <th>
                                                            
                                                            <button class="btn btn-danger remove-roww" type="button">-</button></td>
                                                        </th>

                                                    </tr>
                                                    @endforeach


                                                </tbody>

                                            </table>
                                            <button class="btn btn-info" id="dublicate_row" type="button">+</button>


                                        </div>
                                    </div>



                                    <br>


                                </div>
                                <div class="form-body row">
                                    <div class=" col-md-6  ">
                                        <h4 class="form-section"><i class="ft-user"></i> البرنامج يشمل </h4>
                                        <div class="row">
                                                    @php

                                                    for ($i = 0; $i < 8; $i++) {
                                                        echo '<div class="form-group col-md-6">';
                                                        echo '<input type="text" class="form-control" value="' . @$booking->detiles[$i]->title . '" name="detiles[' . $i . '][title]" id="">';
                                                        echo '</div>';
                                                    }   
                                                    
                                                @endphp 
                                        </div>

                                        <br>
                                    </div>
                                    <div class=" col-md-6  ">
                                        <h4 class="form-section"><i class="ft-user"></i> الملاحظات </h4>
                                        <div class="row">
                                            @php

                                            for ($i = 0; $i < 8; $i++) {
                                                echo '<div class="form-group col-md-6">';
                                                echo '<input type="text" class="form-control" value="' . @$booking->notes[$i]->title . '" name="note[' . $i . '][title]" id="">';
                                                echo '</div>';
                                            }   
                                            
                                        @endphp 
                                        </div>

                                        <br>
                                    </div>
                                </div>
                                <div class="form-body  ">
                                    <h4 class="form-section"><i class="ft-user"></i> خط سير الرحلة                     
                                   <input type="checkbox" name="check_Bok" checked data-toggle="toggle" data-size="sm">
                                    </h4>

                                    <div class="row add_more">
                                        @php
                                            $count_arravice = $booking->arrives->count();
                                        @endphp
                                        @foreach ($booking->arrives as $key=>$item)
                                        <div class=" col-md-8 " >
                                            <label class="label-control" for="projectinput1">خط سير الرحلة </label>
                                            <input type="text" name="arraive[{{ $key }}][title]" value="{{ $item->title }}" class="form-control"
                                                id="">
                                           
                                        </div>
                                        @endforeach
                                        
                                      

                                    </div>
                                    <br>
                                    <button type="button" id="add_more_arrive" class="btn btn-info">+</button>


                                    <br>
                                </div>
                                <div class="form-body  ">
                                    <h4 class="form-section"><i class="ft-user"></i> السعر </h4>
                                    <div class="row">
                                        <div class="form-group col-md-4 ">
                                            <label class="label-control" for="projectinput1">السعر</label>
                                            <input type="text"  value="{{ $booking->price }}" name="price" class="form-control" id="">
                                            

                                        </div>
                                    </div>
                                   
                                    <br>
                                </div>




                                <div class="form-actions left">

                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> @lang('حفظ')
                                    </button>
                                    </button>
                                </div>


                                </form>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
            i = '{{ $count }}';
            $('#dublicate_row').click(function() {
                var newRow = '<tr>' +
                    '<td><input type="text" class="form-control" placeholder="المدينة" name="hotel[' + i +
                    '][city]" id=""></td>' +
                    '<td><input type="text" class="form-control" placeholder="اسم الفندق" name="hotel[' +
                    i + '][name]" id=""></td>' +
                    '<td><input type="text" class="form-control" placeholder="نوع الفندق" name="hotel[' +
                    i + '][type]" id=""></td>' +
                    '<td><input type="number" class="form-control" placeholder="عدد الليالي" name="hotel[' +
                    i + '][night]" id=""></td>' +
                    '<td><input type="text" class="form-control" placeholder="الوجبات" name="hotel[' + i +
                    '][eat]"  id="' + i + '"></td>' +
                    '<td><button class="btn btn-danger remove-row" type="button">-</button></td>' +
                    '</tr>';
                i++;

                $('.main_row').append(newRow);
                $(document).on('click', '.remove-row', function() {
                    $(this).closest('tr').remove();
                });
            });
            $(document).on('click', '.remove-roww', function() {
                    $(this).closest('tr').remove();
                });
            v = '{{ $count_arravice }}';
            $(document).on('click', '#add_more_arrive', function(event) {

                var newTITLE = `
                <br> 
                <div class=" col-md-8 " >
      <label class="label-control" for="projectinput1">خط سير الرحلة </label>
      <input type="text" name="arraive[${v}][title]" class="form-control" id="">
      
      </div>
      
      
      `;
                v++;
                var el = $(' <input type="checkbox" data-toggle="toggle"/>');

                $('.add_more').append(newTITLE);

                // Initialize the toggle plugin
                
            });


        });
    </script>
@endsection
