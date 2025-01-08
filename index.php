<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>CutOrDye</title>
</head>


<body>

    <nav  class="navbar" role="navigation" aria-label="main navigation" >
        <div id="navbarBasicExample" class="navbar-menu" style="background-color: #C4C4C4">
            <div class="navbar-start" >
                <a class="navbar-item" href="#">
                    <img  src="./fotos/logo_CutOrDye.png" alt="logo"/>
                </a>
            </div>

            <div class="navbar-end" >
                    <a class="column " href="./login.php" >login</a>
                    <a class="column " href="#">about</a>
                    <a class="column " href="./makeReservation.php">reserveren</a>
                    <a class="column is-one-third" href="./account.php">my account</a>
            </div>
        </div>

    </nav>

    <header>

    </header>

    <main>
    <section class=" mg-large section is-flex" style="justify-content: center">
        <div class="foto-container is-flex-direction-row is-3" style="padding: max(50px) justify-content: space-between" >
            <div  class="is-flex image is-180x180 columns is-3" style="justify-content: space-between ">
                <img class="column" src="./fotos/hair1.jpeg" alt="hair 1"/>

                <img class="column" src="./fotos/hair2.jpeg" alt="hair 2" />

            </div>
            <div  class="is-flex  columns is-3" style="justify-content: space-around ">
            <strong>color </strong> <strong>color and cut</strong>
            </div>
            <div class="is-flex image is-256x256 columns is-3" style="justify-content: space-between" >
                <img class="column" src="./fotos/hair3.jpeg" alt="hair 3"/>
                <img class="column" src="./fotos/hair4.jpeg" alt="hair 4"/>
            </div>
            <div  class="is-flex  columns is-3" style="justify-content: space-around ">
            <strong>toner</strong> <strong>toner or root</strong>
        </div>

            <button class="btn"> <a class="has-text-white"  href="#">bevestigen</a></button>
            </section>




    </main>

    <footer class="footer" style="background-color: #C4C4C4" >
        <div class="is-flex columns is-1 has-text-centered ">

        <a class="column" href="#">Privacyverklaring</a>
        <a class="column" href="#">Algemene voorwaarden</a>
        <a class="column" href="#">Cookiebeleid</a>
        <a class="column" href="#">Contact</a>
        </div>
    </footer>

</body>

</html>