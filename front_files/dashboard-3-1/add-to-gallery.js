const fileInput = document.getElementById('fileInput');
const previewArea = document.getElementById('previewArea');
const dropArea = fileInput.parentElement;
let filesList = [];

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, (e) => e.preventDefault());
});

dropArea.addEventListener('dragover', () => dropArea.classList.add('bg-light'));
dropArea.addEventListener('dragleave', () => dropArea.classList.remove('bg-light'));

dropArea.addEventListener('drop', (e) => {
    dropArea.classList.remove('bg-light');
    const dt = e.dataTransfer;
    const files = dt.files;
    handleFiles(files);
});

fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

function handleFiles(files) {
    for (let file of files) {
        if (!file.type.startsWith('image/')) continue;
        filesList.push(file);

        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'border rounded p-1';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-fluid';
            img.style.maxWidth = '120px';
            img.style.maxHeight = '120px';
            div.appendChild(img);
            previewArea.appendChild(div);
        };
        reader.readAsDataURL(file);
    }

    fileInput.value = '';
}

