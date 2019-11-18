function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}

function change_email()
{
    var request;

    try{
        request = new XMLHttpRequest();
    }
    catch(e)
    {
        try{
            request = new ActiveXObject("Ms.XMLHTTP");
        }
        catch(e)
        {
            try 
            {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                alert("browswer broken");
            }
        }
    }
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status ==  200)
        {
            document.getElementById("email_c").innerHTML = this.responseText;
            alert("Email updated");
        }
    };

    var email = document.getElementById("email").value;
    var sub = document.getElementById("email_change").value;
    var query = "?email="+email;
    query +="&email_change="+sub;
    if (!email || !ValidateEmail(email))
    {
        alert("You have entered an invalid email address!")
        return(false);
    }
    else
    {
        request.open("GET", "includes/change.php"+query, true);
        request.send();
    }
}

function username()
{
    var request;

    try{
        request = new XMLHttpRequest();
    }
    catch(e)
    {
        try{
            request = new ActiveXObject("Ms.XMLHTTP");
        }
        catch(e)
        {
            try 
            {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                alert("browswer broken");
            }
        }
    }
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status ==  200)
        {
            document.getElementById("user_c").innerHTML = this.responseText;
            alert("username updated");
        }
    };
    var user = document.getElementById("username").value;
    var sub = document.getElementById("user").value;
    var query = "?username="+user;
    query +="&user="+sub;
    var n = user.localeCompare("undefined");
    if (!user)
    {
        alert ("no input");
    }
    else
    {
        request.open("GET", "includes/change.php"+query, true);
        request.send();
    }
}

function notification()
{
    var request;

    try{
        request = new XMLHttpRequest();
    }
    catch(e)
    {
        try{
            request = new ActiveXObject("Ms.XMLHTTP");
        }
        catch(e)
        {
            try
            {
                request = new ActiveXObject("Miscrosoft.XMLHTTP");
            }
            catch(e)
            {
                alert("browser broken");
                return(false);
            }
        }
    }
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("notific_c").innerHTML = this.responseText;
            alert("Email notification status changed");
        }
    };
    var sub = document.getElementById("notific").value;
    var not = document.getElementsByName("notif");
    var se = "none";
    for (var i = 0, length = not.length; i < length; i++)
    {
        if (not[i].checked)
        {
            se = not[i].value;
            var query = "?notific="+sub;
            query += "&notif="+se;
            request.open("GET", "includes/change.php"+query, true);
            request.send();
            break;
        }
    }
    if(se.localeCompare("none") == 0)
    {
        alert("No selection Made");
        return(false);
    }
}