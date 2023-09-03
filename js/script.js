let btnReset = document.getElementById("reset");//Stock dans une variable et recupere l'element avec l'id

//Remettre les valeur à zero
btnReset.addEventListener("click",function() { //A l'evenement au click
    location.href = location.href;//Reload la page
})