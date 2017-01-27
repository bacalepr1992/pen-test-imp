{!! $header !!}
<!-- Content Header (Page header) -->
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
    <a href="{{ $add }}" data-toggle="tooltip" title="{{ $button_add }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    <button type="button" data-toggle="tooltip" title="{{ $button_delete }}" class="btn btn-danger" onclick="confirm('{{ $text_confirm }}') ? $('#form-user-group').submit() : false;"><i class="fa fa-trash-o"></i></button>
  </div>
</section>
<!-- Main content -->
<section class="content">
	@if($success)
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{ $success }}
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  @endif
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ $text_list }}</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									@if ($sort == 'fullname')
										<a href="{{ $sort_fullname }}" class="{{ strtolower($order) }}">{{ $text_fullname }}</a>
									@else
										<a href="{{ $sort_fullname }}">{{ $text_fullname }}</a>
									@endif
								</th>
								<th>
									@if ($sort == 'email')
										<a href="{{ $sort_email }}" class="{{ strtolower($order) }}">{{ $text_email }}</a>
									@else
										<a href="{{ $sort_email }}">{{ $text_email }}</a>
									@endif
								</th>
								<th class="text-right">{{ $column_action }}</th>
							</tr>
						</thead>
						<tbody>
							@if($users)
							@foreach($users as $user)
							<tr>
								<td>{{ $user['fullname'] }}</td>
								<td>{{ $user['email'] }}</td>
								<td class="text-right"><a href="{{ $user['edit'] }}" title="" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a></td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<div class="row">
    <div class="col-sm-6 text-left">{!! $pagination !!}</div>
  </div>
</section>
<!-- /.content -->

{!! $footer !!}