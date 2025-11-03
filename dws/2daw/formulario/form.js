function validarForm(event) {
  event.preventDefault();
  const inputName = document.querySelector('#inputName');
  const inputPhone = document.querySelector('#inputPhone');
  const inputAge = document.querySelector('#inputAge');
  const errors = document.querySelector('#errors');
  let anyErrors = false;
  errors.textContent = "";

  if (inputName.value.length < 3) {
    errors.innerHTML += 'El nombre no es válido<br>';
    anyErrors = true;
  }

  if ((!inputPhone.value.startsWith("6") && !inputPhone.value.startsWith("7")) || inputPhone.value.length !== 9) {
    errors.innerHTML += 'El telefono no es válido<br>';
    anyErrors = true;
  }

  if (parseInt(inputAge.value) < 18 || +inputAge.value > 120 ) {
    errors.innerHTML += 'La edad no es válida<br>';
    anyErrors = true;
  }


  if (!anyErrors) {
    document.querySelector('form').submit();
  }

}