import { Component, inject, OnInit, signal, WritableSignal } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';

import { PokemonCardComponent } from '../../components/pokemon-card/pokemon-card.component';
import { PokemonSummary } from '../../models/pokemon-summary.model';
import { PokemonService } from '../../services/pokemon.service';

@Component({
  selector: 'app-dashboard',
  imports: [FormsModule, PokemonCardComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.scss'
})
export class DashboardComponent implements OnInit {
  private readonly pokemonService: PokemonService = inject(PokemonService);
  private readonly router: Router = inject(Router);

  protected readonly randomPokemon: WritableSignal<PokemonSummary[]> = signal<PokemonSummary[]>([]);
  protected readonly loading: WritableSignal<boolean> = signal<boolean>(true);
  protected readonly errorMessage: WritableSignal<string> = signal<string>('');
  protected readonly searchTerm: WritableSignal<string> = signal<string>('');
  protected readonly searchError: WritableSignal<string> = signal<string>('');

  private readonly randomCount: number = 9;

  ngOnInit(): void {
    this.loadRandomPokemon();
  }

  protected onSearch(): void {
    const term: string = this.searchTerm().trim().toLowerCase();
    this.searchError.set('');

    if (term.length === 0) {
      this.searchError.set('Introduce un nombre de Pokémon');
      return;
    }

    this.pokemonService.getPokemonByNameOrId(term).subscribe({
      next: (): void => {
        void this.router.navigate(['/pokemon', term]);
      },
      error: (): void => {
        this.searchError.set(`No se encontró ningún Pokémon con el nombre "${term}"`);
      }
    });
  }

  private loadRandomPokemon(): void {
    this.loading.set(true);
    this.errorMessage.set('');

    this.pokemonService.getRandomPokemon(this.randomCount).subscribe({
      next: (pokemon: PokemonSummary[]): void => {
        this.randomPokemon.set(pokemon);
        this.loading.set(false);
      },
      error: (): void => {
        this.errorMessage.set('Error al cargar los Pokémon. Inténtalo de nuevo.');
        this.loading.set(false);
      }
    });
  }
}
