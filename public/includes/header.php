<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&family=Khand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="./css/home.css">
</head>

<body class="text-light d-flex flex-column min-vh-100 bg-black">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="navbar-title">
                <h3>DEALBREAK</h3>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">PLAY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="about.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="leader_boards.php">LEADERBOARDS</a>
                    </li>
                </ul>
                <?php if (isset($_SESSION['logged_in'])) :  ?>
                    <ul class="navbar-nav pe-5">
                        <li class="nav-item">
                            WELCOME,
                            <?= strtoupper($_SESSION['logged_user']['username']) ?>
                        </li>
                        <li class="nav-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M9 14c0 1.657 2.686 3 6 3s6-1.343 6-3s-2.686-3-6-3s-6 1.343-6 3" />
                                    <path d="M9 14v4c0 1.656 2.686 3 6 3s6-1.344 6-3v-4M3 6c0 1.072 1.144 2.062 3 2.598s4.144.536 6 0c1.856-.536 3-1.526 3-2.598c0-1.072-1.144-2.062-3-2.598s-4.144-.536-6 0C4.144 3.938 3 4.928 3 6" />
                                    <path d="M3 6v10c0 .888.772 1.45 2 2" />
                                    <path d="M3 11c0 .888.772 1.45 2 2" />
                                </g>
                            </svg>
                            <?= number_format($_SESSION['logged_user']['coins']) ?>
                        </li>
                        <li class="nav-item">
                            <form action="handle_logout.php" method="post" class="p-0">
                                <input class="nav-link p-0" type="submit" value="Logout">
                            </form>
                        </li>
                    </ul>
                <?php endif  ?>
            </div>
        </div>
    </nav>