
const createNewNote = ()=> {
    console.log("createNote");
    
    const wall = document.getElementById("wall");
    const form = document.getElementById("form");
    const head = document.getElementById("head");
    const equis = document.getElementById("equis");

    wall.setAttribute("style","display: none;")
    form.setAttribute("style","display: block") 
    head.setAttribute("style","display: none") 
    equis.setAttribute("style","display: block")


}

const reverseChanges = ()=> {
    
    const wall = document.getElementById("wall");
    const form = document.getElementById("form");
    const head = document.getElementById("head");
    const equis = document.getElementById("equis");

    wall.setAttribute("style","display: block;")
    form.setAttribute("style","display: none") 
    head.setAttribute("style","display: flex") 
    equis.setAttribute("style","display: none")
}

document.getElementById("createNote").addEventListener("click", createNewNote);
document.getElementById("equis").addEventListener("click", reverseChanges);

