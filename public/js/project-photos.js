const photos = document.querySelector('.js-photos-container');
photos.addEventListener('change', function (event) {
    let t = event.target;
    if (t.tagName === 'INPUT') {
        if (isMainPhoto(t)) {
            removeMainPhoto(t);
        }
        addPhoto(t);
    }
});

photos.addEventListener('click', function (event) {
    const t = event.target;
    const jsAddImage = document.getElementById('js-add-image');

    //Add preview block
    if (t.id === 'js-add-image') {
        event.preventDefault();
        //container
        const field = document.createElement('div');
        field.classList.add('js-photos');
        jsAddImage.insertAdjacentElement('beforebegin', field);
        //preview
        const preview = document.createElement('div');
        preview.classList.add('img-preview');
        field.appendChild(preview);
        //new input element
        const input = document.createElement('input');
        input.classList.add('btn', 'btn-dark');
        input.type = 'file';
        input.name = 'photos[]';
        input.style.display = 'none';
        input.classList.add('mb-2', 'mt-2');
        field.appendChild(input);

        input.click();
    }

    //Remove preview block
    if (t.classList.contains('js-cancel-button')) {
        if (isMainPhoto(t)) {
            removeMainPhoto(t.parentNode);
            document.getElementById('photos[0]').value = '';
        } else {
            t.parentNode.parentNode.remove();
        }
    }
});

function addPhoto(t) {
    if (isMainPhoto(t)) {
        removePhoto(t);
    }
    let imgPreview = t.parentNode.querySelector('.img-preview');
    let image = document.createElement('img');
    image.setAttribute('src', URL.createObjectURL(t.files[0]));
    imgPreview.appendChild(image);
    //cancel button
    let cancelButton = document.createElement('div');
    cancelButton.classList.add('js-cancel-button', 'far', 'fa-times-circle', 'fa-2x');
    cancelButton.title = 'Удалить фото';
    image.insertAdjacentElement('beforebegin', cancelButton);
}

function isMainPhoto(t) {
    return !!(t.classList.contains('js-main-photo') || t.parentNode.parentNode.getElementsByClassName('js-main-photo').length > 0);
}

function removePhoto(t) {
    let photo = t.getElementsByTagName('img')[0];
    let button = t.getElementsByClassName('js-cancel-button')[0];
    if (photo) {
        t.removeChild(photo);
        t.removeChild(button);
    }
}

function removeMainPhoto(t) {
    let trg = t.parentNode.getElementsByClassName('img-preview')[0];
    let mainPhotoOldInput = trg.getElementsByTagName('input')[0];
    if (typeof mainPhotoOldInput != "undefined") {
        trg.removeChild(mainPhotoOldInput);
    }
    removePhoto(trg);
}