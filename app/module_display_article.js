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
            const newDate = document.createElement('p');
            const paragraphe = document.createElement('p');
            const categorie = document.createElement('span');

            newTitle.classList.add('title-article');
            newDate.classList.add('date-article')
            paragraphe.classList.add('contenu-article');
            divImg.classList.add('container-image-article');
            newImage.classList.add('image-article');
            categorie.classList.add('categorie-article');

            newTitle.textContent = articles[i]['titre'];
            newDate.textContent = `publié le ${articles[i]['date']}` + ` par ${articles[i]['prenom']}` + ` ${articles[i]['nom']}`;
            newImage.src = './images/' + articles[i]['image'];
            paragraphe.textContent = articles[i]['contenu'];
            categorie.textContent = articles[i]['categorie']

            newArticle.appendChild(newTitle);
            newTitle.appendChild(newDate);
            newArticle.appendChild(divImg);
            divImg.appendChild(newImage);
            newArticle.appendChild(paragraphe);
            containerArticles.appendChild(newArticle);
            containerArticles.appendChild(categorie);
        }
    });
