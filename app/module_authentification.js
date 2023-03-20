const formAuth = document.getElementById("form-auth");
const connexionButton = document.getElementById("connexion-button");
const inscriptionButton = document.getElementById("inscription-button");

if (inscriptionButton !== null) {
    inscriptionButton.addEventListener("click", async () => {
        await fetch('inscription.php')
            .then((response) => {
                return response.text();
            })
            .then((form) => {
                formAuth.innerHTML = form;
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
                            return response.json();
                        })
                        .then((content) => {
                            formAuth.textContent = content
                        })
                })
            })
    })
}

if (connexionButton !== null) {
    connexionButton.addEventListener("click", async () => {
        await fetch('connexion.php')
            .then(response => {
                return response.text();
            })
            .then(form => {
                formAuth.innerHTML = form;
                let submit = document.getElementById("envoie");
                let connexionForm = document.getElementById("form-connection");
                submit.addEventListener("click", (e) => {
                    e.preventDefault();
                    const form = new FormData(connexionForm)
                    fetch("connexion.php", {
                        method: "POST",
                        body: form
                    })
                        .then((response) => {
                            response.text();

                        })
                        .then((content) => {
                            formAuth.textContent = content
                            window.location.replace('http://localhost:8888/blog-js/profil.php')
                        })
                })
            })
    })
}