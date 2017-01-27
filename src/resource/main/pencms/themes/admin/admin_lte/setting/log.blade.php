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
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">{{ $heading_title }}</h3>
			<div class="pull-right">
			 	<a href="{{ $download }}" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span></a>
        <a id="delete-log" href="{{ $delete }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="example2" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>{{ $text_type }}</th>
						<th>{{ $text_date }}</th>
						<th>{{ $column_description }}</th>
					</tr>
				</thead>
				<tbody>
				@if(!empty($logs))
					@foreach($logs as $key => $log)
					<tr>
					  <td class="text-{{{$log['level_class']}}}"><span class="glyphicon glyphicon-{{ $log['level_img'] }}-sign" aria-hidden="true"></span> &nbsp;{{ $log['level'] }}</td>
					  <td class="date">{{ $log['date'] }}</td>
					  <td class="text">
					    {{ $log['text'] }}
					    @if (isset($log['in_file'])) <br />
					    {{ $log['in_file'] }}
					    @endif
					    @if ($log['stack']) <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}</div>@endif
					  </td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="4" class="text-center">{{ $text_no_results }}</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
{!! $footer !!}