let contactsSelectAllBtn = document.querySelector(".contact-us-msgs-pg .contacts-pg-check-select-all")
let contactscheckBtns = document.querySelectorAll(".contact-us-msgs-pg .contacts-pg-check")

contactsSelectAllBtn.addEventListener("click", () => {
    if(contactsSelectAllBtn.checked) {
        contactscheckBtns.forEach((btn) => {
            btn.checked = true;
        })
    } else {
        contactscheckBtns.forEach((btn) => {
            btn.checked = false;
        })
    }
})