{!! $header !!}
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url(App::getLocale() . '/admin/') }}"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if(Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    <form action="{{ $action }}" method="post" role="form">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="{{ $text_email }}" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
        <div class="text-danger">{{ $errors->first('email') }}</div>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="{{ $text_password }}" value="" required=>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
        <div class="text-danger">{{ $errors->first('password') }}</div>
        @endif
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="btn-group">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            @foreach($languages as $language)
            @if ($language['code'] == $code)
            <img src="catalog/language/{{ $language['code'] }}/{{ $language['code'] }}.png" alt="{{ $language['name'] }}" title="{{ $language['name'] }}">
            @endif
            @endforeach
            <i class="fa fa-caret-down"></i></button>
            <ul class="dropdown-menu">
              @foreach($languages as $language)
              <li>
                <a rel="alternate" hreflang="{{ $language['code'] }}" href="{{ $language['href'] }}">
                <img src="catalog/language/{{ $language['code'] }}/{{ $language['code'] }}.png" alt="{{ $language['name'] }}" title="{{ $language['name'] }}" /> {{ $language['name'] }}
                </a>
              </li>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ $text_signin }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
{!! $footer !!}
