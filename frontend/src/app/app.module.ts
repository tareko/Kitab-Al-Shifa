import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { ShiftCreateComponent } from './shifts/shift-create/shift-create.component';
import { ShiftListComponent } from './shifts/shift-list/shift-list.component';
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
import {MatPaginatorModule} from '@angular/material/paginator';

@NgModule({
  declarations: [
    AppComponent,
    ShiftCreateComponent,
    HeaderComponent,
    ShiftListComponent,
    LoginComponent,
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

    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
