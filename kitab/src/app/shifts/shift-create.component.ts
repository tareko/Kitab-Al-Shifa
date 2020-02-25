import { Component } from '@angular/core';

@Component({
  selector: 'app-shift-create',
  templateUrl: './shift-create.component.html'
})

export class ShiftCreateComponent {
  newShift = '';
  shiftInput = '';
  onShiftCreate() {
    alert('Shift created');
    this.newShift = this.shiftInput;
  }
}
