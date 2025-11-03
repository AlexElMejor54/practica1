export class Item{
        constructor(texto){
            this.text = texto;
            this.completed = false;
        }
            addItem(){ 
            const list = document.querySelector('#list');
            const item = document.createElement('li');
            item.textContent = this.text;
            list.appendChild(item);
        }
}