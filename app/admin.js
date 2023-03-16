
console.log("VERIF CONNEXION JS")

const displayUser = document.getElementById("user-place");
const displayArticle = document.getElementById("article-place");
const btnUser = document.getElementById("utilisateurs-button");
const btnArticle = document.getElementById("articles-button");

// ---------------------- manage users -------------------------

btnUser.addEventListener("click", (e) => {
    fetchDisplay();
})

function fetchDisplay(){               
    //e.preventDefault();
    fetch('admin_users.php')
        .then(response => {
            return response.text();
        })
            .then((content) => {
                displayUser.innerHTML=content
                updateEvent();
                deleteEvent();
        })
}

//------------- pour delete avec GET -----------------------
let allDel=document.querySelectorAll('.del');
let btnTest=document.getElementsByClassName(".del");

    //console.log("allDel: "+allDel.length);
    for (const btn of allDel){
        btn.addEventListener("click", (e) =>{
           // e.preventDefault();
            let idDelete= e.target.id
            console.log("delete  "+idDelete)
            deleteMe(idDelete);
            fetchDisplay();
        })
    }

    async function deleteMe(idDelete){
        await fetch(`admin_users.php?delete=${idDelete}`)
        .then((resp)=> {
            return resp.text();
        })
    }

    function deleteEvent(){
        let allDel=document.querySelectorAll('.del');
        let btnTest=document.getElementsByClassName(".del");
        console.log("allDel: "+allDel.length);
        for (const btn of allDel){
            btn.addEventListener("click", (e) =>{
            // e.preventDefault();
                let idDelete= e.target.id
                console.log("delete  "+idDelete)
                deleteMe(idDelete);
                fetchDisplay();
            })
        }
    }
   
deleteEvent();


//------------- pour update avec GET -----------------------

    function updateEvent(){
        let allUp=document.querySelectorAll('.update');
        console.log("update: "+allUp.length);
        for (const btnUp of allUp){
            btnUp.addEventListener("click", (e) =>{
            // e.preventDefault();
                fetchDisplay();
            })
        }
    }
   
updateEvent();


// ------------------- manage articles ----------------------

btnArticle.addEventListener("click", (e) => {
    fetchDisplayArticle();
})

function fetchDisplayArticle(){               
    //e.preventDefault();
    fetch('admin_articles.php')
        .then(response => {
            return response.text();
        })
            .then((content) => {
                displayUser.innerHTML=content
                updateArticle();
                deleteArticle();
        })
}

function updateArticle(){
    let allArt=document.querySelectorAll('.updateArticle');
    console.log("update article: "+allArt.length);
    for (const btnUpArt of allArt){
        btnUpArt.addEventListener("click", (e) =>{
        // e.preventDefault();
            fetchDisplayArticle();
        })
    }
}

updateArticle();

// --------------- manage articles -> delete dynamic----------------------

let allDelArticle=document.querySelectorAll('.del-article');
console.log("delte article ".allDelArticle );

function deleteArticle(){
    let allDelArticle=document.querySelectorAll('.del-article');
    console.log("allDelArticle: "+allDelArticle.length);
    for (const btn of allDelArticle){
        btn.addEventListener("click", (e) =>{
        // e.preventDefault();
            let idDeleteArticle= e.target.id
            deleteTheArticle(idDeleteArticle);
            fetchDisplayArticle();
        })
    }
}

async function deleteTheArticle(idDeleteArticle){
    await fetch(`admin_articles.php?delete-article=${idDeleteArticle}`)
    .then((resp)=> {
        return resp.text();
    })
}

deleteArticle();

// --------------- delete comments----------------------
const btnComment = document.getElementById("commentaires-button");

btnComment.addEventListener("click", (e) => {
    fetchDisplayComment();
})

function fetchDisplayComment(){               
    //e.preventDefault();
    fetch('admin_comments.php')
        .then(response => {
            return response.text();
        })
            .then((content) => {
                displayUser.innerHTML=content
                updateArticle();
                deleteArticle();
                deleteComment();
        })
}

let allDelComments=document.querySelectorAll('.del-comment');

function deleteComment(){
    let allDelComments=document.querySelectorAll('.del-comment');
    console.log("allDelComment: "+allDelComments.length);
    for (const btn of allDelComments){
        btn.addEventListener("click", (e) =>{
        // e.preventDefault();
            let idDeleteComment= e.target.id
            console.log("delete  Comment "+idDeleteComment)
            deleteTheComment(idDeleteComment);
            fetchDisplayComment();
        // window.location.reload();
        })
    }
}

async function deleteTheComment(idDeleteComment){
    await fetch(`admin_comments.php?delete-comment=${idDeleteComment}`)
    .then((resp)=> {
        //console.log("reponse deleteMe "+resp)
        return resp.text();
    })
}