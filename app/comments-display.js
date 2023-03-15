const commentsDisplay = document.querySelector('#content-commentaires');
// On stocke le paramètre de l'URL et on stocke le tableau dans une variable param
// On récupère la clé id du tableau pour fetch uniquement avec l'id de l'article
let id = window.location.search
let param = new URLSearchParams(id)

// On récupère les commentaires de l'article au lancement de la page grâce à l'id de l'article dans l'URL
// On les affiche dans la div #content-commentaires à l'aide d'une boucle for
// On crée une div pour chaque commentaire et on lui ajoute le contenu du commentaire
// On ajoute un écouteur au bouton #envoie-commentaire pour envoyer un commentaire
// On récupère le contenu du textarea #commentaire et on l'envoie au serveur
// On récupère le commentaire envoyé et on l'affiche dans la div #content-commentaires
// On vide le textarea #commentaire
fetch(`article.php?articleid=${param.get('id')}`)
    .then((response) => {
        return response.json()
    })
    .then((data) => {
        for (let i = 0; i < data.length; i++) {
            const div = document.createElement('div');
            div.classList.add('commentaire');
            div.innerHTML = data[i]['contenu'];
            commentsDisplay.appendChild(div);
        }
    })
// Ecoute du bouton #envoie-commentaire
// On récupère le contenu du textarea #commentaire et on l'envoie au serveur
// On return la promesse au format json
// On affiche cette réponse dans la div que l'on va créer et qui aura une classe commentaire
// On ajoute le contenu dans la div
const commentsForm = document.querySelector('#comments-form');
commentsForm.addEventListener('submit', (ev) => {
    ev.preventDefault();
    const commentInput = new FormData(commentsForm)
    fetch(`article.php?id=${param.get('id')}`, {
        method: 'POST',
        body: commentInput
    })
        .then((response) => {
            return commentInput.get('commentaire')
        })
        .then((data) => {
            const divCommentaire = document.createElement('div');
            divCommentaire.classList.add('commentaire');
            divCommentaire.innerHTML = data;
            commentsDisplay.appendChild(divCommentaire);
        })
    })

