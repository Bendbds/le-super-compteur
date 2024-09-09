const counterDisplay = document.getElementById("total");
const btnReset = document.getElementById("reset");
const message = document.getElementById("message");

function updateCounter(action) {
    fetch('index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'action': action
        })
    })
    .then(response => response.json())
    .then(data => {
        const counter = data.counter_value;
        counterDisplay.textContent = counter;
        checkCounter(counter);
    });
}

const plusBtn = document.getElementById("plusbtn");
plusBtn.addEventListener("click", (event) => {
    updateCounter('increment');
});

const minusBtn = document.getElementById("moins-btn");
minusBtn.addEventListener("click", (event) => {
    updateCounter('decrement');
});

btnReset.addEventListener("click", (event) => {
    updateCounter('reset');
});

function checkCounter(counter) {
    if (counter < 3 && counter >= 0) {
        message.style.color = "red";
    } else if (counter >= 3 && counter < 10) {
        message.style.color = "green";
    } else if (counter >= 10) {
        message.style.color = "blue";
    } else if (counter < 0) {
        message.style.color = "yellow";
    }
}

// Initialiser le compteur au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    checkCounter(parseInt(counterDisplay.textContent));
});