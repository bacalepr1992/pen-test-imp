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
<section class="content">
	@if($success)
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{ $success }}
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  @endif
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">{{ $text_list }}</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="example2" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>{{ $column_name }}</th>
						<th>{{ $column_code }}</th>
						<th class="text-right">{{ $column_action }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($languages as $language)
					<tr>
						<td>{{ $language['name'] }}</td>
						<td>{{ $language['code'] }}</td>
						<td class="text-right"><a href="{{ $language['href'] }}" title="{{ $language['name'] }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
{!! $footer !!}