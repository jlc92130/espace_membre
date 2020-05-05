
var form_insc = document.forms.inscription_form;
champsVide.style.display = 'none';
email_er.style.display   = 'none';
identique.style.display  = 'none';

form_insc.addEventListener('submit',(e) => {
   e.preventDefault();
    
   var email = document.getElementById('email');
   var password = document.getElementById('password');
   var password_two = document.getElementById('password_two');
   var champsVide = document.getElementById('champsVide');
   var identique  = document.getElementById("identique");
   var email_er   = document.getElementById("email_er");
   var obj = document.getElementsByClassName("already_email")[0];

  var passwordValue = password.value;
  var emailValue = email.value;
  var password_twoValue = password_two.value;
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  
  if (emailValue == "" || passwordValue == "" || password_twoValue == "") {
    
    champsVide.style.display = 'inline';
    email_er.style.display = 'none'; 
    identique.style.display  = 'none';
    //champsVide(emailValue,passwordValue,password_twoValue);
  } else if ( !emailValue.match(mailformat)) {
      champsVide.style.display = 'none';
      email_er.style.display = 'inline';
      
  } else if (passwordValue.length<6 || passwordValue != password_twoValue ) {
    champsVide.style.display = 'none';
    email_er.style.display = 'none';
    identique.style.display  = 'inline';
    
  } else {
    form_insc.submit();
  }
    
})


 

 
    
  

 
    
  
