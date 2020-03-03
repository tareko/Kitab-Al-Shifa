import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Shift } from "./shift.model";
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class ShiftsService {
  private shifts: Shift[] = [];
  private shiftsUpdated = new Subject<Shift[]>();

  constructor (private http: HttpClient) {}

  getShifts() {
    this.http.get<{message: string, shifts: Shift[] }>
    ('http://localhost:3000/api/shifts')
    .subscribe((shiftData) => {
      this.shifts = shiftData.shifts;
      this.shiftsUpdated.next([...this.shifts]);
    });
  }

  getShiftUpdateListener() {
    return this.shiftsUpdated.asObservable();
  }

  addShift(user_id: number, date: string, shifts_type_id: number) {
    const shift: Shift = {_id: null, user_id: user_id, date: date, shifts_type_id: shifts_type_id};
    this.http.post<{ message: string, shiftId: string }>('http://localhost:3000/api/shifts', shift)
    .subscribe((responseData) => {
      console.log(responseData.message);
      var shiftId = responseData.shiftId;
      shift._id = shiftId;
      this.shifts.push(shift);
      this.shiftsUpdated.next([...this.shifts]);
    })
  }

  /**
  Delete shifts
  */
  deleteShift(shiftId: string) {
    this.http.delete('http://localhost:3000/api/shifts/' + shiftId)
    .subscribe(() => {
      console.log("Shift " + shiftId + " deleted.");
      const updatedShifts = this.shifts.filter(shift => shift._id !== shiftId);
      this.shifts = updatedShifts;
      this.shiftsUpdated.next([...this.shifts]);
    });
  }
}
