<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <title>
        @yield("title", "andmade | p4")
        </title>
        
        {{-- CSS --}}
        {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet"/> --}}
        <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="http://fastly.ink.sapo.pt/3.1.10/css/ink-flex.min.css"/>
        <link rel="stylesheet" type="text/css" href="http://fastly.ink.sapo.pt/3.1.10/css/font-awesome.min.css">
        <link href="{{ URL::asset('css/p4.css') }}" rel="stylesheet"/>
        
        {{-- Javascript --}}
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        @yield("head")
    </head>
</html>
<body>
    {{-- Flash Messages --}}
    @if(Session::has('message'))
    <div class="flash-message ink-alert basic" role="alert">
        <button class="ink-dismiss">&times;</button>
        <p><b>Warning:</b>{!!Session::get('message')!!}</p>
    </div>
    @endif

    <nav id="navbar" class="ink-navigation blue" >
        <ul class="menu horizontal">
            <div class="push-left">
                <div class="">
                    <a href="#">
                        <img src="holder.js/150x90/auto/ink" alt="">
                    </a>
                </div>
            </div>
            
            <div class="push-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                <li><a href="#">Account</a></li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
                @endif
            </div>
        </ul>
    </nav>
    <main>
        @yield("content")
    </main>
    <footer>
        <p>
            © andmade {{ date('Y') }}
        </p>
    </footer>
    <script type="text/javascript" src="http://fastly.ink.sapo.pt/3.1.10/js/ink-all.js"></script>
    <script type="text/javascript" src="http://fastly.ink.sapo.pt/3.1.10/js/autoload.js"></script>
    <script src="{{ URL::asset('js/p4.js') }}"></script>
    @yield("body")
</body>