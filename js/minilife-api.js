"use strict";

minilife.ajaxRequest = (options) => {
    const defaults = {
        url: '/',
        method: 'GET',
        formData: null,
        showPreloader: true,
        onSuccess: null,
        onError: null,
        onComplete: null
    };
    options = $.extend(defaults, options);
    const ajaxOptions = {
        url: options.url,
        type: options.method,
        data: options.formData,
        cache: false,
        dataType: 'json',
        success: (response) => {
            if (response['error']) {
                if (typeof options.onError === 'function') {
                    options.onError(response);
                } else {
                    displayMessage(response['error']['message'], 'error');
                }
                return;
            }
            if (response['reload']) {
                window.location = window.location.href;
                return;
            }
            let showMessage = true;
            if (typeof options.onSuccess === 'function') showMessage = options.onSuccess(response);
            if (response['message'] && showMessage) displayMessage(response['message'], 'info');
        },
        error: (jqXHR, textStatus, errorThrown) => {
            displayMessage('Не удалось выполнить запрос: ' + errorThrown, 'error');
        },
        beforeSend: () => {
            if (options.showPreloader) ShowLoading();
        },
        complete: function (jqXHR) {
            if (options.showPreloader) HideLoading();
            if (typeof options.onComplete === 'function') options.onComplete(jqXHR);
        },
    };
    if (options.formData instanceof FormData) {
        ajaxOptions.contentType = false;
        ajaxOptions.processData = false;
    }
    return $.ajax(ajaxOptions);
};

minilife.registration = {
    toggleHiddenForm: function (selector, button) {
        const $this = $(button);
        const box = $(selector);
        box.slideToggle(150);
        const alt = $this.data('alt-text');
        const text = $this.html();
        $this.html(alt);
        $this.data('alt-text', text);
    },

    handleForm: function (handlerURL, form, event, reset) {
        if (event) event.preventDefault();
        const $form = $(form);
        const submitButton = $form.find(':submit');
        var submitButtonDisabled = false;

        $.ajax({
            type: 'POST',
            url: handlerURL,
            data: $form.serialize(),
            dataType: "json",
            success: function (response) {
                if (response['status'] == 'success') {
                    new Noty({
                        text: response['message'],
                        type: "success",
                    }).show();
                    console.log('OK', response);
                    submitButtonDisabled = true;
                } else if (response['status'] == 'error') {
                    new Noty({
                        text: response['message'],
                        type: "warning",
                    }).show();
                    console.log('Ошибка', response);
                    submitButtonDisabled = false;
                } else {
                    new Noty({
                        text: "Ошибка запроса. Неизвестный статус ответа :(",
                        type: "error",
                    }).show();
                    console.log('Ошибка запроса. Неизвестный статус ответа', response);
                    submitButtonDisabled = false;
                }
            },
            error: (jqXHR, textStatus, errorThrown) => {
                new Noty({
                    text: "Ошибка запроса. Не удалось выполнить запрос :(",
                    type: "error",
                }).show();
                console.log('Ошибка запроса. Не удалось выполнить запрос: ' + errorThrown, 'error');
                submitButtonDisabled = false;
            },
            beforeSend: () => {
                // if (options.showPreloader) ShowLoading();
            },
            complete: function (jqXHR) {
                if (submitButtonDisabled) {
                    $('.form-blocked').css('display', 'block');
                    submitButton.prop('disabled', true);
                }
            },
        });
    },
    generateRandomPassword: function (input) {
        const passw = this.generateRandomString(12);
        if (input.type === 'password') {
            input.value = '';
            input.type = 'text';
        }
        input.value = passw;
    },
    generateRandomString: function (length) {
        const chars = '1234567890ZYXWVUTSRQPONMLKJIHGFEDCBAzyxwvutsrqponmlkjihgfedcba';
        let result = '';
        for (let i = 0; i < length; i++) {
            const r = Math.floor(Math.random() * chars.length);
            result += chars.substring(r, r + 1);
        }
        return result
    },
};