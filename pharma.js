$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

//SCRIPT CHECK PASSWORD
var password     =  document.getElementById('password');
var password_two =  document.getElementById('password_two');
var champsVide   =  document.getElementById('champsVide');
var form_conn    =  document.forms.connexion;
var inscription  =  document.getElementById('inscription');
var e_conn       =  document.querySelector("input[name='email_conn']")
var small        =  document.createElement('small');


const checkDict = { 
  sizeError: () =>  "  trop court",
  matchError: () =>  "mot de passe different ",
  success: () => "success"
};

    // checkDict["sizeError"] = () =>  "  trop court"  ;
    // checkDict["matchError"] = () => {return "mot de passe different " };
    /// checkDict["success"] = () =>  {return "success" };
    
 

  form_conn.addEventListener('submit',(e) =>{
    e.preventDefault();
    //CAPTURE INPUT AFTER SUBMIT
    var email_conn = e_conn.value;
    var password_conn = document.getElementById('password_conn').value;
    //REGEX EMAIL
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email_conn == "" || password_conn == "") {
      //KEEP MODAL OPEN
       
      small.textContent = "vous devez remplir les deux champs";
      form_conn.insertBefore(small,e_conn);
      //champs.textContent = "vous devez remplir les deux champs";
    } else if (!email_conn.match(mailformat)){
        //IS IT AN EMAIL ?
        //champs.textContent = "Vous n'avez pas saisi un email"
        small.textContent = "Vous n'avez pas saisi un email";
        form_conn.insertBefore(small,e_conn);
         
    } else {
      
      form_conn.submit();
    } 
 
  })
   





    


 