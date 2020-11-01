<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('/allsekolah')}}"><i class="fa fa-circle-o"></i>Sekolah</a></li>
              <li><a href="{{ url('/allkepsek')}}"><i class="fa fa-circle-o"></i>Kepala Sekolah</a></li>
              <li><a href="{{ url('/allbendahara')}}"><i class="fa fa-circle-o"></i>Bendahara Sekolah</a></li>
            </ul>
        </li>

        <li>
          <a href="{{ url('/pengajuanawal')}}">
            <i class="fa fa-book"></i> <span>Pengajuan Dana</span>
<!--             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
          </a>
<!--             <ul class="treeview-menu">
              <li><a href="{{ url('/directory')}}"><i class="fa fa-circle-o"></i>Sekolah</a></li>
              <li><a href="{{ url('/image_train/0')}}"><i class="fa fa-circle-o"></i>Kepala Sekolah</a></li>
              <li><a href="{{ url('/image_train/2')}}"><i class="fa fa-circle-o"></i>Bendahara Sekolah</a></li>
            </ul> -->
        </li>

<!--         <li>
          <a href="{{ url('/lihatprofil')}}">
            <i class="fa fa-user"></i> <span>Profil</span>
          </a>
        </li> -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Profil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('/lihatprofil')}}"><i class="fa fa-circle-o"></i>Personal Info</a></li>
              <li><a href="{{ url('/logout')}}"><i class="fa fa-circle-o"></i>Logout</a></li>
            </ul>
        </li>



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>