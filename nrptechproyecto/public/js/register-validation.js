"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        let isValid = true;

        const showValidationMessage = (input, message, isValid) => {
            const parentDiv = input.parentElement;
            const messageDiv = parentDiv.querySelector('.validation-message');
            messageDiv.innerHTML = message;

            if (isValid) {
                messageDiv.style.color = 'green';
            } else {
                messageDiv.style.color = 'red';
            }
        };

        // Validar nombre
        const nombreInput = document.getElementById('formNombre');
        const nombreRegex = /^[A-Za-z]+$/;
        if (!nombreRegex.test(nombreInput.value.trim())) {
            showValidationMessage(nombreInput, 'El nombre solo puede contener caracteres alfabéticos.', false);
            isValid = false;
        } else {
            showValidationMessage(nombreInput, '', true);
        }

        // Validar apellidos
        const apellidoInput = document.getElementById('formApellido');
        const apellidoRegex = /^[A-Za-z]+$/;
        if (!apellidoRegex.test(apellidoInput.value.trim())) {
            showValidationMessage(apellidoInput, 'Los apellidos solo pueden contener caracteres alfabéticos.', false);
            isValid = false;
        } else {
            showValidationMessage(apellidoInput, '', true);
        }

        // Validar email
        const emailInput = document.getElementById('formEmail');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value.trim())) {
            showValidationMessage(emailInput, 'Por favor, ingrese un correo electrónico válido.', false);
            isValid = false;
        } else {
            showValidationMessage(emailInput, '', true);
        }

        // Validar contraseña
        const passInput = document.getElementById('formPass');
        const passRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
        if (!passRegex.test(passInput.value)) {
            showValidationMessage(passInput, 'La contraseña debe tener al menos 12 caracteres, incluyendo una mayúscula, un número y un carácter especial.', false);
            isValid = false;
        } else {
            showValidationMessage(passInput, '', true);
        }

        // Validar confirmación de contraseña
        const pass2Input = document.getElementById('form2Pass');
        if (passInput.value !== pass2Input.value) {
            showValidationMessage(pass2Input, 'Las contraseñas no coinciden.', false);
            isValid = false;
        } else {
            showValidationMessage(pass2Input, '', true);
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
