let burger = document.querySelector('.burger');
let navMenu = document.querySelector('.ul_nav');
let bar = document.querySelector('.bar');
let bar3 = document.querySelector('.bar3')

burger.addEventListener("click", () => {
    burger.classList.toggle("active");
    navMenu.classList.toggle("active");
    bar.classList.toggle("active");
    bar3.classList.toggle("active");
})
