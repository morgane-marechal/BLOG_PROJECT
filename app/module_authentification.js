const place = document.getElementById("inscription-place");
const connexionButton = document.getElementById("connexion-button");
const inscriptionButton = document.getElementById("inscription-button");

inscriptionButton.addEventListener("click", async() => {
   await fetch('inscription.php')
        .then(response => {
            return response.text();
        })
        .then(form => {
            place.innerHTML = form;
            let submit = document.getElementById("envoie");
            let registerForm = document.getElementById("form-register");
            submit.addEventListener("click", (e) => {
                e.preventDefault();
                fetch("inscription.php", {
                    method: "POST",
                    body: new FormData(registerForm)
                })
                    .then(response => {
                        //isOk.innerHTML="Bravo l'inscription a fonctionné";
                        return response.text();
                    })
                    .then((content) => {
                        place.innerHTML=content
                    })
            })
        })
}) 

connexionButton.addEventListener("click", async() => {
    await fetch('connexion.php')
        .then(response => {
            return response.text();
        })
        .then(form => {
            place.innerHTML = form;
            let submit = document.getElementById("envoie");
            let connexionForm = document.getElementById("form-connection");
            submit.addEventListener("click", (e) => {
                e.preventDefault();
                const form = new FormData(connexionForm)
                fetch("connexion.php", {
                    method: "POST",
                    body: form
                })
                    .then(response => {
                        if ((response.ok)){
                        return response.text();
                        }
                    })
                    .then((content) => {
                        place.innerHTML=content

                        //console.log(content['reussite']);
                    })
            })
        })
}) 

