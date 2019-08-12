function infoBox (idStr) {
	var current = document.getElementById(idStr).style.display;
	if (current == 'inline') {
		document.getElementById(idStr).style.display = 'none';
	}
	else {
		document.getElementById(idStr).style.display = 'inline';
	}
}

/*
function findSelectionsByClass (str) {
    var selectedValues = []; 
    var checkedElements = document.getElementsByClassName(str);

    for (var i=0; checkedElements[i]; ++i) {
      if(checkedElements[i].checked) {
           selectedValues.push(checkedElements[i].value);
      }
    }

    return selectedValues;
  }

function validate ()
  {
    var elt = document.getElementById("searchForm");
    if (elt.technique.value == "")
    {
      window.alert ("Select at least one technique");
      return false;
    }

    var selections = findSelectionsByClass('field');
    if (selections.length == 0)
    {
      window.alert ("Select fields to display");
      return false;
    }
    return true;
  } */
