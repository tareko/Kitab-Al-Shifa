import { Injectable } from '@angular/core';
import { Shift } from "./shift.model";
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class ShiftsService {
  private shifts: Shift[] = [];
  private shiftsUpdated = new Subject<Shift[]>();

  getShifts() {
    return [...this.shifts];
  }

  getShiftUpdateListener() {
    return this.shiftsUpdated.asObservable();
  }

  addShift(id: number, user_id: number) {
    const shift: Shift = {id: id, user_id: user_id};
    this.shifts.push(shift);
    this.shiftsUpdated.next([...this.shifts]);
  }
  constructor() { }
}
