$(document).ready(function()
{
    var htmlpath = $('#htmlpath').attr('value');
    setInterval(function()
    {
        $('#count').text(parseInt($('#count').text()) - 1);
        if ($('#count').text() == '0')
        {
            window.location.replace( htmlpath + 'Views/Read.php?ID=' + $('#ID').attr('value'));
        }        
    }, 1000);

})