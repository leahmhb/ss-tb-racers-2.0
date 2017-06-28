<nav id="nav" class="navbar navbar-default navbar-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-white fa-bars fa-lg"></i>
      </button>
      <a class="navbar-brand" href="{{ URL::route('index') }}">
        {{ config('app.name', 'SS TB Racers') }}
      </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
       @foreach ($nav['mainbar'] as $key=>$val)
       @if($val['visible'] == 'true')
       @if($val['dropdown'] == 'true')
       <li class="dropdown">
         <a href="{{ $val['url'] }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
           <i class="{{ $val['icon'] }}"></i>
           {{ $val['label'] }}
           <span class="caret"></span>
         </a>
         <ul class="dropdown-menu">
          @foreach($nav['subbar'][$key] as $k=>$v)
          <li>
            <a href="{{ $v['url'] }}">
              <i class="{{ $v['icon'] }}"></i>
              {{ $v['label'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </li>
      @else
      <li>
        <a href="{{ $val['url'] }}">
          <i class="{{ $val['icon'] }}"></i>
          {{ $val['label'] }}
        </a>
      </li>
      @endif
      @endif
      @endforeach
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <!-- Authentication Links -->
      @if (Auth::guest())
      <li><a href="{{ route('login') }}">Login</a></li>
      <li><a href="{{ route('register') }}">Register</a></li>
      @else
      <li class="dropdown">
      <a href="/stable/{{ $nav['person']['id'] }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
          <li>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </li>
    @endif
  </ul>
</div>
</div>
</nav>