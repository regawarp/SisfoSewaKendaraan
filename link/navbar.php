<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid" style="background-color:#30318B;">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="">
                        <p style="color:#fff;"><?php echo "$_SESSION[status]"; ?></p>
                    </a>
                </li>
                <li>
                    <a href="process.php?process=logout">
                        <p style="color:#fff;">Log out</p>
                    </a>
                </li>
                <li class="separator hidden-lg hidden-md"></li>
            </ul>
        </div>
    </div>
</nav>