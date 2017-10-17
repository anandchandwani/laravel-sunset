import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DarktableComponent } from './darktable.component';

describe('DarktableComponent', () => {
  let component: DarktableComponent;
  let fixture: ComponentFixture<DarktableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DarktableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DarktableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
