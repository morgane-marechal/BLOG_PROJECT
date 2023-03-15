const commentsDisplay = document.querySelector('#content-commentaires');

fetch(`blog.php?article?id=12`)
    .then((response) => {
        return response.text()
    })
    .then((article) => {
        commentsDisplay.textContent = article

    })