import { Component, Input } from '@angular/core';
import { NgFor, NgIf } from '@angular/common';
import { ResultadoImc } from '../../models/resultado-imc';

@Component({
  selector: 'app-listado-resultados',
  imports: [NgFor, NgIf],
  templateUrl: './listado-resultados.component.html',
  styleUrl: './listado-resultados.component.css'
})
export class ListadoResultadosComponent {
  @Input() resultados: ResultadoImc[] = [];
}
