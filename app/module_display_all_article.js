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
            const buttonRead = document.createElement('button');
            const categorie = document.createElement('span');
            console.log(articles[i])

            newTitle.classList.add('title-article');
            newDate.classList.add('date-article')
            paragraphe.classList.add('contenu-article');
            divImg.classList.add('container-image-article');
            newImage.classList.add('image-article');
            buttonRead.classList.add('button-read');
            buttonRead.setAttribute('data-article-id', `${articles[i]['article_id']}`)
            categorie.classList.add('categorie-article');

            newTitle.textContent = articles[i]['article_titre'];
            newDate.textContent = `publié le ${articles[i]['article_date']}` + ` par ${articles[i]['utilisateur_prenom']}` + ` ${articles[i]['utilisateur_nom']}`;
            newImage.src = './images/' + articles[i]['article_image'];
            paragraphe.textContent = articles[i]['article_contenu'];
            categorie.textContent = articles[i]['article_categorie']

            newArticle.appendChild(newTitle);
            newTitle.appendChild(newDate);
            newArticle.appendChild(divImg);
            divImg.appendChild(newImage);
            newArticle.appendChild(paragraphe);
            containerArticles.appendChild(newArticle);
            newArticle.appendChild(buttonRead);
            newArticle.appendChild(categorie);

        }
    });
