{!! $header !!}
<section class="content-header">
	<h1>
		{{ $heading_title }}
		<small>{{ $sub_heading_title }}</small>
	</h1>
	<ol class="breadcrumb">
		@foreach ($breadcrumbs as $breadcrumb)
    <li><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
    @endforeach
	</ol>
</section>
<section class="container-fluid">
  <div class="pull-right">
    <button type="submit" form="form-setting" data-toggle="tooltip" title="{{ $button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>
  </div>
</section>
<section class="content">
	<!-- form start -->
	<form action="{{ $action }}" method="post" enctype="multipart/form-data" id="form-setting">
		<div class="row">
			<div class="col-sm-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $text_general }}</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>{{ $text_meta_title }}</label>
							<input type="text" class="form-control" name="config_meta_title" placeholder="{{ $text_meta_title }}" value="{{ $config_meta_title }}">
						</div>
						<div class="form-group">
							<label>{{ $text_meta_description }}</label>
							<input type="text" class="form-control" name="config_meta_description" placeholder="{{ $text_meta_description }}" value="{{ $config_meta_description }}">
						</div>
						<div class="form-group">
							<label>{{ $text_meta_keyword }}</label>
							<input type="text" class="form-control" name="config_meta_keyword" placeholder="{{ $text_meta_keyword }}" value="{{ $config_meta_keyword }}">
						</div>
						<div class="form-group">
							<label>{{ $text_email }}</label>
							<input type="text" class="form-control" name="config_email" placeholder="{{ $text_email }}" value="{{ $config_email }}">
						</div>
						<div class="form-group">
							<label>{{ $text_phone }}</label>
							<input type="text" class="form-control" name="config_phone" placeholder="{{ $text_phone }}" value="{{ $config_phone }}">
						</div>
						<div class="form-group">
							<label>{{ $text_limit_admin }}</label>
							<input type="text" class="form-control" name="config_limit_admin" placeholder="{{ $text_limit_admin }}" value="{{ $config_limit_admin }}">
						</div>

						<div class="form-group">
							<label>{{ $text_admin_template }}</label>
							<select name="config_admin_template" class="form-control">
								@foreach($admin_templates as $admin_template)
								<option value="{{ $admin_template['name'] }}" @if($config_admin_template==$admin_template['name']) selected="selected" @endif>{{ $admin_template['name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-sm-6"></div>
		</div>
	</form>
</section>
{!! $footer !!}