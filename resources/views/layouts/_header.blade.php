<header class="navbar navbar-fixed-top navbar-inverse">
    <div class=container>
        <div class="col-md-offset-1 col-md-10">
            <a href="/" id="logo">Sample App</a>
            <nav>
                <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="{{ route('users.index') }}">user list</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', Auth::user()->id) }}">personal center</a></li>
                            <li><a href="{{ route('users.edit', Auth::user()->id) }}">settings</a></li>
                            <li class="divider"></li>
                            <li>
                                <a id="logout" href="#">
                                    <form method="POST" action="{{ route('logout') }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('help') }}">help</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
                </ul>
            </nav>
        </div>
    </div>
</header>