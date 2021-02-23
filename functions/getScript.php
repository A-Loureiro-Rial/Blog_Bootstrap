<?php
function getScripts(array $scriptlist)
{
    ob_start();
    foreach ($scriptlist as $script)
    {
?>
        <script src="<?=HTMLPATH . $script?>"></script>
<?php
    }
}