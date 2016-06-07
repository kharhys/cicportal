var profileUrl = "/frontend/web/index.php/client/search?pk=";
var onFetchSuccess = function(data) {
  $("#signup-form").loading('stop');
  if(data[0]) {
    var title = "Hi " + data[0]["Name"]
    $.growl({ title: title, message: "Welcome back", location: 'tc' });
    $('#Name').val(data[0]["Name"])
    $('#UserName').val(data[0]["E-Mail"])
    $('#PhoneNumber').val(data[0]["Mobile"])
  }
}
var onFetchError = function(error) {
  $("#signup-form").loading('stop');
  var err = error.status + " : " + error.statusText
  $.growl.error({ message: err, location: 'tc' });
}

/*
$(document).ready(function() {
  $('input#IDNumber').on("focus", function() {
    $('#Name').val('')
    $('#UserName').val('')
    $('#PhoneNumber').val('')
  });
  $('input#IDNumber').on("blur", function() {
    $("#signup-form").loading();
    $.getJSON((profileUrl + $(this).val()), {}, onFetchSuccess).error(onFetchError)
  });
})
*/

function regformhash(form) {

  username = form.UserName.value;
  password = form.Password.value;
  confpass = form.ConfirmPassword.value;

  // Check each field has a value
  if (password == '' || confpass == '' || username == '')	{
    var msg = 'You must provide all the requested details. Please try again'
    $.growl.error({ message: msg, location: 'tc' });
    return false;
  }

  // Check that the password is sufficiently long (min 6 chars)
  if (password.length < 6) {
    var msg = 'Passwords must be at least 6 characters long.  Please try again'
    $.growl.error({ message: msg, location: 'tc' });
    form.Password.focus();
    return false;
  }

  // At least one number, one lowercase and one uppercase letter
  // At least six characters
  var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
  if (!re.test(password)) {
    var msg = 'Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again'
    $.growl.error({ message: msg, location: 'tc' });
    return false;
  }

  // Check password and confirmation are the same
  if (password != confpass) {
    var msg = 'Your Password and Confirmed Password do not match. Please try again'
    $.growl.error({ message: msg, location: 'tc' });
    return false;
  }
  // Create a new element input, this will be our hashed password field.
  var p = document.createElement("input");

  // Add the new element to our form.
  form.appendChild(p);
  p.name = "p";
  p.type = "hidden";
  p.value = hex_sha512(password);

  // Make sure the plaintext password doesn't get sent.
  form.Password.value = "";
  form.ConfirmPassword.value = "";

  // Finally submit the form.
  $.growl({ title: 'Submitting', message: 'Please wait....', location: 'tc' });
  form.submit();
  return true;
}
