@extends('layouts.backend')
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
                                    <a class="btn btn-success" href="{{ route('booking.create') }}">اضف حجز جديد</a>
                                    <br>
                                    <table class="table table-striped table-bordered zero-configuration" id="storestable">


                                        <br>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم   </th>
                                                <th>رقم الهاتف   </th>
                                                <th>الوجهة</th>
                                                <th>تاريخ انشاء الحجز  </th>
                                                <th>الاجراءات    </th>

                                            </tr>
                                        </thead>
                                        <tbody id="stores">
                                            @foreach (App\Models\Booking::orderby('id','desc')->get() as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>
                                                      {{ $item->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->phone }}
                                                      </td>
                                                      <td>
                                                        {{ $item->destination }}
                                                      </td>
                                                      <td>
                                                        {{ $item->created_at }}
                                                      </td>
                                                    <td>
                                                        <a href="{{ route('booking.show',$item->code) }}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ route('booking.edit',$item->id) }}"  class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                                        <a href="{{ route('pdf',$item->code) }}" target="_blank" class="btn btn-info">PDF</a>

                                                        <form style="display: inline"
                                                        action="{{ route('booking.destroy', $item->id) }}"
                                                        method="post">
                                                        @method('delete') @csrf
                                                        <button type="submit" class="btn btn-danger delete-confirm"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                    </td>



                                                </tr>
                                            @endforeach

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
    
@endsection
