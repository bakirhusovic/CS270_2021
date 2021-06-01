<?php require_once('function.php'); ?>
<header>
    <div class="wrapper">
        <h1>CSIS270 Blog</h1>
        <nav>
            <a href="index.php">Homepage</a>
            <?php if (checkIfNotLoggedIn()): ?>
                <a href="login.html">Login</a>
            <?php else: ?>
                <a href="logout.php">Logout</a>
            <?php endif?>
        </nav>
    </div>
</header>
