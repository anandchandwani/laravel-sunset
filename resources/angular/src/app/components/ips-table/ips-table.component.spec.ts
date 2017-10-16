import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IpsTableComponent } from './ips-table.component';

describe('IpsTableComponent', () => {
  let component: IpsTableComponent;
  let fixture: ComponentFixture<IpsTableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IpsTableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IpsTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
