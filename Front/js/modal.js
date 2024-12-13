function modal(modalSection, overlay, openModalBtn, closeModalBtn, photo, btn)
{
    const openModal = function() {
        modalSection.classList.remove("hidden");
        overlay.classList.remove("hidden");
    }
    
    openModalBtn.addEventListener("click", openModal);
    
    const closeModal = function () {
        modalSection.classList.add("hidden");
        overlay.classList.add("hidden");
        const div = document.querySelector(".infoPerso");
        const form = div.querySelector("form");
        form.appendChild(photo);
    }
    
    closeModalBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);

    btn.onclick = function () {
        photo.click();
    }

}

export default modal;