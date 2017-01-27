<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ admin_asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ $fullname }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li class="active">
				<a href="{{ url(App::getLocale().'/admin/common/dashboard') }}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview">
				<a href="">
        	<i class="fa fa-user"></i> <span>Users</span>
        	<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      	</a>
	    	<ul class="treeview-menu">
	      	<li><a href="{{ url(App::getLocale().'/admin/user/user') }}"><i class="fa fa-circle-o"></i> User</a></li>
	      	<li><a href="{{ url(App::getLocale().'/admin/user/user_group') }}"><i class="fa fa-circle-o"></i> User Group</a></li>
	    	</ul>
			</li>
			<li class="treeview">
				<a href="">
        	<i class="fa fa-cubes"></i> <span>Extension</span>
        	<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      	</a>
	    	<ul class="treeview-menu">
	      	<li><a href="{{ url(App::getLocale().'/admin/extension/theme') }}"><i class="fa fa-circle-o"></i> Themes</a></li>
	      	<li><a href="{{ url(App::getLocale().'/admin/extension/module') }}"><i class="fa fa-circle-o"></i> Modules</a></li>
	    	</ul>
			</li>
			<li class="treeview">
				<a href="">
        	<i class="fa fa-gears"></i> <span>System</span>
        	<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
      	</a>
      	<ul class="treeview-menu">
        	<li><a href="{{ url(App::getLocale().'/admin/setting/setting') }}"><i class="fa fa-circle-o"></i> <span>Setting</span></a></li>
        	<li><a href="{{ url(App::getLocale().'/admin/tool/filemanager') }}"><i class="fa fa-circle-o"></i> Files Manager</a></li>
        	<li><a href="{{ url(App::getLocale().'/admin/setting/language') }}"><i class="fa fa-circle-o"></i> Language</a></li>
        	<li><a href="{{ url(App::getLocale().'/admin/setting/log') }}"><i class="fa fa-circle-o"></i> Logs</a></li>
      	</ul>
			</li>

		</ul>
	</section>
	<!-- /.sidebar -->
</aside>