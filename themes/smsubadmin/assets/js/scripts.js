$(function () {

    $.validator.setDefaults({
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        },

        // errorElement: 'span',
        errorClass: 'help-block',

        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }
            else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                error.insertAfter(element.parent().parent());
            }
            else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.appendTo(element.parent().parent());
            }
            else if (element.prop('type') === 'password') {
                error.appendTo(element.parent());
            }
            else if (element.prop('type') === 'file') {
                error.appendTo(element.parent());
            }
            if (element.parent('select').length) {
                error.insertAfter(element.parent());
            }
            else {
                error.insertAfter(element);
            }
        }
    });

    $("#collaborator-register").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Digite o nome !!!"
            },
            last_name: {
                required: "Digite o sobrenome !!!"
            },
            email: {
                required: "Digite um email !!!"
            }
        }
    });

    $("#group-register").validate({
        rules: {
            group_name: {
                required: true
            },
            description: {
                required: true
            }
        },
        messages: {
            group_name: {
                required: "Digite o Grupo !!!"
            },
            description: {
                required: "Digite a Descrição !!!"
            }
        }
    });

    $("#churche-register").validate({
        rules: {
            churche_name: {
                required: true
            }
        },
        messages: {
            churche_name: {
                required: "Digite o nome da Igreja !!!"
            }
        }
    });


    $("#user-edit").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Digite o nome !!!"
            },
            last_name: {
                required: "Digite o sobrenome !!!"
            },
            email: {
                required: "Digite o e-mail !!!"
            }
        }
    });

    $("#user-register").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Digite o nome !!!"
            },
            last_name: {
                required: "Digite o sobrenome !!!"
            },
            email: {
                required: "Digite o e-mail !!!"
            }
        }
    });

    //  data-bs-toggle="tooltip" Bootstrap Title
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-togglee="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })


    /*
        * CARREGAR A FOTO NO UPLOAD
    */

    /* Atribui ao evento change do input FILE para upload da foto*/
    var inputFile = document.getElementById("photo");
    var foto_cliente = document.getElementById("foto-cliente");
    if (inputFile != null && inputFile.addEventListener) {
        inputFile.addEventListener("change", function(){loadFoto(this, foto_cliente)});
    } else if (inputFile != null && inputFile.attachEvent) {
        inputFile.attachEvent("onchange", function(){loadFoto(this, foto_cliente)});
    }

    /* Função para exibir a imagem selecionada no input file na tag <img>  */
    function loadFoto(file, img){
        if (file.files && file.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.src = e.target.result;
            }
            reader.readAsDataURL(file.files[0]);
        }
    }

    /*
        * AJAX FORM
        */
    $("form:not('.ajax_off')").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var load = $(".ajax_load");
        var flashClass = "ajax_response";
        var flash = $("." + flashClass);

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
            },
            uploadProgress: function (event, position, total, completed) {
                var loaded = completed;
                var load_title = $(".ajax_load_box_title");
                load_title.text("Enviando (" + loaded + "%)");

                form.find("input[type='file']").val(null);
                if (completed >= 100) {
                    load_title.text("Aguarde, carregando...");
                }
            },
            success: function (response) {
                //redirect
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    load.fadeOut(200);
                }

                //reload
                if (response.reload) {
                    window.location.reload();
                } else {
                    load.fadeOut(200);
                }

                //message
                if (response.message) {
                    if (flash.length) {
                        flash.html(response.message).fadeIn(100).effect("bounce", 300);
                    } else {
                        form.prepend("<div class='" + flashClass + "'>" + response.message + "</div>")
                            .find("." + flashClass).effect("bounce", 300);
                    }
                } else {
                    flash.fadeOut(100);
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {
                var message = "<div class='alert alert-warning alert-dismissible fade show text-center fw-semibold fs-5x' role='alert'><i class='bi bi-exclamation-diamond p-2'></i>Desculpe mas não foi possível processar a requisição. Favor tente novamente!</div>";

                if (flash.length) {
                    flash.html(message).fadeIn(100).effect("bounce", 300);
                } else {
                    form.prepend("<div class='" + flashClass + "'>" + message + "</div>")
                        .find("." + flashClass).effect("bounce", 300);
                }

                load.fadeOut();
            }
        });
    });
});