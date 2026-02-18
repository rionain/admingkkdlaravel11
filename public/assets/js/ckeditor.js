let CKEDITOR;
ClassicEditor
    .create(document.querySelector('.editor'), {
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'fontColor',
                'underline',
                '|',
                'alignment',
                'outdent',
                'indent',
                'numberedList',
                '|',
                'undo',
                'redo'
            ]
        },
        language: 'id',
        licenseKey: '',



    })
    .then(editor => {
        CKEDITOR = editor




    })
    .catch(error => {
        console.error('Oops, something went wrong!');
        console.error(
            'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
        );
        console.warn('Build id: ky3aoucb1o1u-kr8wvj1ww14r');
        console.error(error);
    });
