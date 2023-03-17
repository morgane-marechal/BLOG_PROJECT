const containerArticles = document.querySelector('.articles');

let urlParam = window.location.search;
let param = new URLSearchParams(urlParam);
let page;

if (param.get('page') === null){
    page = 1;
}else{
    page = param.get('page');
}
fetch(`get_articles.php?page=${page}`)
    .then((response) => {
        // return response.text();
        return response.json()
    })
    .then((articles) => {
        //articles = JSON.parse(articles);

        for (i = 0; i < articles.length; i++) {
            const newArticle = document.createElement('article');
            const newTitle = document.createElement('h2');
            const divImg = document.createElement('div');
            const newImage = document.createElement('img');
            const newDate = document.createElement('p');
            const paragraphe = document.createElement('p');
            const buttonRead = document.createElement('a');
            const categorie = document.createElement('span');

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
            buttonRead.href = `http://localhost:8888/blog-js/article.php?id=${articles[i]['article_id']}`;

            newArticle.appendChild(divImg)
            newArticle.appendChild(newTitle);
            newTitle.appendChild(newDate);
            divImg.appendChild(newImage);
            newArticle.appendChild(paragraphe);
            containerArticles.appendChild(newArticle);
            newArticle.appendChild(buttonRead);
            newArticle.appendChild(categorie);

        }
    });