@extends("admin.layouts.master")
@section("title")
  {{$title}}
@endsection

@section("content")
<div class="col-md-12 col-sm-12 col-xs-12">
  <form action="{{route($route)}}">
    @if(isset($entity))
      <input type="hidden" name="id" value="{{$entity->id}}">
    @endif
    <div class="x_panel">
        <div class="x_title">
            <h2>
                {{$title}}
            </h2>
            <ul class="nav navbar-right panel_toolbox">
            @if(isset($previewUrl))
                <li class="preview">
                <style>
                  li.preview a {
                    color: #fff;
                  }
                  li.preview :hover {
                    color: #337ab7;
                  }
                </style>
                  <a target="_blank" href="{{url($previewUrl)}}/{{ $entity->id }}" class="btn btn-primary" >
                    Посмотреть
                  </a>
                </li>
                <li>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up">
                        </i>
                    </a>
                </li>
                
                @endif
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="x_content">
            @if(isset($additional_input_placeholder))
              <div class="container">
                <div class="col-md-12">
                  <input type="text" name="additional_input" class="form-control" value="{{$additional_input_placeholder}}">
                </div>
              </div>
            @endif
            <div class="container">
              <textarea name="text" class="my-editor" id="#textarea" cols="40" rows="15">
                {!! old('content', $content) !!}
              </textarea>
            </div>
        </div>
        <div class="x_footer">
          <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
    </div>
    </form>
</div>
@endsection

@section("scripts")
<script src="{{asset("tinymce/tinymce.min.js")}}"></script>
  <script>
  window.onload = function() {
    var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
  }
  </script>
@endsection