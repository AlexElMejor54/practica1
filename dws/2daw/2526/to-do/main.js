import { Item } from './item.js';

const boton = document.querySelector('#btn');
boton.onclick = addItem;

function addItem(){
    const input = document.querySelector('#inputText');
    const texto = input.value;
    const newItem = new Item(texto);
    newItem.addItem();
}