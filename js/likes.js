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
   // var id = document.getElementById('id').value;
//    var elem = document.getElementById("like");
//    if (elem.value=="like")
//         elem.value = "unlike";
//    else
//         elem.value = "like";
    var query = "?id="+name;
    request.open("GET", "includes/likes.php" + query, true);
    //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(); 
}