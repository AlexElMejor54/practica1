import { Component, inject, OnInit, signal, WritableSignal } from '@angular/core';
import { ActivatedRoute, RouterLink } from '@angular/router';

import { PokemonDetail } from '../../models/pokemon-detail.model';
import { PokemonService } from '../../services/pokemon.service';

@Component({
  selector: 'app-pokemon-detail',
  imports: [RouterLink],
  templateUrl: './pokemon-detail.component.html',
  styleUrl: './pokemon-detail.component.scss'
})
export class PokemonDetailComponent implements OnInit {
  private readonly pokemonService: PokemonService = inject(PokemonService);
  private readonly route: ActivatedRoute = inject(ActivatedRoute);

  protected readonly pokemon: WritableSignal<PokemonDetail | null> = signal<PokemonDetail | null>(
    null
  );
  protected readonly imageUrl: WritableSignal<string> = signal<string>('');
  protected readonly loading: WritableSignal<boolean> = signal<boolean>(true);
  protected readonly errorMessage: WritableSignal<string> = signal<string>('');

  ngOnInit(): void {
    this.route.paramMap.subscribe((params): void => {
      const idOrName: string | null = params.get('idOrName');
      if (idOrName !== null) {
        this.loadPokemon(idOrName);
      }
    });
  }

  protected getTypeClass(typeName: string): string {
    return `type-${typeName}`;
  }

  protected getTotalStats(poke: PokemonDetail): number {
    return poke.stats.reduce(
      (total: number, stat): number => total + stat.base_stat,
      0
    );
  }

  private loadPokemon(idOrName: string): void {
    this.loading.set(true);
    this.errorMessage.set('');
    this.pokemon.set(null);

    this.pokemonService.getPokemonByNameOrId(idOrName).subscribe({
      next: (detail: PokemonDetail): void => {
        this.pokemon.set(detail);
        this.imageUrl.set(this.pokemonService.getImageUrl(detail));
        this.loading.set(false);
      },
      error: (): void => {
        this.errorMessage.set('No se pudo cargar la información del Pokémon.');
        this.loading.set(false);
      }
    });
  }
}
