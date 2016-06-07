function formhash(form) {
  // Create a new element input, this will be our hashed password field.
  Password = form.Password.value;
  var p = document.createElement("input");

  // Add the new element to our form.
  form.appendChild(p);
  p.name = "p";
  p.type = "hidden";
  p.value = hex_sha512(Password);

  // Make sure the plaintext password doesn't get sent.
  Password.value = "";
  
  // Finally submit the form.
  $.growl({ title: 'Logging In', message: 'Please wait....', location: 'tc' });
  form.submit();
}
