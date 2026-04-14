let listSelectAllBtn = document.querySelector(".list-pg .list-pg-check-select-all")
let checkBtns = document.querySelectorAll(".list-pg .list-pg-check")

listSelectAllBtn.addEventListener("click", () => {
    if (listSelectAllBtn.checked) {
        checkBtns.forEach((btn) => {
            btn.checked = true;
        })
    } else {
        checkBtns.forEach((btn) => {
            btn.checked = false;
        })
    }
})

// setTimeout(() => {
//     document.querySelector('.alert').style.display = 'none';
// }, 2000);

function deletionPost(id, url , title1 , title2 , text1 , text2) {
    Swal.fire({
        // title: '{{__("lang.Are you sure?")}}',
        // text: '{{__("lang.You wont be able to revert this!")}}',
        title: title1,
        text: text1,

        icon: "warning",
        showCancelButton: !0,
        customClass: {
            confirmButton: "btn btn-primary me-2 mt-2",
            cancelButton: "btn btn-danger mt-2"
        },
        confirmButtonText: "Yes, delete it!",
        buttonsStyling: !1,
        showCloseButton: !0
    })

    //     .then(function (t) {
    //
    //     t.value && Swal.fire({
    //         title: "Deleted!",
    //         text: "Your file has been deleted.",
    //         icon: "success",
    //         customClass: {confirmButton: "btn btn-primary mt-2"},
    //         buttonsStyling: !1
    //     })
    //
    //
    // })

        .then(function (result) {
            if (result.isConfirmed) {
                Swal.fire({
                    // title: "{{__('lang.deleting!')}}",
                    // text: "{{__('lang.Your file has been deleted.')}}",
                    title: title2,
                    text: text2,

                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-primary mt-2"
                    },
                    buttonsStyling: false
                }).then(function () {
                    window.location.href = url;
                });
            }

        });
}

