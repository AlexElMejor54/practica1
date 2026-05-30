import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NgIf } from '@angular/common';
import { IndicadorNumericoComponent } from './components/indicador-numerico/indicador-numerico.component';
import { SelectorSexoComponent } from './components/selector-sexo/selector-sexo.component';
import { ListadoResultadosComponent } from './components/listado-resultados/listado-resultados.component';
import { ResultadoImc } from './models/resultado-imc';

@Component({
  selector: 'app-root',
  imports: [
    FormsModule,
    NgIf,
    IndicadorNumericoComponent,
    SelectorSexoComponent,
    ListadoResultadosComponent
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  nombre = '';
  sexo = '';
  peso = 70;
  altura = 170;

  mensajeActual = '';
  resultados: ResultadoImc[] = [];

  calcular(): void {
    if (!this.nombre.trim() || !this.sexo) {
      this.mensajeActual = 'Completa el nombre y el sexo antes de calcular.';
      return;
    }

    if (this.peso <= 0 || this.altura <= 0) {
      this.mensajeActual = 'El peso y la altura deben ser mayores que 0.';
      return;
    }

    const alturaMetros = this.altura / 100;
    const imc = this.peso / (alturaMetros * alturaMetros);
    const imcRedondeado = Math.round(imc * 10) / 10;

    let estado = '';
    if (imc < 18.5) {
      estado = 'por debajo de tu peso ideal';
    } else if (imc <= 24.9) {
      estado = 'en tu peso ideal';
    } else {
      estado = 'por encima de tu peso ideal';
    }

    const mensaje = `Hola ${this.nombre}, tu IMC es ${imcRedondeado}. Estás ${estado}.`;
    this.mensajeActual = mensaje;

    const nuevoResultado: ResultadoImc = {
      nombre: this.nombre.trim(),
      sexo: this.sexo,
      peso: this.peso,
      altura: this.altura,
      imc: imcRedondeado,
      mensaje: estado
    };

    this.resultados = [...this.resultados, nuevoResultado];
  }

  borrar(): void {
    this.nombre = '';
    this.sexo = '';
    this.peso = 70;
    this.altura = 170;
    this.mensajeActual = '';
  }
}
