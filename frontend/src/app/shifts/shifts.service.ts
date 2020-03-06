import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from "@angular/router";

import { Shift } from "./shift.model";
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class ShiftsService {
  private shifts: Shift[] = [];
  private shiftsUpdated = new Subject<{ shifts: Shift[], shiftCount: number }>();

  constructor (private http: HttpClient, private router: Router) {}

  // Get all available shifts

  getShifts(pageSize: number, currentPage: number) {
    const queryParams = `?pageSize=${pageSize}&page=${currentPage}`;

    this.http.get<{message: string, shifts: Shift[], shiftCount: number }>
    ('http://localhost:3000/api/shifts' + queryParams)
    .subscribe((shiftData) => {
      this.shifts = shiftData.shifts;
      this.shiftsUpdated.next({
        shifts: [...this.shifts],
        shiftCount: shiftData.shiftCount
      });
    });
  }

  // Get a single shift dictated by String
  getShift(_id: string) {
    return this.http.get<Shift>('http://localhost:3000/api/shifts/' + _id);
  }

  getShiftUpdateListener() {
    return this.shiftsUpdated.asObservable();
  }

  addShift(user_id: number, date: string, shifts_type_id: number) {
      this.router.navigate(["/"]);
  }

  updateShift(_id: string, user_id: number, date: string, shifts_type_id: number) {
    const shift: Shift = {_id: _id, user_id: user_id, date: date, shifts_type_id: shifts_type_id};
    this.http.put('http://localhost:3000/api/shifts/' + _id, shift)
    .subscribe(response => {
      this.router.navigate(["/"]);
    })
  }

  /**
  Delete shifts
  */
  deleteShift(shiftId: string) {
    return this.http.delete('http://localhost:3000/api/shifts/' + shiftId);
  }

}
