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
  @if(!empty($error_warning))
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
          <input type="text" name="fullname" class="form-control" placeholder="{{ $text_name }}" value="{{ $fullname }}">
          @if (isset($error_fullname))
          <div class="text-danger">{{ $error_fullname }}</div>
          @endif
        </div>
        <div class="form-group required">
          <label>{{ $text_email }}</label>
          <input type="text" name="email" class="form-control" placeholder="{{ $text_email }}" value="{{ $email }}">
          @if (isset($error_email))
          <div class="text-danger">{{ $error_email }}</div>
          @endif
        </div>
        <div class="form-group required">
          <label>{{ $text_password }}</label>
          <input type="text" name="password" class="form-control" placeholder="{{ $text_password }}" value="">
          @if (isset($error_password))
          <div class="text-danger">{{ $error_password }}</div>
          @endif
        </div>
        <div class="form-group required">
          <label>{{ $text_password_confirm }}</label>
          <input type="text" name="password_confirmation" class="form-control" placeholder="{{ $text_password_confirm }}" value="">
          @if (isset($error_password_confirm))
          <div class="text-danger">{{ $error_password_confirm }}</div>
          @endif
        </div>
        <div class="form-group">
        	<label>{{ $text_user_group }}</label>
        	<select name="user_group_id" class="form-control">
        		@foreach($user_groups as $user_group)
        			@if($user_group['user_group_id'] == $user_group_id)
        			<option value="{{ $user_group['user_group_id'] }}" selected="selected">{{ $user_group['name'] }}</option>
        			@else
        			<option value="{{ $user_group['user_group_id'] }}">{{ $user_group['name'] }}</option>
        			@endif
        		@endforeach
        	</select>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </form>
</section>
{!! $footer !!}

