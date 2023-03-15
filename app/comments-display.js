const commentsDisplay = document.querySelector('#content-commentaires');
let id = window.location.search
let param = new URLSearchParams(id)
console.log(param.get('id'))
fetch(`article.php?articleid=${param.get('id')}`)
    .then((response) => {
        return response.json()
    })
    .then((commentaires) => {
        for(i = 0; i < commentaires.length; i++){
            const newComment = document.createElement('div');
            commentsDisplay.append(newComment);
            console.log(commentaires[i]['contenu'])
            newComment.textContent = commentaires[i]['contenu']
        }

    })