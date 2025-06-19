let navbar = document.querySelector('.header .flex .navbar');

 document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
 }

 window.onscroll= () => {
    navbar.classList.remove('active');
 }
 document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
    inputNumber.oninput = ()=> {
        if(inputNumber.value.length>inputNumber.maxlenghth) inputNumber.Value
        =inputNumber.value.slice(0, inputNumber.maxlenghth);

    };
 });