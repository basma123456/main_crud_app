window.addEventListener("load", function () {

    const currentPage = window.location.pathname.split("/").pop();

    document.querySelectorAll(".side-nav .collapse").forEach(dropdown => {
        dropdown.classList.remove("show");
    });

    // افتح فقط الـ dropdown اللي فيه لينك مطابق للصفحة الحالية
    document.querySelectorAll(".side-nav a").forEach(link => {
        const href = link.getAttribute("href");
        if (!href || href === "#" || href === "javascript:void(0)") return;

        const linkPage = href.split("/").pop();

        if (linkPage === currentPage) {
            const parentDropdown = link.closest(".collapse");
            if (parentDropdown) {
                parentDropdown.classList.add("show");
            }
        }
    });

});


