import { Component } from '@angular/core';
import { NgForm } from '@angular/forms';
import { ShiftsService } from "../shifts.service";

@Component({
  selector: 'app-shift-create',
  templateUrl: './shift-create.component.html',
  styleUrls: ['./shift-create.component.sass']
})

export class ShiftCreateComponent {
  newShift = '';
   enteredId = 0;
   enteredUser_id = 0;

  constructor(/**
   * shiftsService: ShiftsService

   */
  public shiftsService: ShiftsService
) { }

  onShiftCreate(form: NgForm) {
    if (form.invalid) {
      return;
    }

    this.shiftsService.addShift(form.value.id, form.value.user_id);
    form.resetForm();
  }
}
