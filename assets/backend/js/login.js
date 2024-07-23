$(function() {



    $('#login-form').bootstrapValidator({

        message: 'This value is not valid',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },



        fields: {

           username: {

             validators: {

                notEmpty: {

                    message: 'Se requiere el nombre de usuario, no puede estar vacío'

                },

                different: {

                    field: 'password',

                    message: 'El nombre de usuario y la contraseña no pueden ser la misma'

                }

            }

        },



        password: {

            validators: {

                notEmpty: {

                    message: 'Por favor, rellene este campo.'

                },

                stringLength: {

                    min: 6,

                    max: 30,

                    message: 'La contraseña debe tener más de 6 y menos de 30 caracteres'

                },

                different: {

                    field: 'username',

                    message: 'La contraseña no puede ser la misma que nombre de usuario'

                }

            }

        }



    }

});

});