import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ShiftListComponent } from './shifts/shift-list/shift-list.component';
import { ShiftCreateComponent } from './shifts/shift-create/shift-create.component';


const routes: Routes = [
  { path: '', component: ShiftListComponent },
  { path: 'create', component: ShiftCreateComponent },
  { path: 'edit/:shiftId', component: ShiftCreateComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
