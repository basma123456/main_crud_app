let listSelectAllBtn = document.querySelector(".list-pg .list-pg-check-select-all")
let checkBtns = document.querySelectorAll(".list-pg .list-pg-check")

listSelectAllBtn.addEventListener("click", () => {
    if(listSelectAllBtn.checked) {
        checkBtns.forEach((btn) => {
            btn.checked = true;
        })
    } else {
        checkBtns.forEach((btn) => {
            btn.checked = false;
        })
    }
})