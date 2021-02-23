function addComment(ArtID)
{
    var comment = prompt("Write your comment here");
    if (comment != null)
    {
        var htmlpath = $('#HTMLPATH').attr('value');
        $.post( htmlpath + "functions/Comments.php", { "comment": comment, "ArtID" : ArtID, "mode" : "add"} );
        alert('Your comment has been added! =)');
        document.location.reload();
    }
}

function editComment(commentID, commentContent)
{
    console.log(commentContent);
    var comment = prompt("Modify your comment here", commentContent);
    if (comment != null && comment != commentContent)
    {
        var htmlpath = $('#HTMLPATH').attr('value');
        $.post( htmlpath + "functions/Comments.php", {"commentID": commentID, "comment": comment, "mode" : "edit"} );
        alert('Your comment has been updated! =)');
        document.location.reload();
    }
}

function deleteComment(commentID)
{
    if (confirm('Are you sure you want to delete this comment?'))
    {
        var htmlpath = $('#HTMLPATH').attr('value');
        $.post( htmlpath + "functions/Comments.php", { "commentID" : commentID, "mode" : "delete"} );
        alert('Your comment has been deleted! =)');
        document.location.reload();
    }
}