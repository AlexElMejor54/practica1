function saludar(nombre) {
    return `Hola, ${nombre}!`;
}

// Ejemplo de uso
console.log(saludar('Juan'));

// Crear una funcion que reciba un numero y retorne su factorial
function factorial(numero) {
    let resultado = 1;
    for (let i = 1; i <= numero; i++) {
        resultado *= i;
    }
    return resultado;
}

// Ejemplo de usoº
console.log(factorial(5)); // Output: 120
console.log(factorial(0)); // Output: 1
console.log(factorial(-3)); // Output: undefined

//Funcion que recibe un enlace de busqueda de Google y devuelva un string con lo que ha mostrado y pedirselo por consola
function extraerBusquedaGoogle(url) {
    const urlObj = new URL(url);
    return urlObj.searchParams.get('q');
}


const enlace = 'https://www.google.com/search?client=firefox-b-d&q=mne+gustan+los+pitos';
console.log(extraerBusquedaGoogle(enlace));

