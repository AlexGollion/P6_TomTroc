import modal from './modal.js';

const modalSection = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const openModalBtn = document.querySelector(".openModal");
const closeModalBtn = document.querySelector(".closeModal");
const image = document.getElementById('photo');
const btn = document.getElementById('btn');

modal(modalSection, overlay, openModalBtn, closeModalBtn, image, btn);