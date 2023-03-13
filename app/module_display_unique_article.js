const articleSection = document.createElement('article');
fetch(`blog.php?article=${id}`)
    .then((response) => {
    return response.json()
    })
.then((article) => {
    articleSection.textContent = article

})