<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">J And L</a>
    </div>
    @if (!Auth::guest())
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li @if(request()->is('/')) class="active" @endif><a href="/" class="active">Order</a></li>
          {{-- <li><a href="#/appointments">Appointments</a></li> --}}
          <li class="dropdown @if(request()->is('reports/*')) active @endif">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li @if(request()->is('reports/order')) class="active" @endif><a href="/reports/order">Order</a></li>
              <li @if(request()->is('reports/accessory')) class="active" @endif><a href="/reports/accessory ">Accessory</a></li>
              <li @if(request()->is('reports/flower')) class="active" @endif><a href="/reports/flower ">Flower</a></li>
              <li @if(request()->is('reports/service')) class="active" @endif><a href="/reports/service ">Service</a></li>
            </ul>
          </li>
          <li class="dropdown @if(request()->is('accessories') || request()->is('flowers') || request()->is('services') || request()->is('users')) active @endif">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li @if(request()->is('accessories')) class="active" @endif><a href="/accessories">Accessories</a></li>
              <li @if(request()->is('flowers')) class="active" @endif><a href="/flowers">Flowers</a></li>
              <li @if(request()->is('services')) class="active" @endif><a href="/services">Services</a></li>
              @if(Auth::user()->role_id == '1')
                <li @if(request()->is('users')) class="active" @endif><a href="/users">Users</a></li>
              @endif
              <li role="separator" class="divider"></li>
              <li><a href="/logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    @endif
  </div><!-- /.container-fluid -->
</nav>