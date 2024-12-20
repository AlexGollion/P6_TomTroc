function modal({container, overlay, openModalBtn, closeModalBtn, image, btnChoixImg, preview})
{
    const openModal = function() {
        container.classList.remove("hidden");
        overlay.classList.remove("hidden");
    }
    
    openModalBtn.addEventListener("click", openModal);
    
    const closeModal = function () {
        container.classList.add("hidden");
        overlay.classList.add("hidden");
        const containerForm = document.getElementById("containerForm");
        const form = containerForm.querySelector("form");
        form.appendChild(image);
        if (preview.src != null)
        {
            console.log("ici");
            const imageFinal = document.getElementById("imageLivre");
            imageFinal.src = preview.src;
        }
    }
    
    closeModalBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);

    const choixImg = function() {
        image.click();
    }

    btnChoixImg.addEventListener("click", choixImg);

    image.addEventListener('change', (e) => {
        //console.log(e)
        //console.log(image)
        const file = image.files[0];
        //console.log(file)
        preview.src = URL.createObjectURL(file);
        //console.log(preview.src)
    })

}

export default modal;