import modal from './modal.js';

const elements = {
    container: document.querySelector(".modal"),
    overlay: document.querySelector(".overlay"),
    openModalBtn: document.querySelector(".openModal"),
    closeModalBtn: document.querySelector(".closeModal"),
    image: document.getElementById('image'),
    btnChoixImg: document.getElementById('btnChoix'),
    preview: document.getElementById('preview')
}

console.log(elements);

if (elements.container)
{
    modal(elements);
}
