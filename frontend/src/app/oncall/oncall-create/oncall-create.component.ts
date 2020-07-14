import { Component, OnInit } from '@angular/core';
import { NgForm, FormGroup, FormControl, FormBuilder } from '@angular/forms';
import { ActivatedRoute, ParamMap } from "@angular/router";
import { HttpClient } from '@angular/common/http';

import { OncallsService } from "../oncalls.service";
import { Oncall } from '../oncall.model';
import { User } from '../../users/user.model';

import { Observable, BehaviorSubject } from 'rxjs';
import { debounceTime, distinctUntilChanged, filter, map, switchMap, startWith } from 'rxjs/operators';

@Component({
  selector: 'app-oncall-create',
  templateUrl: './oncall-create.component.html',
  styleUrls: ['./oncall-create.component.sass']
})

export class OncallCreateComponent implements OnInit {
  // Initialize form
  oncallFormGroup = this.fb.group({
    userName: [''],
    date: [''],
    shiftStartTime: [''],
    message: ['']
  });

  oncall: Oncall;
  isLoading = false;
  private mode = 'create';
  private oncallId: string;

  /* TODO: Typeahead work
  myControl = new FormControl();
  options: string[] = ['One', 'Two', 'Three'];
  filteredOptions: Observable<string[]>;
  */

  constructor(
    public oncallsService: OncallsService,
    public route: ActivatedRoute,
    private httpClient: HttpClient,
    private fb: FormBuilder,
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paramMap: ParamMap) => {
      if (paramMap.has('oncallId')) {
        this.mode = 'edit';
        this.oncallId = paramMap.get('oncallId');
        this.isLoading = true;
        this.oncallsService.getOncall(this.oncallId)
          .subscribe(oncallData => {
            console.log(oncallData);
            this.oncallFormGroup.setValue({
              userName: oncallData.user_name,
              date: oncallData.date,
              shiftStartTime: oncallData.shift_start_time,
              message: oncallData.message

            })
          });
        this.isLoading = false;
      } else {
        this.mode = 'create';
        this.isLoading = false;
        this.oncallId = null;
      }
    });

    /* TODO: Typeahead work

    // Filter autocomplete for names
    this.filteredOptions = this.myControl.valueChanges
      .pipe(
        startWith(''),
        map(value => this._filter(value))
      );
    */

  }

  onOncallSave() {
    if (this.oncallFormGroup.value.invalid) {
      return;
    }
    this.isLoading = true;
    if (this.mode === 'create') {
      this.oncallsService.addOncall(this.oncallFormGroup.value.userName, this.oncallFormGroup.value.date, this.oncallFormGroup.value.shiftStartTime, this.oncallFormGroup.value.message);
    } else {
      this.oncallsService.updateOncall(this.oncallId, this.oncallFormGroup.value.userName, this.oncallFormGroup.value.date, this.oncallFormGroup.value.shiftStartTime, this.oncallFormGroup.value.message)
    }
    this.isLoading = false;

    // reset the form
    this.oncallFormGroup.reset();

    // reset the errors of all the controls
    for (let name in this.oncallFormGroup.controls) {
      this.oncallFormGroup.controls[name].setErrors(null);
    }
  }

  /* TODO: Typeahead work

  colorSearchTextInput = new FormControl();

  searchColor$ = new BehaviorSubject<string>('');

  colors$: Observable<string[]> = this.searchColor$.pipe(
    debounceTime(500),
    switchMap(searchColorText => {
      return this.httpClient
//        .get<User[]>('https://kitab.emlondon.ca/users/listUsers.json?full=1&term=' + searchColorText);
       .get<User[]>('http://localhost:4250/colors?name_like=' + searchColorText);
    }),
    map((colors: User[]) => colors.map(color => color.name)),
  );

  // Filter values
  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.options.filter(option => option.toLowerCase().includes(filterValue));
  }

  doColorSearch() {
    this.searchColor$.next(this.colorSearchTextInput.value);
  }
  */
}
