import { Component, OnInit, OnDestroy } from '@angular/core';
import { Subscription } from 'rxjs';

import { Shift } from '../shift.model';
import { ShiftsService } from '../shifts.service';

@Component({
  selector: 'app-shift-list',
  templateUrl: './shift-list.component.html',
  styleUrls: ['./shift-list.component.sass']
})
export class ShiftListComponent implements OnInit, OnDestroy {
  // shifts = [
  //   {title: 'First shift', content: 'First shift content'},
  //   {title: 'Shift 2', content: 'Shift 2 content'},
  //   {title: 'Shift 3', content: 'Shift 3 content'},
  // ]
  shifts: Shift[] = [];
  private shiftsSub: Subscription;

  constructor(/**
   * shiftsService
   */
  public shiftsService: ShiftsService
  ) { }

  ngOnInit() {
    this.shiftsService.getShifts();
    this.shiftsSub = this.shiftsService.getShiftUpdateListener()
      .subscribe((shifts: Shift[]) => {
        this.shifts = shifts;
      });
  }

  ngOnDestroy() {
    this.shiftsSub.unsubscribe();
  }

  onDelete(shiftId: string) {
    this.shiftsService.deleteShift(shiftId);
  }

}
