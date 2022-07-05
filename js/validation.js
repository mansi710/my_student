// validation for first name and last name
function onlyAlphabet(inputtxt) {
  var latters = /^[a-z]*$/i;
  if (!inputtxt.value.match(latters)) {
    alert("please only enter alphabets");
  }
}

//validation for enter marks for subject
function onlyNumbers(inputtxt) {
  var number = /^[0-9]/;
  if (!inputtxt.value.match(number)) {
    alert("please only enter number");
  }
}

