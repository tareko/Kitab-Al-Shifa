import { TestBed } from '@angular/core/testing';

import { OncallsService } from './oncalls.service';

describe('OncallsService', () => {
  let service: OncallsService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(OncallsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
