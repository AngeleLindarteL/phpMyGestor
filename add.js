let openBtn = document.querySelector("#addUserBtn");
let closeBtn = document.querySelector("#backUserBtn");
let objective = document.querySelector(".addContainer");

openBtn.addEventListener('click', () => {
    objective.style.display = "flex";
    setTimeout(() => {
        objective.style.opacity = "100%";
    },10)
})
closeBtn.addEventListener('click', () => {
    objective.style.opacity = "0%";
    setTimeout(() => {
        objective.style.display = "none";
    },200)
})