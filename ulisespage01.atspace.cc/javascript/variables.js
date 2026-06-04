
let operador1;
let operador2;
let resultado1;
let resultado2;
let resultado3;
let resultado4;

operador1 = parseFloat(prompt("Escribe por favor un número positivo entre 50 y 100"));
operador2 = parseFloat(prompt("Escribe por favor un número positivo entre 10 y 20"));

resultado1 = operador1 + operador2;
resultado2 = operador1 - operador2;
resultado3 = operador1 * operador2;
resultado4 = operador1 / operador2;

alert("La suma de esos 2 números es: " + resultado1);
alert("La resta de esos 2 números es: " + resultado2);
alert("La multiplicación de esos 2 números es: " + resultado3);
alert("La división de esos 2 números es: " + resultado4);
alert("Este ejercicio se programó con JavaScript y lo programó: Ulises Sánchez Camarena");
