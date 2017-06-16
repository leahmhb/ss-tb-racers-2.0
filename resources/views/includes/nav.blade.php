<nav id="nav" class="navbar navbar-default navbar-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-white fa-bars fa-lg"></i>
      </button>
      <a class="navbar-brand" href="{{ URL::route('index') }}">SS TB Racers</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">  
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Guides
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu"> 
            <li><a href="{{ URL::route('guide_getting_started') }}">Getting Started</a></li> 
            <li><a href="{{ URL::route('guide_breeding') }}">Breeding</a></li> 
            <li><a href="{{ URL::route('guide_colors') }}">Colors</a></li> 
            <li><a href="{{ URL::route('guide_stats') }}">Stats</a></li> 
            <li><a href="{{ URL::route('guide_abilities') }}">Abilities</a></li> 
            <li><a href="{{ URL::route('guide_form') }}">Entry Form</a></li> 
          </ul>
        </li> 
        <li><a href="{{ URL::route('people_tables') }}">People</a></li>
        <li><a href="{{ URL::route('horse_table') }}">Horses</a></li> 
        <li><a href="{{ URL::route('lineage_table') }}">Lineages</a></li>
        <li><a href="{{ URL::route('race_table') }}">Races</a></li> 
        <li><a href="{{ URL::route('entry_table') }}">Entries</a></li> 
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Misc
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">  
            <li><a href="{{ URL::route('contact') }}">Contact</a></li>
            <li><a href="{{ URL::route('credits') }}">Credits</a></li>       
          </ul>
        </li> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Forms
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu"> 
            <li><a href="{{ URL::route('person') }}">Person</a></li>    
            <li><a href="{{ URL::route('horse') }}">Horse</a></li> 
            <li><a href="{{ URL::route('horse', ['0', 'Basic']) }}">Basic Horse</a></li> 
            <li><a href="{{ URL::route('lineage') }}">Lineage</a></li>                 
            <li><a href="{{ URL::route('race') }}">Race</a></li>      
            <li><a href="{{ URL::route('entry') }}">Entry</a></li>  
          </ul>
        </li> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            @if (!Auth::guest())
            {{ Auth::user()->name }}
            @else
            User
            @endif
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu"> 
            @if (Auth::guest())
            <li><a href="/auth/register">Register</a></li>       
            <li><a href="/auth/login">Login</a></li>
            @endif
            @if (!Auth::guest())
            <li><a href="/auth/logout">Logout</a></li>
            @endif
          </ul>
        </li> 
      </ul>
    </div>
  </div>
</nav>