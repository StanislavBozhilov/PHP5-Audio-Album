<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/content/styles.css" />
    <title>
        <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
    </title>
</head>

<body>
    <div id="wrapper">
        <header>
            <a href="/"><img src="/content/images/imgNote.png" id="logo" ></a>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/genres">Genres</a></li>
                <li><a href="/playlists">Playlists</a></li>
                <li><a href="/songs">Songs</a></li>

            </ul>
            <?php if ($this->isLoggedIn) :?>
            <span id="logged-in-info">
                <span>Hello, <?php echo $_SESSION['username']?></span>
                <form action="/account/logout"><input type="submit" value="Logout"/>
                </form>
            </span>
            <?php endif;?>
        </header>

        <?php include('messages.php'); ?>
