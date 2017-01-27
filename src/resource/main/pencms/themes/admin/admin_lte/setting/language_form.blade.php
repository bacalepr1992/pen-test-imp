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
    <button type="submit" form="form-language" data-toggle="tooltip" title="{{ $button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>
    <a href="{{ $cancel }}" data-toggle="tooltip" title="{{ $button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a>
  </div>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">{{ $text_form }}</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form action="{{ $action }}" method="post" enctype="multipart/form-data" id="form-language">
			<div class="box-body">
				<div class="form-group">
					<label>{{ $text_name }}</label>
					<input type="text" class="form-control" name="name" placeholder="{{ $text_name }}" value="{{ $language['name'] }}">
				</div>
				<div class="form-group">
					<label>{{ $text_code }}</label>
					<input type="text" class="form-control" name="code" placeholder="{{ $text_code }}" value="{{ $language['code'] }}">
				</div>
				<div class="form-group">
					<label>{{ $text_locale }}</label>
					<input type="text" class="form-control" name="locale" placeholder="{{ $text_locale }}" value="{{ $language['locale'] }}">
				</div>
				<div class="form-group">
					<label>{{ $text_image }}</label>
					<input type="text" class="form-control" name="image" placeholder="{{ $text_image }}" value="{{ $language['image'] }}">
				</div>
				<div class="form-group">
					<label>{{ $text_sort_order }}</label>
					<input type="text" class="form-control" name="sort_order" placeholder="{{ $text_sort_order }}" value="{{ $language['sort_order'] }}">
				</div>
			</div>
			<!-- /.box-body -->
		</form>
	</div>
</section>
{!! $footer !!}