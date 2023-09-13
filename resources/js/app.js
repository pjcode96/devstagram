import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Arrastra tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const image = {}
            image.size = 1234
            image.name = document.querySelector('[name="image"]').value.trim()

            this.options.addedfile.call(this, image)
            this.options.thumbnail.call(this, image, `/uploads/${image.name}`)
            image.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }
});

dropzone.on('sending', (file, xhr, formData) => console.log(file))

dropzone.on('success', function (file, response) {
    console.log(response.image)
    document.querySelector('[name="image"]').value = response.image;
})

dropzone.on('removedfile', function () {
    document.querySelector('[name="image"]').value = '';
})