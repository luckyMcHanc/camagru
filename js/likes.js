function likes( name)
{
  //  alert(name);
    var request;
    
    try{
        request = new XMLHttpRequest();
    }
    catch(e)
    {   
        try{
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                alert("My Man, your browser broke");
                return (false);
            }
        }
    }
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(name).innerHTML = this.responseText;
       }
    };

    var query = "?id="+name;
    request.open("GET", "includes/likes.php" + query, true);
    request.send(); 
}

function delpic(id)
{
    var request;
    try{
        request = new XMLHttpRequest;
    }
    catch(e)
    {
        try{
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch
            {
                alert("your browser is broken");
                return (false);
            }
        }
    }
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("del").innerHTML = this.responseText;
        }
    };
    var query = "?id="+id;
    request.open("GET", "includes/del.php" + query, true);
    request.send(); 
   alert("Image Deleted");
}

function comments(id, user, im)
{
    var request;
    try{
        request = new XMLHttpRequest;
    }
    catch(e)
    {
        try{
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e)
        {
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch
            {
                alert("your browser is broken");
                return (false);
            }
        }
    }
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementsById("comment_ddd").innerHTML = this.responseText;
        }
    };

    var comment = document.getElementsById(id);
    var query = "?id="+id;
    query +="&comment="+comment;
    query +="&userid="+user;

    alert(im);
   // request.open("GET", "includes/comment.php" + query, true);
   // request.send(); 
  // alert("Image Deleted");
}