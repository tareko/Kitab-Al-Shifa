import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { ShiftCreateComponent } from './shifts/shift-create/shift-create.component';
import { ShiftListComponent } from './shifts/shift-list/shift-list.component';
import { OncallCreateComponent } from './oncall/oncall-create/oncall-create.component';
import { OncallListComponent } from './oncall/oncall-list/oncall-list.component';
import { LoginComponent } from './auth/login/login.component';

// Angular Material modules
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatSliderModule } from '@angular/material/slider';
import { MatMenuModule } from '@angular/material/menu';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatCardModule } from '@angular/material/card';
import { MatButtonModule } from '@angular/material/button';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatExpansionModule } from '@angular/material/expansion';
import { MatSidenavModule } from '@angular/material/sidenav';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatNativeDateModule } from '@angular/material/core';

@NgModule({
  declarations: [
    AppComponent,
    ShiftCreateComponent,
    HeaderComponent,
    ShiftListComponent,
    LoginComponent,
    OncallListComponent,
    OncallCreateComponent,
  ],
  imports: [
    // Angular Material modules
    MatMenuModule,
    MatIconModule,
    MatSliderModule,
    MatInputModule,
    MatCardModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatToolbarModule,
    MatExpansionModule,
    MatSidenavModule,
    MatProgressSpinnerModule,
    MatPaginatorModule,
    MatAutocompleteModule,
    MatSnackBarModule,
    MatDatepickerModule,
    MatNativeDateModule,

    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
  ],
  providers: [
    MatDatepickerModule,
],
  bootstrap: [AppComponent]
})
export class AppModule { }
