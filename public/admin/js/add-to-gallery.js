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
    console.log(filesList)
    for (let file of files) {

        if (!file.type.startsWith('image/')) continue;
        filesList.push(file);

        const reader = new FileReader();
        reader.onload = function (e) {
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
    // fileInput.value = ''; //here
}

function pressBtn(msg = "choose a photo first") {
    if (filesList.length == 0) {
        // let message = "{{ session('success') ?? session('msg') ?? session('error') }}";
        // let type = "{{ session('error') ? 'error' : 'success' }}";
        //
        Swal.fire({
            icon: 'error',
            title: msg,
            timer: 2000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        return;
    }
    document.getElementById('saveBtn').disabled = true;
    const formData = new FormData();

    filesList.forEach(file => {
        formData.append('images[]', file);
    });

    formData.append('test', '123');

    fetch('/admin/upload/gallery', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
        .then(res => res.text())
        .then(showMessage())
        .catch(err => console.error(err));
}


function showMessage() {
    myAlert();
    document.getElementById('previewArea').innerHTML = '';
    filesList = [];
    document.getElementById('saveBtn').disabled = false;

}


function myAlert() {
    Swal.fire({
        icon: 'success',
        title: 'success',
        timer: 2000,
        timerProgressBar: true,
        showCloseButton: true,
        didOpen: () => {
            Swal.showLoading();
        }
    });

}

// setTimeout(() => {
//     document.querySelector('.alert').style.display = 'none';
// }, 2000);
