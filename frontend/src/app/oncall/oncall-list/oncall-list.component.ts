import { Component, OnInit, OnDestroy } from '@angular/core';
import {PageEvent} from '@angular/material/paginator';
import { Subscription } from 'rxjs';

import { Oncall } from '../oncall.model';
import { OncallsService } from '../oncalls.service';

@Component({
  selector: 'app-oncall-list',
  templateUrl: './oncall-list.component.html',
  styleUrls: ['./oncall-list.component.sass']
})
export class OncallListComponent implements OnInit, OnDestroy {
  // oncalls = [
  //   {title: 'First oncall', content: 'First oncall content'},
  //   {title: 'Oncall 2', content: 'Oncall 2 content'},
  //   {title: 'Oncall 3', content: 'Oncall 3 content'},
  // ]
  oncalls: Oncall[] = [];
  isLoading = false;
  totalOncalls = 0;
  oncallsPerPage = 10;
  currentPage = 1;
  pageSizeOptions = [10, 25, 50];
  private oncallsSub: Subscription;

  constructor(/**
   * oncallsService
   */
  public oncallsService: OncallsService
  ) { }

  ngOnInit() {
    this.isLoading = true;
    this.oncallsService.getOncalls(this.oncallsPerPage, this.currentPage);
    this.oncallsSub = this.oncallsService.getOncallUpdateListener()
      .subscribe((oncallData: { oncalls: Oncall[], oncallCount: number }) => {
        this.oncalls = oncallData.oncalls;
        this.totalOncalls = oncallData.oncallCount;
        this.isLoading = false;
      });
  }

  ngOnDestroy() {
    this.oncallsSub.unsubscribe();
  }

  onDelete(oncallId: string) {
    this.isLoading = true;
    this.oncallsService.deleteOncall(oncallId)
      .subscribe(() => {
        this.oncallsService.getOncalls(this.oncallsPerPage, this.currentPage);
      });
  }

  /**
  Function to execute when page changes
  */
  onChangedPage(pageData: PageEvent) {
    this.isLoading = true;
    this.currentPage = pageData.pageIndex + 1;
    this.oncallsPerPage = pageData.pageSize;
    this.oncallsService.getOncalls(this.oncallsPerPage, this.currentPage);
  }
}
