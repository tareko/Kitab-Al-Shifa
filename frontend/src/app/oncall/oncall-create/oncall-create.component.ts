import { Component, OnInit } from '@angular/core';
import { NgForm, FormGroup, FormControl, FormBuilder, Validators, AbstractControl, ValidatorFn, FormGroupDirective } from '@angular/forms';
import { ActivatedRoute, ParamMap } from "@angular/router";
import { HttpClient, HttpResponse } from '@angular/common/http';
import {MatSnackBar} from '@angular/material/snack-bar';

import { OncallsService } from "../oncalls.service";
import { Oncall } from '../oncall.model';
import { Users, User } from '../../users/user.model';
import { ServerResponse } from '../../app.interface';

import { Observable, observable, BehaviorSubject, of } from 'rxjs';
import { debounceTime, distinctUntilChanged, filter, map, switchMap, startWith, catchError } from 'rxjs/operators';

@Component({
  selector: 'app-oncall-create',
  templateUrl: './oncall-create.component.html',
  styleUrls: ['./oncall-create.component.sass']
})

export class OncallCreateComponent implements OnInit {

  oncall: Oncall;
  oncallFormGroup: FormGroup;
  isLoading = false;
  private mode = 'create';
  private oncallId: string;

  // Set some options for the autocompleted physician list
  filteredOptions: Observable<string[]>;
  userName: FormControl = new FormControl();
  options: string[] = [];

  constructor(
    public oncallsService: OncallsService,
    public route: ActivatedRoute,
    private http: HttpClient,
    private fb: FormBuilder,
    private _snackBar: MatSnackBar
  ) {

    // Initialize form

    this.oncallFormGroup = new FormGroup({
      userName: new FormControl('',[Validators.required,this.forbiddenNamesValidator(this.options)]),
      date: new FormControl(),
      shiftStartTime: new FormControl(),
      message: new FormControl()
    });

    // Set validator for autocomplete names
    this.userName.setValidators(this.forbiddenNamesValidator(this.options));
  }

  ngOnInit() {
    this.route.paramMap.subscribe((paramMap: ParamMap) => {
      if (paramMap.has('oncallId')) {
        this.mode = 'edit';
        this.oncallId = paramMap.get('oncallId');
        this.isLoading = true;
        this.oncallsService.getOncall(this.oncallId)
          .subscribe(oncallData => {
            console.log(this.oncallFormGroup);
            this.oncallFormGroup.setValue({
              userName: oncallData.user_name,
              date: oncallData.date,
              shiftStartTime: oncallData.shift_start_time,
              message: oncallData.message
            });
            this.userName.setErrors(null);
          });
        this.isLoading = false;
      } else {
        this.mode = 'create';
        this.isLoading = false;
        this.oncallId = null;
      }
    });

    // Get list of physicians one time (won't change much)
    // Set this list in the callback to be our 'options' array
    this.http
      .get('http://localhost:3000/api/users', {
        observe: 'body',
        // params: {
        //   q: 'a',
        // }
      })
    .subscribe((data:any) => {
      var count = 0;
      for(let user of data) {
        // console.log(user);
        // this.options.push({ key : count, value: user.name });
        this.options.push(user.name);
        count++;
      }
      console.log(this.options)

    }
  );

  // Autocomplete

    this.filteredOptions = this.userName.valueChanges
          .pipe(
            debounceTime(300),
            startWith(''),
            map(value => this._filter(value))
          );
  }

  onOncallSave(formData: any, formDirective: FormGroupDirective) {
    if (this.oncallFormGroup.value.invalid) {
      return;
    }
    this.isLoading = true;
    if (this.mode === 'create') {
      this.oncallsService.addOncall(this.userName.value, this.oncallFormGroup.value.date, this.oncallFormGroup.value.shiftStartTime, this.oncallFormGroup.value.message);
    } else {
      this.oncallsService.updateOncall(this.oncallId, this.oncallFormGroup.value.userName, this.oncallFormGroup.value.date, this.oncallFormGroup.value.shiftStartTime, this.oncallFormGroup.value.message)
    }
    this.isLoading = false;

    // reset the errors of all the controls
    for (let name in this.oncallFormGroup.controls) {
      this.oncallFormGroup.controls[name].reset();
      this.oncallFormGroup.controls[name].markAsPristine();
      this.oncallFormGroup.controls[name].markAsUntouched();
      this.oncallFormGroup.controls[name].updateValueAndValidity();

      // this.oncallFormGroup.controls[name].setErrors(null);
    }
    this.userName.reset();

    // reset the form
    this.oncallFormGroup.reset();
    formDirective.resetForm();
    // this.oncallFormGroup.markAsPristine();
    // this.oncallFormGroup.markAsUntouched();
    // this.oncallFormGroup.updateValueAndValidity();
  }

  // Filter function called from autocomplete
  private _filter(value: string): string[] {
    if (value) {
      var filterValue = value.toString().toLowerCase();
    }
    else { var filterValue = '' }

    return this.options.filter(option => option.toLowerCase().includes(filterValue));
  }

  // Forbid names that are not in the options list from being selected
  private forbiddenNamesValidator(names: string[]): ValidatorFn {
    return (control: AbstractControl): { [key: string]: any } | null => {
      // below findIndex will check if control.value is equal to one of our options or not
      const index = names.findIndex(name => {
        return (new RegExp('\^' + name + '\$')).test(control.value);
      });
      return index < 0 ? { 'forbiddenNames': { value: control.value } } : null;
    };
  }


  // Debug function
  log(val) { console.log("test" + JSON.stringify(val)); }

  public findInvalidControls() {
      const invalid = [];
      const controls = this.oncallFormGroup.controls;
      for (const name in controls) {
          if (controls[name].invalid) {
              invalid.push(name);
          }
      }
      return invalid;
  }

  // Open snackbar to acknowledge submission
  openSnackBar(message: string, action: string) {
    this._snackBar.open(message, action, {
      duration: 10000,
    });
  }
}
