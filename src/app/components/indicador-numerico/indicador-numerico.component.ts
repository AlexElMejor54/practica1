import { Component, EventEmitter, Input, Output } from '@angular/core';

@Component({
  selector: 'app-indicador-numerico',
  imports: [],
  templateUrl: './indicador-numerico.component.html',
  styleUrl: './indicador-numerico.component.css'
})
export class IndicadorNumericoComponent {
  @Input() etiqueta = '';
  @Input() valor = 0;
  @Input() paso = 1;
  @Input() minimo = 0;
  @Input() maximo = 300;

  @Output() valorChange = new EventEmitter<number>();

  sumar(): void {
    if (this.valor + this.paso <= this.maximo) {
      this.valorChange.emit(this.valor + this.paso);
    }
  }

  restar(): void {
    if (this.valor - this.paso >= this.minimo) {
      this.valorChange.emit(this.valor - this.paso);
    }
  }
}
