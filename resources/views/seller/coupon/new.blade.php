@extends('seller.layout')

@section('seller_title')
Новый купон
@endsection

@section('seller_content')
  <h2 class="text-center">Новый купон</h2>
  <form action="{{ route('seller.coupon.create') }}" enctype="multipart/form-data" method="POST">
   {{ csrf_field() }}
          
        {{-- LARAVEL FILE MANAGER --}}
        <div class="col-md-12">
          <div class="input-group">
           <span class="input-group-btn">
             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
               <i class="fa fa-picture-o"></i> Выбрать изображение
             </a>
           </span>
           <input id="thumbnail" class="form-control" type="text" name="preview">
         </div>
         <img id="holder" style="margin-top:15px;min-height:300px;">
        </div>
        
        {{-- END LARAVEL FILE MANAGER --}}
        
        <div class="col-md-12 col-sm-12">
            <div class="form-group col-md-12">
                <input required class="form-control" name="title" type="text" placeholder="Название акции" required data-toggle="tooltip" data-placement="right" title="Не более 60 символов">
            </div>
            {{-- Короткое название акции --}}
            <div class="form-group col-md-12">
                <input required class="form-control" name="short_description" type="text" placeholder="Короткое описание акции" required data-toggle="tooltip" data-placement="right" title="Не более 60 символов">
            </div>

            <div class="row">
                <div class="form-group col-md-7">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="form-control" for="selectDateTime">Действителен до:</label>
                    </div>
                    {{-- todo: UI for date time picker --}}
                    <div class="form-group col-md-6 col-sm-12">
                        <input class="form-control" name="selectDateTime" id="selectDateTime" value="" type="datetime-local" />
                    </div>
                </div>

                <div class="form-group  col-md-7">
                  <div class="col-md-6 col-sm-12">
                      <label class="form-control" for="selectСategory">Категория купона:</label>
                  </div>
                  <div class="col-md-6">
                      <select required class="form-control" name="coupon_category" id="selectСategory">
                          @foreach($couponCategories as $categorie)
                              <option value="{{$categorie->id}}">{{$categorie->title}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
            


    </div>
    <textarea required placeholder="Описание" name="content" id="textarea" cols="30" rows="10">
        Описание купона
    </textarea>
    <br>
    <div class="container">
        <button type="submit" class="btn btn-success">Разместить</button>
    </div>
  </form>
@endsection

@section('scripts')
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  <script src="{{asset("tinymce/tinymce.min.js")}}"></script>
  {{-- <script src="{{ asset("js/moment-with-locales.min.js") }}"></script>
  <script src="{{ asset('bootstrap-material-date-timepicker/js/bootstrap-material-datetimepicker.js') }}"></script> --}}
  <script>
    tinymce.init({
            selector: '#textarea',
            language: "ru",
            language_url: '/langs/ru.js'
          });
    $('#lfm').filemanager('image');
    // $('#selectDateTime').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD H:m:s',
    //         lang: 'ru'
    //       });
  </script>
@endsection