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

  constructor(/**
   * shiftsService: ShiftsService

   */
  public shiftsService: ShiftsService
) { }

  onShiftCreate(form: NgForm) {
    if (form.invalid) {
      return;
    }

    this.shiftsService.addShift(form.value.user_id, form.value.date, form.value.shifts_type_id);
    form.resetForm();
  }
}
