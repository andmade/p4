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
        <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="http://cdn.ink.sapo.pt/3.1.10/css/ink-flex.min.css">

        <link href="{{ URL::asset('css/p4.css') }}" rel="stylesheet"/>
        {{-- Javascript --}}
        <script src="http://fastly.ink.sapo.pt/3.1.10/js/ink-all.js" type="text/javascript">
        </script>
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
    <header id="mainHeader">
        <h2>
            andscene
        </h2>
    </header>
    @yield("content")
    <footer>
        <p>
            © andmade {{ date('Y') }}
        </p>
    </footer>
    @yield("body")
</body>
