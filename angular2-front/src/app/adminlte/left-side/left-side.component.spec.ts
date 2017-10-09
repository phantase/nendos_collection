import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminLTELeftSideComponent } from './left-side.component';

describe('AdminLTELeftSideComponent', () => {
  let component: AdminLTELeftSideComponent;
  let fixture: ComponentFixture<AdminLTELeftSideComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AdminLTELeftSideComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AdminLTELeftSideComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
