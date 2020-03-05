import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { ShiftsService } from "../shifts.service";
import { ActivatedRoute, ParamMap } from "@angular/router";
import { Shift } from '../shift.model';

@Component({
  selector: 'app-shift-create',
  templateUrl: './shift-create.component.html',
  styleUrls: ['./shift-create.component.sass']
})

export class ShiftCreateComponent implements OnInit {
  newShift = '';
  shift: Shift;
  private mode = 'create';
  private shiftId: string;

  constructor(
    public shiftsService: ShiftsService,
    public route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paramMap: ParamMap) => {
      if (paramMap.has('shiftId')) {
        this.mode = 'edit';
        this.shiftId = paramMap.get('shiftId');
        this.shift = this.shiftsService.getShift(this.shiftId);
      } else {
        this.mode = 'create';
        this.shiftId = null;
      }
    });
  }

  onShiftSave(form: NgForm) {
    if (form.invalid) {
      return;
    }

    if (this.mode === 'create') {
      this.shiftsService.addShift(form.value.user_id, form.value.date, form.value.shifts_type_id);
    } else {
      this.shiftsService.updateShift(this.shiftId, form.value.user_id, form.value.date, form.value.shifts_type_id)
    }

    form.resetForm();
  }
}
