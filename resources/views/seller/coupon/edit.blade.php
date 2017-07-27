@extends('seller.layout')

@section('seller_title')
Редактирование купона | {{ $coupon->title }}
@endsection

@section('seller_content')
  <h2 class="text-center">{{ $coupon->title }} | Редактировние</h2>
  <form action="{{ route('seller.coupon.update') }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <input type="hidden" value="{{ $coupon->id }}" name="id">
    <div class="row">

        {{-- LARAVEL FILE MANAGER --}}
        <div class="col-md-12">
          <div class="input-group">
           <span class="input-group-btn">
             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
               <i class="fa fa-picture-o"></i> Выбрать изображение
             </a>
           </span>
           <input id="thumbnail" class="form-control" type="text" name="preview" value="{{ $coupon->image }}">
         </div>
         <img id="holder" class="holder" style="margin:15px auto;width: 50%; height: auto; text-align: center" src="{{ $coupon->image }}">
        </div>
        {{-- END LARAVEL FILE MANAGER --}}
                
        <div class="col-md-12 col-sm-12">
            <div class="form-group col-md-12">
                <input required class="form-control" name="title" type="text" placeholder="Название акции" required data-toggle="tooltip" data-placement="right" title="Не более 60 символов" value="{{ $coupon->title }}">
            </div>
            {{-- Короткое название акции --}}
            <div class="form-group col-md-12">
                <input required class="form-control" name="short_description" type="text" placeholder="Короткое описание акции" required data-toggle="tooltip" data-placement="right" title="Не более 60 символов" value="{{ $coupon->short_description }}">
            </div>

            <div class="row">
                

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
  <script src="{{asset("tinymce/tinymce.min.js")}}"></script>
  {{-- <script src="{{ asset("js/moment-with-locales.min.js") }}"></script>
  <script src="{{ asset('bootstrap-material-date-timepicker/js/bootstrap-material-datetimepicker.js') }}"></script> --}}
  <script>

    tinymce.init({
            selector: '#textarea',
            language: "ru",
            language_url: '/langs/ru.js'
          });

    // $('#selectDateTime').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD H:m:s',
    //         lang: 'ru'
    //       });
  </script>
@endsection