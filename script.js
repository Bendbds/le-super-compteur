let counter = 0;
let totalResult = document.getElementById("total");
let btnreset = document.getElementById("reset");
let message = document.getElementById("message");

function incremente() {
    counter ++;
   totalResult.textContent = counter;
}


const plusbtn = document.getElementById("plusbtn");

plusbtn.addEventListener("click", (event)   => {
    incremente();
    checkCounter();
    
}) 

function decremente() {
    counter --;
    totalResult.textContent = counter;
}

const mnsbtn = document.getElementById("moins-btn");
mnsbtn.addEventListener("click", (event)   => {
    decremente();
    checkCounter();
})
 function resetbtn() {
    counter = 0;
    totalResult.textContent = counter;
    message.style.color = ""; // Réinitialise la couleur du texte de message
 }
 btnreset.addEventListener("click", (event)  =>  {
    resetbtn();
 })

 
 function checkCounter() {
    if(counter < 3 && counter > 0) {
        message.style.color = "red";
     }
     else if(counter > 3 && counter < 10) {
        message.style.color = "green";
     }
     else if(counter > 10) {
      message.style.color = "blue";
     }
     else if(counter < 0) {
      message.style.color = "yellow";
     }
 }


 