import { Routes } from '@angular/router';

import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { PokemonListComponent } from './pages/pokemon-list/pokemon-list.component';
import { PokemonDetailComponent } from './pages/pokemon-detail/pokemon-detail.component';

export const routes: Routes = [
  { path: '', component: DashboardComponent },
  { path: 'lista', component: PokemonListComponent },
  { path: 'pokemon/:idOrName', component: PokemonDetailComponent },
  { path: '**', redirectTo: '' }
];
