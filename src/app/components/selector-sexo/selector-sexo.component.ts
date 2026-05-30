import { Component, EventEmitter, Input, Output } from '@angular/core';
import { NgClass } from '@angular/common';

@Component({
  selector: 'app-selector-sexo',
  imports: [NgClass],
  templateUrl: './selector-sexo.component.html',
  styleUrl: './selector-sexo.component.css'
})
export class SelectorSexoComponent {
  @Input() sexoSeleccionado = '';

  @Output() sexoChange = new EventEmitter<string>();

  elegir(sexo: string): void {
    this.sexoChange.emit(sexo);
  }
}
