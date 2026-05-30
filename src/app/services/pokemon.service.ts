import { Injectable, inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, forkJoin, map } from 'rxjs';

import { PokemonListResponse } from '../models/pokemon-list-response.model';
import { PokemonDetail } from '../models/pokemon-detail.model';
import { PokemonSummary } from '../models/pokemon-summary.model';

@Injectable({
  providedIn: 'root'
})
export class PokemonService {
  private readonly http: HttpClient = inject(HttpClient);
  private readonly baseUrl: string = 'https://pokeapi.co/api/v2';
  private readonly maxPokemonId: number = 1025;
  private readonly pageSize: number = 20;

  getPageSize(): number {
    return this.pageSize;
  }

  getPokemonList(offset: number): Observable<PokemonListResponse> {
    const url: string = `${this.baseUrl}/pokemon?limit=${this.pageSize}&offset=${offset}`;
    return this.http.get<PokemonListResponse>(url);
  }

  getPokemonByNameOrId(nameOrId: string | number): Observable<PokemonDetail> {
    const url: string = `${this.baseUrl}/pokemon/${nameOrId.toString().toLowerCase()}`;
    return this.http.get<PokemonDetail>(url);
  }

  getRandomPokemon(count: number): Observable<PokemonSummary[]> {
    const randomIds: number[] = this.generateRandomIds(count);
    const requests: Observable<PokemonSummary>[] = randomIds.map(
      (id: number): Observable<PokemonSummary> =>
        this.getPokemonByNameOrId(id).pipe(
          map((pokemon: PokemonDetail): PokemonSummary => this.toSummary(pokemon))
        )
    );
    return forkJoin(requests);
  }

  extractIdFromUrl(url: string): number {
    const parts: string[] = url.split('/').filter((part: string): boolean => part.length > 0);
    const id: number = Number(parts[parts.length - 1]);
    return id;
  }

  getImageUrl(pokemon: PokemonDetail): string {
    const officialArtwork: string | null | undefined =
      pokemon.sprites.other?.['official-artwork']?.front_default;
    const fallback: string | null = pokemon.sprites.front_default;
    return officialArtwork ?? fallback ?? '';
  }

  toSummary(pokemon: PokemonDetail): PokemonSummary {
    return {
      id: pokemon.id,
      name: pokemon.name,
      imageUrl: this.getImageUrl(pokemon)
    };
  }

  private generateRandomIds(count: number): number[] {
    const ids: Set<number> = new Set<number>();
    while (ids.size < count) {
      const randomId: number = Math.floor(Math.random() * this.maxPokemonId) + 1;
      ids.add(randomId);
    }
    return Array.from(ids);
  }
}
