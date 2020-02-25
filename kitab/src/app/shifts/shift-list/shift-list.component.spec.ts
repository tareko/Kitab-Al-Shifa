import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ShiftListComponent } from './shift-list.component';

describe('ShiftListComponent', () => {
  let component: ShiftListComponent;
  let fixture: ComponentFixture<ShiftListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShiftListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ShiftListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
