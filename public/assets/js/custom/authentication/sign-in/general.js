"use strict";

var KTSigninGeneral = function () {
    var form, submitButton, validator;

    return {
        init: function () {
            form = document.querySelector("#kt_sign_in_form");
            submitButton = document.querySelector("#kt_sign_in_submit");

            validator = FormValidation.formValidation(form, {
                fields: {
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "The value is not a valid email address"
                            },
                            notEmpty: {
                                message: "Email address is required"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            submitButton.addEventListener("click", function (e) {
                e.preventDefault();

                validator.validate().then(function (result) {
                    if (result === "Valid") {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;

                        axios.post(form.getAttribute("action"), new FormData(form))
                            .then(function (response) {
                                // const redirectUrl = form.getAttribute("data-kt-redirect-url");
                                const redirectUrl = response.data.redirect;
                                if (redirectUrl) {
                                    window.location.href = redirectUrl;
                                } else {
                                    window.location.reload();
                                }
                            })
                            .catch(function (error) {
                                if (error.response && error.response.status === 429) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Too Many Attempts',
                                        text: 'You have tried too many times. Please wait and try again.'
                                    });
                                } else if (error.response && error.response.data && error.response.data.errors) {
                                    let messages = Object.values(error.response.data.errors).flat();
                                    let messageHtml = messages.map(m => `<div>${m}</div>`).join('');
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Login Failed',
                                        html: messageHtml
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Login Failed',
                                        text: 'Invalid credentials or server error.'
                                    });
                                }
                            })
                            .finally(function () {
                                submitButton.removeAttribute("data-kt-indicator");
                                submitButton.disabled = false;
                            });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Validation Failed',
                            text: 'Please complete all required fields.'
                        });
                    }
                });
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
