@extends('seller.layout')

@section('seller_title')
Новый купон
@endsection

@section('seller_content')
  <h2 class="text-center">Новый купон</h2>
  <form action="{{ route('seller.coupon.create') }}" enctype="multipart/form-data" method="POST">
   {{ csrf_field() }}
          
    <div class="row">

        {{-- file preview input --}}
        <div class="col-md-12 col-sm-12">
            <div class="col-md-4">
                <div class="setting image_picker">
                  <div class="settings_wrap">
                    <label class="drop_target">
                      <div class="image_preview"></div>
                      <input required="true" id="inputFile" type="file" name="preview" accept="image/jpeg,image/png"/>
                    </label>
                    <div class="settings_actions vertical">
                        <a class="disabled" data-action="remove_current_image">
                            <i class="fa fa-ban"></i>Удалить изображение</a>
                    </div>
                  </div>
                </div>
                <div class="setting"></div>
            </div>
        </div>
        {{-- end fiel preiew input --}}
        
        <div class="col-md-12 col-sm-12">
            <div class="form-group col-md-12">
                <input required class="form-control" name="title" type="text" placeholder="Название акции" required data-toggle="tooltip" data-placement="right" title="Не более 60 символов">
            </div>
            {{-- Короткое название акции --}}
            <div class="form-group col-md-12">
                <input required class="form-control" name="short_description" type="text" placeholder="Короткое описание акции" required data-toggle="tooltip" data-placement="right" title="Не более 60 символов">
            </div>

            <div class="row">
                {{-- <div class="form-group  col-md-7">
                  <div class="col-md-6 col-sm-12">
                      <input required name="clients_profit" placeholder="выгоды клиента" class="form-control" type="number"
                             step="0.1">
                  </div>
                  <div class="col-md-6">
                      <select required class="form-control" name="clients_profit_type" id="">
                          @foreach($cats as $categorie)
                              <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                          @endforeach
                      </select>
                  </div>
                </div> --}}

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
            
        </div>
    </div>
      {{-- <div class="wrapper">
        <div class="box">
          <div class="js--image-preview"></div>
          <div class="upload-options">
            <label>
              <input required="true" type="file" class="image-upload" name="image1" accept="image/*" />
            </label>
          </div>
        </div>

        <div class="box">
          <div class="js--image-preview"></div>
          <div class="upload-options">
            <label>
              <input  type="file" class="image-upload" name="image2" accept="image/*" />
            </label>
          </div>
        </div>

        <div class="box">
          <div class="js--image-preview"></div>
          <div class="upload-options">
            <label>
              <input type="file" class="image-upload" name="image3" accept="image/*" />
            </label>
          </div>
        </div>
      </div> --}}
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
    $('#selectDateTime').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD H:m:s',
            lang: 'ru'
          });
  </script>
@endsection