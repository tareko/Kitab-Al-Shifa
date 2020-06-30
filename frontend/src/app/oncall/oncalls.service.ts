import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from "@angular/router";

import { Oncall } from "./oncall.model";
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class OncallsService {
  private oncalls: Oncall[] = [];
  private oncallsUpdated = new Subject<{ oncalls: Oncall[], oncallCount: number }>();

  constructor (private http: HttpClient, private router: Router) {}

  // Get all available Oncall shifts

  getOncalls(pageSize: number, currentPage: number) {
    const queryParams = `?pageSize=${pageSize}&page=${currentPage}`;

    this.http.get<{message: string, oncalls: Oncall[], oncallCount: number }>
    ('http://localhost:3000/api/oncalls' + queryParams)
    .subscribe((oncallData) => {
      this.oncalls = oncallData.oncalls;
      this.oncallsUpdated.next({
        oncalls: [...this.oncalls],
        oncallCount: oncallData.oncallCount
      });
    });
  }

  // Get a single Oncall shift dictated by String
  getOncall(_id: string) {
    return this.http.get<Oncall>('http://localhost:3000/api/oncalls/' + _id);
  }

  getOncallUpdateListener() {
    return this.oncallsUpdated.asObservable();
  }

  addOncall(user_name: string, date: string, shift_start_time: string, message: string) {
    const oncall: Oncall = {user_name: user_name, date: date, shift_start_time: shift_start_time, message: message};
    this.http.post('http://localhost:3000/api/oncalls', oncall)
    .subscribe(response => {
      this.router.navigate(["/"]);
    })
  }

  updateOncall(_id: string, user_name: string, date: string, shift_start_time: string, message: string) {
    const oncall: Oncall = {_id: _id, user_name: user_name, date: date, shift_start_time: shift_start_time, message: message};
    this.http.put('http://localhost:3000/api/oncalls/' + _id, oncall)
    .subscribe(response => {
      this.router.navigate(["/"]);
    })
  }

  /**
  Delete Oncall shifts
  */
  deleteOncall(oncallId: string) {
    return this.http.delete('http://localhost:3000/api/oncalls/' + oncallId);
  }
}
