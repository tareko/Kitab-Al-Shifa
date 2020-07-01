import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from "@angular/router";
import {MatSnackBar} from '@angular/material/snack-bar';

import { Oncall } from "./oncall.model";
import { Subject } from 'rxjs';

var Config = {backendServer: 'http://localhost:3000'};


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
    (Config.backendServer + '/api/oncalls' + queryParams)
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
    return this.http.get<Oncall>(Config.backendServer + '/api/oncalls/' + _id);
  }

  getOncallUpdateListener() {
    return this.oncallsUpdated.asObservable();
  }

  addOncall(user_name: string, date: string, shift_start_time: string, message: string) {
    const oncall: Oncall = {user_name: user_name, date: date, shift_start_time: shift_start_time, message: message};
    this.http.post(Config.backendServer + '/api/oncalls', oncall)
    .subscribe(response => {
      // this._snackBar.openFromComponent(PizzaPartyComponent, {
      //     duration: this.durationInSeconds * 1000,
      //   });
      this.router.navigate(["/oncall"]);
    })
  }

  updateOncall(_id: string, user_name: string, date: string, shift_start_time: string, message: string) {
    const oncall: Oncall = {_id: _id, user_name: user_name, date: date, shift_start_time: shift_start_time, message: message};
    this.http.put(Config.backendServer + '/api/oncalls/' + _id, oncall)
    .subscribe(response => {
      this.router.navigate(["/oncall"]);
    })
  }

  /**
  Delete Oncall shifts
  */
  deleteOncall(oncallId: string) {
    return this.http.delete(Config.backendServer + '/api/oncalls/' + oncallId);
  }
}
