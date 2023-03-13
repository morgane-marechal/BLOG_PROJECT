
console.log("VERIF CONNEXION JS")

const displayUser = document.getElementById("user-place");
const btnUser = document.getElementById("utilisateurs-button");

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
/*
let allUp=document.querySelectorAll('.change_utilisateur');
let btnUp=document.getElementsByClassName('.change_utilisateur');

    for (const btnUp of allUp){
        btnUp.addEventListener("click", (e) =>{
           // e.preventDefault();
            let idUser= e.target.id
            console.log("update  "+idUser);
            update(idUser);
            fetchDisplay();
        })
    }

    async function done(idTask){
        await fetch(`todolist.php?update=${idTask}`)
        .then((resp)=> {
            console.log("reponse update "+resp)          
            return resp.text();
        })

    }
*/
