import { Component, EventEmitter, Output } from '@angular/core';
import { Shift } from '../shift.model';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-shift-create',
  templateUrl: './shift-create.component.html',
  styleUrls: ['./shift-create.component.sass']
})

export class ShiftCreateComponent {
  newShift = '';
   enteredId = 0;
   enteredUser_id = 0;
  @Output() shiftCreated = new EventEmitter<Shift>();

  onShiftCreate(form: NgForm) {
    if (form.invalid) {
      return;
    }
    const shift: Shift = {
      id: form.value.id,
      user_id: form.value.user_id
    }
    this.shiftCreated.emit(shift);
  }
}
