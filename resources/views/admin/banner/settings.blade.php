@extends("admin.layouts.master")

@section("title")
Настройки баннера
@endsection

@section("content")
<form action="{{route("banner-update")}}" method="post">
{{csrf_field()}}
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-bars">
                </i>
                Баннер
                <small>
                    добавить\обновить
                </small>
            </h2>
            <div class="clearfix">
            </div>
        </div>
        <div class="x_content">
            <div class="file-upload">
                <button class="file-upload-btn" onclick="$('.file-upload-input').trigger( 'click' )" type="button">
                    добавить изображение
                </button>
                <div class="image-upload-wrap">
                    <input id="file-upload" value="" name="preview" accept="image/*" class="file-upload-input" onchange="readURL(this);" type="file"/>
                    <div class="drag-text jumbotron">
                        <h3>
                            Перетащите или выберите изображение
                        </h3>
                    </div>
                </div>
                <div class="file-upload-content">
                    <img alt="your image" class="file-upload-image" src="#"/>
                    <div class="image-title-wrap">
                        <button class="remove-image" onclick="removeUpload()" type="button">
                            Удалить
                            <span class="image-title">
                                добавленное изображение
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">
                    Ссылка:
                </label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <input name="link" class="form-control" placeholder="http://" type="text">
                    </input>
                </div>
            </div>
            {{-- end default link --}}
            <div class="col-md-12">
              <label for="#action" class="contol-label">Текст баннера:</label>
              <div class="col-md-12">
                <textarea name="text" id="action" cols="30" rows="10"></textarea>
              </div>
            </div>
            <div class="container">
              <button class="btn btn-success text-center" type="submit">
                Сохранить и опубликовать
              </button>
            </div>
            
        </div>
    </div>
</div>
</form>
<div class="clearfix">
</div>
@endsection


@section("styles")
<style>
    .file-upload {
  background-color: #ffffff;
  width: 900px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #1ABB9C;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #15824B;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #1ABB9C;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #1ABB9C;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #1ABB9C;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #2A3F54;
  padding: 60px 0;
}

.file-upload-image {
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
</style>
@endsection

@section("scripts")
<script src="{{asset("vendors/tinymce/tinymce.min.js")}}"></script>
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    console.log(input.files[0])
    // $("#file-upload").val(input.files[0])
    

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      console.log(e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);
    

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
});

  window.onload = function() {
    tinymce.init({
        selector: "textarea",
        menubar: false
    });
  }
</script>
@endsection
