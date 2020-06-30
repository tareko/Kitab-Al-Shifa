import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ShiftListComponent } from './shifts/shift-list/shift-list.component';
import { ShiftCreateComponent } from './shifts/shift-create/shift-create.component';
import { OncallListComponent } from './oncall/oncall-list/oncall-list.component';
import { OncallCreateComponent } from './oncall/oncall-create/oncall-create.component';


const routes: Routes = [
  { path: '', component: ShiftListComponent },
  { path: 'shifts', component: ShiftListComponent },
  { path: 'shifts/list', component: ShiftListComponent },
  { path: 'shifts/create', component: ShiftCreateComponent },
  { path: 'shifts/edit/:shiftId', component: ShiftCreateComponent },
  { path: 'oncall/list', component: OncallListComponent },
  { path: 'oncall', component: OncallListComponent },
  { path: 'oncall/create', component: OncallCreateComponent },
  { path: 'oncall/edit/:oncallId', component: OncallCreateComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
