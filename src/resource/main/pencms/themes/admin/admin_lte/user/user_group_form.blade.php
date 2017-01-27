{!! $header !!}
<section class="content-header">
  <h1>
    {{ $heading_title }}
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
    <li><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
    @endforeach
  </ol>
</section>
<section class="container-fluid">
  <div class="pull-right">
    <button type="submit" form="form-user-group" data-toggle="tooltip" title="{{ $button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>
    <a href="{{ $cancel }}" data-toggle="tooltip" title="{{ $button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a>
  </div>
</section>
<section class="content">
  @if(isset($error_warning))
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-circle"></i> {{ $error_warning }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  @endif
  <!-- form start -->
  <form action="{{ $action }}" method="post" enctype="multipart/form-data" id="form-user-group">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $text_edit }}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="form-group required">
          <label>{{ $text_name }}</label>
          <input type="text" name="name" class="form-control" placeholder="{{ $text_name }}" value="{{ $name }}">
          @if (!empty($error_name))
          <div class="text-danger">{{ $error_name }}</div>
          @endif
        </div>
        <div class="form-group required">
          <label>{{ $text_description }}</label>
          <input type="text" name="description" class="form-control" placeholder="{{ $text_description }}" value="{{ $description }}">
          @if (isset($error_description))
          <div class="text-danger">{{ $error_description }}</div>
          @endif
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $text_permission }}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="form-group">
          <div class="col-sm-4">
            <label>{{ $text_view_permission }}</label>
            <div class="well well-sm" style="height: 250px; overflow: auto;">
              @foreach ($permissions as $permission)
              <div class="checkbox">
                <label>
                @if (in_array($permission['code'], $view))
                <input type="checkbox" name="permission[view][]" value="{{ $permission['code'] }}" checked="checked" />
                {{ $permission['name'] }}
                @else
                <input type="checkbox" name="permission[view][]" value="{{ $permission['code'] }}" />
                {{ $permission['name'] }}
                @endif
                </label>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-sm-4">
            <label>{{ $text_edit_permission }}</label>
            <div class="well well-sm" style="height: 250px; overflow: auto;">
              @foreach ($permissions as $permission)
              <div class="checkbox">
                <label>
                @if (in_array($permission['code'], $edit))
                <input type="checkbox" name="permission[edit][]" value="{{ $permission['code'] }}" checked="checked" />
                {{ $permission['name'] }}
                @else
                <input type="checkbox" name="permission[edit][]" value="{{ $permission['code'] }}" />
                {{ $permission['name'] }}
                @endif
                </label>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-sm-4">
            <label>{{ $text_delete_permission }}</label>
            <div class="well well-sm" style="height: 250px; overflow: auto;">
              @foreach ($permissions as $permission)
              <div class="checkbox">
                <label>
                @if (in_array($permission['code'], $delete))
                <input type="checkbox" name="permission[delete][]" value="{{ $permission['code'] }}" checked="checked" />
                {{ $permission['name'] }}
                @else
                <input type="checkbox" name="permission[delete][]" value="{{ $permission['code'] }}" />
                {{ $permission['name'] }}
                @endif
                </label>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </form>
</section>
{!! $footer !!}

