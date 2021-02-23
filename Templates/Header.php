<?php
    function getHeader()
    {
    ob_start();
?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <a class="navbar-brand" href="<?=HTMLPATH?>">Alice's BootBlog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=HTMLPATH . 'Views/Articles.php'?>">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=HTMLPATH . 'Views/Categories.php'?>">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=HTMLPATH . 'Views/Contact.php'?>">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
<?php
    return ob_get_clean();
    }
?>