/*
*   Validation des formulaires (theomi_)
*/
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


/*
*   Modal
*/
var modal = document.getElementById("myModal");
let avatar = document.getElementById("avatar");
let userImg = document.getElementById("userImg");
let validateAvatar = document.getElementById("validate");
let validateText = document.getElementById("validateText");
let modalClose = document.getElementsByClassName("mymodal-container");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

avatar.addEventListener('change', (event)=>{
  if(!avatar.files[0].type.startsWith('image/')){ return }
  if(avatar.files[0] === undefined){ return }
  validateAvatar.style.display="block";
  let textLength = avatar.files[0].name.length
  let text=""
  if(textLength>14){
    for(let i = 0; i< 14;i++){
      text+=avatar.files[0].name[i]
    }
    validateText.innerText=text+"..."
  } else {
    validateText.innerText=avatar.files[0].name
  }


  //console.log(img.src)
})

const form = document.getElementById('imgForm')

form.addEventListener('submit', e => {
  userImg.src="./Tools/uploads/"+avatar.files[0].name;
})

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  email.style.display="block";
  emailInput.style.display="none";
  pseudo.style.display="block";
  pseudoInput.style.display="none";
}




/*
*   Inputs profil
*/
let pseudo = document.getElementById("pseudo");
let pseudoInput = document.getElementById("pseudo-input");
let email = document.getElementById("email");
let emailInput = document.getElementById("email-input");

pseudo.addEventListener("click", () =>{
  pseudo.style.display="none";
  pseudoInput.style.display="block";
  email.style.display="block";
  emailInput.style.display="none";
})
email.addEventListener("click", () =>{
  email.style.display="none";
  emailInput.style.display="block";
  pseudo.style.display="block";
  pseudoInput.style.display="none";
})
avatar.addEventListener("click", () =>{
  email.style.display="block";
  emailInput.style.display="none";
  pseudo.style.display="block";
  pseudoInput.style.display="none";
})



