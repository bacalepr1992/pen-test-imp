

{!! $header !!}
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ $heading_title }}
    <small>advanced tables</small>
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
          <form action="{{ $delete }}" method="post" enctype="multipart/form-data" id="form-user-group">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
                  <th>{{ $column_name }}</th>
                  <th>{{ $column_description }}</th>
                  <th class="text-right">{{ $column_action }}</th>
                </tr>
              </thead>
              <tbody>
                @if($user_groups)
                @foreach($user_groups as $user_group)
                <tr>
                  <td class="text-center">
                    @if (in_array($user_group['user_group_id'], $selected))
                    <input type="checkbox" name="selected[]" value="{{ $user_group['user_group_id'] }}" checked="checked" />
                    @else
                    <input type="checkbox" name="selected[]" value="{{ $user_group['user_group_id'] }}" />
                    @endif
                  </td>
                  <td>{{ $user_group['name'] }}</td>
                  <td>{{ $user_group['description'] }}</td>
                  <td class="text-right"><a href="{{ $user_group['edit'] }}" title="" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
{!! $footer !!}

