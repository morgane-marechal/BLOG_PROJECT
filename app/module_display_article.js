const containerArticles = document.querySelector('.articles');

fetch('blog.php?articles=all')
    .then((response) => {
        return response.json()
    })
    .then((articles) => {
        for (i = 0; i < articles.length; i++) {
            const newArticle = document.createElement('article');
            const newTitle = document.createElement('h2');
            const divImg = document.createElement('div');
            const newImage = document.createElement('img');
            const paragraphe = document.createElement('p');

            newTitle.classList.add('title-article');
            paragraphe.classList.add('contenu-article');
            divImg.classList.add('container-image-article');
            newImage.classList.add('image-article');

            newTitle.textContent = articles[i]['titre'];
            newImage.src = './images/' + articles[i]['image'];
            paragraphe.textContent = articles[i]['contenu'];

            newArticle.appendChild(newTitle);
            newArticle.appendChild(divImg);
            divImg.appendChild(newImage);
            newArticle.appendChild(paragraphe);
            containerArticles.appendChild(newArticle);
        }
    });
