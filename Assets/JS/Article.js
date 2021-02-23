function deleteArticle(ID, Name)
{
    if (confirm('Are you sure you want to delete the article "' + Name + '" ?'))
    {
        var htmlpath = $('#HTMLPATH').attr('value');
        $.post( htmlpath + "functions/Articles.php", {"ID": ID, "mode" : "delete"} );
        alert("Your article has been deleted!");
        window.location.replace( htmlpath + 'Views/Articles.php');
    }
}