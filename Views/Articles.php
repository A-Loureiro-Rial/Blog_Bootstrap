<?php
require("../Config.php");
$Page = new page ('Mon BootBlog!');

$Page->getPage('Articles');
$Page->printPage();
