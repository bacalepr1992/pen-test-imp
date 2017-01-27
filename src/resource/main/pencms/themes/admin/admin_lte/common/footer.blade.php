	@if(Auth::check())
	</div><!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			{!! $text_version !!}
		</div>
		{!! $text_copyright !!}
	</footer>
	@endif
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
	<!-- Moment js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<!-- Add scripts -->
	@foreach ($scripts as $script)
	<script type="text/javascript" src="{{ admin_asset('assets/'.$script['href']) }}"></script>
	@endforeach
	<script src="{{ admin_asset('assets/js/main.js') }}"></script>
	</div>
</body>
</html>
