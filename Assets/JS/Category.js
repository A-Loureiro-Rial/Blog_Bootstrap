function addCat()
{
    var htmlpath = $('#htmlpath').attr('value');
    var Title = prompt("Write the name of your Category here!");
    if (Title != null)
    {
        var Description = prompt("Describe your Category here!");
        $.post( htmlpath + "functions/Category.php", {"CategoryTitle" : Title, "CategoryDescription" : Description, "mode" : "add"} );
        alert('Your Category has been successfully created :).');
        document.location.reload();
    }
}

function editCat(CatID)
{
    var htmlpath = $('#htmlpath').attr('value');
    var Title = prompt("Write the name of your Category here!", $('#CatTitle').text());
    if (Title != null)
    {
        var Description = prompt("Describe your Category here!", $('#CatDescription').text());
        $.post( htmlpath + "functions/Category.php", {"CategoryID": CatID, "CategoryTitle" : Title, "CategoryDescription" : Description, "mode" : "edit"} );
        alert('Your Category has been updated :).');
    }
}

function deleteCat(CatID)
{
    var htmlpath = $('#htmlpath').attr('value');
    if (confirm('Are you sure you want to delete the category "' + $('#CatTitle').text() + '" ?'))
    {
        $.post( htmlpath + "functions/Category.php", {"CategoryID": CatID, "mode" : "delete"} );
        alert('Your Category has been deleted!');
        window.location.replace( htmlpath + 'Views/Categories.php');
    }
}