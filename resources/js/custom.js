$(document).ready(function () {
    $('.custom-file-input').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
        $(this).next('.custom-file-label').html(cleanFileName);

        console.log(cleanFileName);
    })
});
