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
    <nav id="navbar" class="ink-navigation" >
        <ul class="menu horizontal">
            <li>
                <a href="#">
                    andscene
                </a>
            </li>
            <li>
                <a href="#">
                    Genres
                </a>
            </li>
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