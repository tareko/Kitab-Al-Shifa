import { Component } from '@angular/core';
import { Shift } from './shifts/shift.model';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {
  storedShifts: Shift[] = [];

  onShiftAdded(shift) {
    this.storedShifts.push(shift);
  }
}
