import { Component, OnInit, OnDestroy } from '@angular/core';
import {PageEvent} from '@angular/material/paginator';
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
  isLoading = false;
  totalShifts = 0;
  shiftsPerPage = 10;
  currentPage = 1;
  pageSizeOptions = [10, 25, 50];
  private shiftsSub: Subscription;

  constructor(/**
   * shiftsService
   */
  public shiftsService: ShiftsService
  ) { }

  ngOnInit() {
    this.isLoading = true;
    this.shiftsService.getShifts(this.shiftsPerPage, this.currentPage);
    this.shiftsSub = this.shiftsService.getShiftUpdateListener()
      .subscribe((shiftData: { shifts: Shift[], shiftCount: number }) => {
        this.shifts = shiftData.shifts;
        this.totalShifts = shiftData.shiftCount;
        this.isLoading = false;
      });
  }

  ngOnDestroy() {
    this.shiftsSub.unsubscribe();
  }

  onDelete(shiftId: string) {
    this.isLoading = true;
    this.shiftsService.deleteShift(shiftId)
      .subscribe(() => {
        this.shiftsService.getShifts(this.shiftsPerPage, this.currentPage);
      });
  }

  /**
  Function to execute when page changes
  */
  onChangedPage(pageData: PageEvent) {
    this.isLoading = true;
    this.currentPage = pageData.pageIndex + 1;
    this.shiftsPerPage = pageData.pageSize;
    this.shiftsService.getShifts(this.shiftsPerPage, this.currentPage);
  }

}
