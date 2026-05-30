import { Component, computed, inject, OnInit, signal, WritableSignal } from '@angular/core';
import { RouterLink } from '@angular/router';

import { PokemonListItem } from '../../models/pokemon-list-response.model';
import { PokemonService } from '../../services/pokemon.service';

interface ListEntry {
  id: number;
  name: string;
}

@Component({
  selector: 'app-pokemon-list',
  imports: [RouterLink],
  templateUrl: './pokemon-list.component.html',
  styleUrl: './pokemon-list.component.scss'
})
export class PokemonListComponent implements OnInit {
  private readonly pokemonService: PokemonService = inject(PokemonService);

  protected readonly entries: WritableSignal<ListEntry[]> = signal<ListEntry[]>([]);
  protected readonly loading: WritableSignal<boolean> = signal<boolean>(true);
  protected readonly errorMessage: WritableSignal<string> = signal<string>('');
  protected readonly currentPage: WritableSignal<number> = signal<number>(1);
  protected readonly totalCount: WritableSignal<number> = signal<number>(0);

  protected readonly totalPages = computed((): number => {
    const count: number = this.totalCount();
    const pageSize: number = this.pokemonService.getPageSize();
    return Math.ceil(count / pageSize);
  });

  protected readonly pageSize: number = this.pokemonService.getPageSize();

  ngOnInit(): void {
    this.loadPage(1);
  }

  protected goToPage(page: number): void {
    if (page < 1 || page > this.totalPages()) {
      return;
    }
    this.loadPage(page);
  }

  private loadPage(page: number): void {
    this.loading.set(true);
    this.errorMessage.set('');
    const offset: number = (page - 1) * this.pageSize;

    this.pokemonService.getPokemonList(offset).subscribe({
      next: (response): void => {
        const mapped: ListEntry[] = response.results.map(
          (item: PokemonListItem): ListEntry => ({
            id: this.pokemonService.extractIdFromUrl(item.url),
            name: item.name
          })
        );
        this.entries.set(mapped);
        this.totalCount.set(response.count);
        this.currentPage.set(page);
        this.loading.set(false);
      },
      error: (): void => {
        this.errorMessage.set('Error al cargar el listado.');
        this.loading.set(false);
      }
    });
  }
}
