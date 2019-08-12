  if (window.ActiveXObject)
  { 
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }
  else if (window.XMLHttpRequest)
  { 
    xhr = new XMLHttpRequest();
  }

function validate ()
  {
    var elt = document.getElementById("createForm");
    if (elt.newUserName.value == "no")
    {
      window.alert ("Please enter a user name");
      return false;
    }

    if ((elt.newPassword.value).length < 8)
    {
      window.alert ("Password must be at least 8 characters");
      return false;
    }
    return true;
  }

function newAlert() {
  window.alert("test");
}

function callServer()
  {
    var userName = document.getElementById("newUserName").value;

    var url = "validate.php";
    var params = "newUserName=" + userName;

    xhr.open ("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = updatePage;
    xhr.send (params);
  }

  function updatePage()
  {
     if ((xhr.readyState == 4) && (xhr.status == 200))
     {
        var response = xhr.responseText;
        console.log(response);
        if (response == "true") {
          document.getElementById('nameTaken').innerHTML = "That user name is already taken";
        }
     }
  }
