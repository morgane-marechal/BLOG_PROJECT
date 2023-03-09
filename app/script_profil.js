const place = document.getElementById("profil-form-place");


function callForm(){
    

   fetch('form_profil.php')
        .then(response => {
            return response.text();
        })
        .then(form => {
            place.innerHTML = form;
            let submit = document.getElementById("submit");
            let registerForm = document.getElementById("profil_form");
            submit.addEventListener("click", (e) => {
                e.preventDefault();
                fetch("form_profil.php", {
                    method: "POST",
                    body: new FormData(registerForm)
                })
                    .then(response => {
                        return response.text();
                    })
                    .then(() => {
                        
                        callForm();
                    })
            })
        })
 
}     

callForm();