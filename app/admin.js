
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
            //console.log(response);
            return response.text();
        })
            .then((content) => {
                displayUser.innerHTML=content
                // updateEvent(); mettre fonction pour ajouter event listener
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
           // window.location.reload();
        })
    }

    async function deleteMe(idDelete){
        await fetch(`admin_users.php?delete=${idDelete}`)
        .then((resp)=> {
            //console.log("reponse deleteMe "+resp)
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
            // window.location.reload();
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
                //console.log("update nb "+idUp)
                fetchDisplay();
            // window.location.reload();
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
            //console.log(response);
            return response.text();
        })
            .then((content) => {
                displayUser.innerHTML=content
                updateArticle();
        })
}

function updateArticle(){
    let allArt=document.querySelectorAll('.updateArticle');
    console.log("update article: "+allArt.length);
    for (const btnUpArt of allArt){
        btnUpArt.addEventListener("click", (e) =>{
        // e.preventDefault();
            //console.log("update nb "+idUp)
            fetchDisplayArticle();
        })
    }
}

updateArticle();