const arabicBtn = document.getElementById('arabicBtn');
const englishBtn = document.getElementById('englishBtn');
const arabicForm = document.getElementById('arabicForm');
const englishForm = document.getElementById('englishForm');

arabicBtn.addEventListener('click', () => {
    arabicForm.classList.remove('d-none');
    englishForm.classList.add('d-none');

    arabicBtn.classList.add("active-lang-btn");
    englishBtn.classList.remove("active-lang-btn");
    
});

englishBtn.addEventListener('click', () => {
    englishForm.classList.remove('d-none');
    arabicForm.classList.add('d-none');

    englishBtn.classList.add("active-lang-btn");
    arabicBtn.classList.remove("active-lang-btn");
});
document.addEventListener("DOMContentLoaded", function () {

    const editorEnDiv = document.querySelector("#snow-editor");
    if (editorEnDiv) {
        const quillEn = new Quill(editorEnDiv, {
            theme: "snow",
            placeholder: "Write your article here...",
            modules: {
                toolbar: [
                    [{ header: [1,2,3,4,5,6,false] }],
                    ["bold","italic","underline","strike"],
                    [{ color: [] }, { background: [] }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ align: [] }],
                    ["blockquote","code-block"],
                    ["link","image","video"],
                    ["clean"]
                ]
            }
        });

        const form = document.querySelector("form");
        if (form) {
            form.addEventListener("submit", function() {
                const contentInputEn = document.querySelector("#contentInputEn");
                if (contentInputEn) {
                    contentInputEn.value = quillEn.root.innerHTML;
                }
            });
        }
    }

    const editorArDiv = document.querySelector("#snow-editor-ar");
    if (editorArDiv) {
        const quillAr = new Quill(editorArDiv, {
            theme: "snow",
            placeholder: "اكتب محتوى المقال هنا...",
            modules: {
                toolbar: [
                    [{ header: [1,2,3,4,5,6,false] }],
                    ["bold","italic","underline","strike"],
                    [{ color: [] }, { background: [] }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ align: [] }],
                    ["blockquote","code-block"],
                    ["link","image","video"],
                    ["clean"]
                ]
            }
        });

        const editorArContent = editorArDiv.querySelector(".ql-editor");
        editorArContent.setAttribute("dir", "rtl");
        editorArContent.style.textAlign = "right";

        const form = document.querySelector("form");
        if (form) {
            form.addEventListener("submit", function() {
                const contentInputAr = document.querySelector("#contentInputAr");
                if (contentInputAr) {
                    contentInputAr.value = quillAr.root.innerHTML;
                }
            });
        }
    }

});