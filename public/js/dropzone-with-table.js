/**
 * Настройка дропзоны.
 *
 * Используется на:
 *  resources/views/get-buildings-files.blade.php
 *
 * @see https://docs.dropzone.dev/configuration/basics/configuration-options
 */
Dropzone.options.getBuildingsFiles = { // CamelCase версия идентификатора элемента формы

    // Конфигурация
    //autoProcessQueue: true,
    //uploadMultiple: true,
    //parallelUploads: 100,
    //maxFiles: 100,
    //disablePreviews: true,
    // acceptedFiles: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    acceptedFiles: ".xlsx,.csv",

    // Настройка дропзоны
    init: function() {
        var myDropzone = this;

    //     // Сначала измените кнопку, чтобы фактически сказать Dropzone обработать очередь.
    //     // this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    //     //     console.log('on 0')
    //     //     // Убедитесь, что форма на самом деле не отправляется.
    //     //     e.preventDefault();
    //     //     e.stopPropagation();
    //     //     myDropzone.processQueue();
    //     // });
    //
        // Слушайте событие sendmultiple. В данном случае это событие sendmultiple, а не событие отправки,
        // поскольку для uploadMultiple задано значение true.
        // this.on("sendingmultiple", function() {
        //     console.log('on 1')
        //     // Срабатывает, когда форма фактически отправляется.
        //     // Скрыть кнопку успеха или полную форму.
        // });
        // this.on("successmultiple", function(files, response) {
        //     console.log('on 2')
        //     console.log(files)
        //     console.log(response)
        //     // Запускается, когда файлы успешно отправлены.
        //     // Перенаправить пользователя или уведомить об успехе.
        // });
        // this.on("errormultiple", function(files, response) {
        //     console.log('on 3')
        //     console.log(files)
        //     console.log(response)
        //     // Срабатывает, когда произошла ошибка при отправке файлов.
        //     // Возможно, снова показать форму и уведомить пользователя об ошибке.
        // });
        this.on("success", function(files, response) {
            // console.log('on 4')
            // console.log(files)
            // console.log(response)
            // Редирект.
            if (response.status === true) {
                window.location.replace(response['redirect_url']);
            }
        });
    }

}
