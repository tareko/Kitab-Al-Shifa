import { Component, OnInit, Input } from '@angular/core';
import { Shift } from '../shift.model';

@Component({
  selector: 'app-shift-list',
  templateUrl: './shift-list.component.html',
  styleUrls: ['./shift-list.component.sass']
})
export class ShiftListComponent implements OnInit {
  // shifts = [
  //   {title: 'First shift', content: 'First shift content'},
  //   {title: 'Shift 2', content: 'Shift 2 content'},
  //   {title: 'Shift 3', content: 'Shift 3 content'},
  // ]
  @Input() shifts: Shift[] = [];

  constructor() { }

  ngOnInit(): void {
  }

}
