<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/static/css/index.css">
    <title><?= $title ?? "Youtube" ?></title>
</head>

<body>
    <header>
        <div class="fixed" id="nav">
            <div class="nav">
                <div class="logo">
                    <img src="/static/assets/menu.svg" alt="hamburger menu SVG" class="navShowHide">
                    <a href="/">
                        <img src="/static/assets/youtube.svg" alt="youtube logo" class="youtube">
                    </a>
                </div>

                <div class="searchBar">
                    <form action="src/pages/search.php" method="GET">

                        <input type="text" class="searchBar" name="term" placeholder="Search">
                        <button type="submit"><img src="/static/assets/search.svg" alt="search icon svg"
                                class="search"></button>

                    </form>
                </div>

                <div class="actions">
                    <a href="upload">
                        <img src="/static/assets/upload.svg" alt="upload SVG" class="upload">
                    </a>
                    <a href="signin">
                        <img src="/static/assets/profile.svg" alt="profile SVG" class="profile">
                    </a>
                </div>

            </div>
        </div>

    </header>

    <main>
        <aside id="sidenav"></aside>
        <div id="mainContent">
            <?= $content ?>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="/static/js/index.js"></script>
    <script src="/static/js/scrollShowUp.js"></script>

    <?= $js ?>
</body>

</html>