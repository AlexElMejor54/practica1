import { Component, input, InputSignal } from '@angular/core';
import { RouterLink } from '@angular/router';

import { PokemonSummary } from '../../models/pokemon-summary.model';

@Component({
  selector: 'app-pokemon-card',
  imports: [RouterLink],
  templateUrl: './pokemon-card.component.html',
  styleUrl: './pokemon-card.component.scss'
})
export class PokemonCardComponent {
  readonly pokemon: InputSignal<PokemonSummary> = input.required<PokemonSummary>();
}
