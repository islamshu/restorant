<div class="card-body">
    @include('dashboard.parts._error')
    @include('dashboard.parts._success')

    <form class="form" method="post"
        action="{{ route('add_general') }}" enctype="multipart/form-data">
        @csrf 
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <label>اسم النظام</label>
                    <input type="text" name="general[title]" value="{{ get_general_value('title') }}" class="form-control ">
                    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label>لوجو الموقع</label>
                    <input type="file" name="general_file[image]" class="form-control image">
                    <div class="form-group">
                        <img src="{{ asset('uploads/' . get_general_value('image')) }}"
                            style="width: 100px" class="img-thumbnail image-preview " alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>خلفية الموقع الرئيسية</label>
                    <input type="file" name="general_file[background]" class="form-control image2">
                    <div class="form-group">
                        <img src="{{ asset('uploads/' . get_general_value('background')) }}"
                            style="width: 100px" class="img-thumbnail image-preview2 " alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>خلفية قائمة الانتظار</label>
                    <input type="file" name="general_file[background_wishlist]" class="form-control image3">
                    <div class="form-group">
                        <img src="{{ asset('uploads/' . get_general_value('background_wishlist')) }}"
                            style="width: 100px" class="img-thumbnail image-preview3 " alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>خلفية صفحة الاغلاق </label>
                    <input type="file" name="general_file[background_closed]" class="form-control image4">
                    <div class="form-group">
                        <img src="{{ asset('uploads/' . get_general_value('background_closed')) }}"
                            style="width: 100px" class="img-thumbnail image-preview4 " alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>الجملة الترحبية الاولى  </label>
                    <textarea name="general[welcom_first]" class="form-control" id="" cols="30" rows="3">{{ get_general_value('welcom_first') }}</textarea>
                    
                </div>
                <div class="col-md-6">
                    <label>الجملة الترحبية الثانية  </label>
                    <textarea name="general[welcom_secand]" class="form-control" id="" cols="30" rows="3">{{ get_general_value('welcom_secand') }}</textarea>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>رابط المنيو    </label>
                    <input type="url" name="general[menu]" value="{{ get_general_value('menu') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label> رابط الموقع على الخريطة          </label>
                    <input type="string" name="general[map]" value="{{ get_general_value('map') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label>رقم التواصل   </label>
                    <input type="string" name="general[phone_number]" value="{{ get_general_value('phone_number') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label> رابط الفيس بوك   </label>
                    <input type="string" name="general[facebook]" value="{{ get_general_value('facebook') }}" class="form-control"  >
                </div>
                <br>

                <div class="col-md-6">
                    <label> رقم الواتس اب    </label>
                    <input type="string" name="general[whatsapp]" value="{{ get_general_value('whatsapp') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label> رابط الانستقرام        </label>
                    <input type="string" name="general[instagram]" value="{{ get_general_value('instagram') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label> البريد الاكتروني         </label>
                    <input type="string" name="general[email]" value="{{ get_general_value('email') }}" class="form-control"  >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label> يبدأ العمل الساعة           </label>
                    <input type="time" name="general[start_at]" value="{{ get_general_value('start_at') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label> ينتهي الساعة          </label>
                    <input type="time" name="general[end_at]" value="{{ get_general_value('end_at') }}" class="form-control"  >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label> العدد الاقصى بالطابور         </label>
                    <input type="number" name="general[max_order]" value="{{ get_general_value('max_order') }}" class="form-control"  >
                </div>
                <div class="col-md-6">
                    <label> الرسالة بالعربية عند الوصول الى اقصى عدد           </label>
                    <textarea name="general[close_max_message]" class="form-control " id="" cols="30" rows="3">{{ get_general_value('close_max_message') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label> الرسالة بالانجليزية عند الوصول الى اقصى عدد           </label>
                    <textarea name="general[close_max_message_en]" class="form-control " id="" cols="30" rows="3">{{ get_general_value('close_max_message_en') }}</textarea>
                </div>
            </div>
            <br>
            <div class="row">
              
                <div class="col-md-6">
                    <label> الرسالة بالعربية عند الاغلاق               </label>
                    <textarea name="general[manual_close_message]" class="form-control " id="" cols="30" rows="3">{{ get_general_value('manual_close_message') }}</textarea>
                </div>
                 
                <div class="col-md-6">
                    <label> الرسالة بالانجليزية عند الاغلاق               </label>
                    <textarea name="general[manual_close_message_en]" class="form-control " id="" cols="30" rows="3">{{ get_general_value('manual_close_message_en') }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">
   الرسالة عند الاغلاق اليدوي بالعربية
                    </label>
                    <textarea name="general[close_message]" class="form-control " id="" cols="30" rows="3">{{ get_general_value('close_message') }}</textarea>

                </div>
                <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">
                     الرسالة عند الاغلاق اليدوي بالانجليزية
                    </label>
                    <textarea name="general[close_message_en]" class="form-control " id="" cols="30" rows="3">{{ get_general_value('close_message_en') }}</textarea>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">
                        كلمة المرور الخاصة بالاعدادت
                    </label>
                <input type="text" name="general[setting_password]" value="{{ get_general_value('setting_password') }}" class="form-control ">
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