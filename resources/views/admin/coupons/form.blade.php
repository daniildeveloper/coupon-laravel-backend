@extends("admin.layouts.master")
@section("title")
Новый купон
@endsection

@section("content")
<form action="{{route("coupon.fromadmin")}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="row">
      <div class="col-md-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Новый купон <small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br>
          <form class="form-horizontal form-label-left input_mask">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Заголовок</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input 
                name="coupon"
                type="text" 
                class="form-control" 
                placeholder="Заголовок">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Действителен до: </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="datetime-local" 
                name="selectDateTime" class="form-control">
              </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <input required name="clients_profit" placeholder="выгоды клиента" class="form-control" type="number"
                         step="0.1">
                </div>
                <div class="col-md-8">
                    <select required class="form-control" name="clients_profit_type" id="">
                      @foreach($clientsProfit as $profit)
                          <option value="{{$profit->id}}">{{$profit->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>

          <div class="form-group">
              <input title="Текст, который должен заинтересовать" type="text" class="form-control" name="short_description" placeholder="Очень короткое описание">
          </div>

            <textarea name="coupondescription" id="coupondescription" cols="30" rows="10">
                Описание
            </textarea>

          </form>
        </div>
      </div>
   </div>


{{-- Выбор компании --}}
  <div class="col-md-6 col-xs-12">
      <div class="x_panel">
      <div class="x_title">
        <h2>Купон от компании</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content search_company">
          <div class="row">
            <div class="col s12">
              <div class="container">
  
                <div class="ui-widget">
                  <select required="true" name="company" id="combobox">
                    <option  value="{{count(App\Company::all())}}">Выберите компанию</option>
                    @foreach($companies as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>

  </div>

  
  <div class="col-md-6 col-xs-12">
      <div class="x_panel">
      <div class="x_title">
        <h2>Главное изображение</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content search_company">
          <div class="row">
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
  </div>
  </div>

  <div class="col-md-12 col-xs-12">
      <div class="x_panel">
      <div class="x_title">
        <h2>Галерея</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content" style="min-height: 400px;">
          <div class="wrapper">
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
              </div>
      </div>
      <div class="container">
        <button class="btn btn-success" type="submit" >Сохранить и опубликовать</button>
      </div>
    </form>
@endsection
@section("scripts")
<script src="{{asset("js/coupon-add.js")}}">
    
</script>
<script src="{{asset("vendors/tinymce/tinymce.min.js")}}"></script>
<script src="{{asset("js/admin/jquery.autocomplete.min.js")}}"></script>
<script src="{{asset("js/admin/coupon-autocomplete.js")}}"></script>
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  {{-- <script src="{{asset("vendors/jquery/dist/jquery.min.js")}}"></script> --}}
  <script src="{{asset("admin/custom/jqueryui.js")}}"></script>
  <script src="{{asset("vendors/jquery-ui/ui/minified/jquery-1-7.js")}}"></script>
  <script src="{{asset("admin/custom/jqueryui.user.js")}}"></script>
  <script>
  window.onload = function() {
    tinymce.init({
        selector: "textarea",
        menubar: false
    });
  }
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox" ).toggle();
    });
  } );
      function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e){
    let file = e.currentTarget.files[0];
    checkType(file);
  }
  
  function previewImage(file){
    let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();

    reader.onload = function() {
      thumb.style.backgroundImage = 'url(' + reader.result + ')';
    }
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file){
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Это не картинка';
    } else if (!file){
      throw 'Картинка выбрана';
    } else {
      previewImage(file);
    }
  }
  
}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for(let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}



/// drop-effect
function initDropEffect(box){
  let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
  
  // get clickable area for drop effect
  area = box.querySelector('.js--image-preview');
  area.addEventListener('click', fireRipple);
  
  function fireRipple(e){
    area = e.currentTarget
    // create drop
    if(!drop){
      drop = document.createElement('span');
      drop.className = 'drop';
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = 'drop';
    
    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + 'px';
    drop.style.height = maxDistance + 'px';
    
    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");
    
    // calculate relative coordinates of click
    // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
    
    // position drop and animate
    drop.style.top = y + 'px';
    drop.style.left = x + 'px';
    drop.className += ' animate';
    e.stopPropagation();
    
  }
}

    </script>
  <script src="{{asset("js/simple.js")}}"></script>
@endsection

@section("styles")
<link rel="stylesheet" href="{{asset("vendors/jquery-ui/themes/base/jquery-ui.min.css")}}">
<link rel="stylesheet" href="{{asset("vendors/bootstrap-fileinput/css/fileinput.min.css")}}">
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<style>
div.box  {
  height: 100%;
  padding: 0px;
}
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
.btn-file {
  position: relative;
  overflow: hidden;
  margin:0 0 20px;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 999px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
}

@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: local('Material Icons'), local('MaterialIcons-Regular'), url(/fonts/matrial.woff2) format('woff2');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -webkit-font-feature-settings: 'liga';
  -webkit-font-smoothing: antialiased;
}
.wrapper {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

h1 {
  font-family: inherit;
  margin: 0 0 .75em 0;
  color: #728c8d;
  text-align: center;
}

.box {
  display: block;
  min-width: 300px;
  height: 300px;
  margin: 10px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
  -webkit-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  overflow: hidden;
}

.upload-options {
  position: relative;
  height: 75px;
  background-color: cadetblue;
  cursor: pointer;
  overflow: hidden;
  text-align: center;
  -webkit-transition: background-color ease-in-out 150ms;
  transition: background-color ease-in-out 150ms;
}
.upload-options:hover {
  background-color: #7fb1b3;
}
.upload-options input {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.upload-options label {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  width: 100%;
  height: 100%;
  font-weight: 400;
  text-overflow: ellipsis;
  white-space: nowrap;
  cursor: pointer;
  overflow: hidden;
}
.upload-options label::after {
  content: 'add';
  font-family: 'Material Icons';
  position: absolute;
  font-size: 2.5rem;
  color: #e6e6e6;
  top: calc(50% - 2.5rem);
  left: calc(50% - 1.25rem);
  z-index: 0;
}
.upload-options label span {
  display: inline-block;
  width: 50%;
  height: 100%;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  vertical-align: middle;
  text-align: center;
}
.upload-options label span:hover i.material-icons {
  color: lightgray;
}

.js--image-preview {
  height: 225px;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-image: url("");
  background-color: white;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
}
.js--image-preview::after {
  content: "photo_size_select_actual";
  font-family: 'Material Icons';
  position: relative;
  font-size: 4.5em;
  color: #e6e6e6;
  top: calc(50% - 3rem);
  left: calc(50% - 2.25rem);
  z-index: 0;
}
.js--image-preview.js--no-default::after {
  display: none;
}

i.material-icons {
  -webkit-transition: color 100ms ease-in-out;
  transition: color 100ms ease-in-out;
  font-size: 2.25em;
  line-height: 55px;
  color: white;
  display: block;
}

.drop {
  display: block;
  position: absolute;
  background: rgba(95, 158, 160, 0.2);
  border-radius: 100%;
  -webkit-transform: scale(0);
          transform: scale(0);
}

.animate {
  -webkit-animation: ripple 0.4s linear;
          animation: ripple 0.4s linear;
}

@-webkit-keyframes ripple {
  100% {
    opacity: 0;
    -webkit-transform: scale(2.5);
            transform: scale(2.5);
  }
}

@keyframes ripple {
  100% {
    opacity: 0;
    -webkit-transform: scale(2.5);
            transform: scale(2.5);
  }
}

</style>
@endsection