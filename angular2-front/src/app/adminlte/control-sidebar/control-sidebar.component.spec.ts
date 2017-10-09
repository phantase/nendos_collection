import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminLTEControlSidebarComponent } from './control-sidebar.component';

describe('AdminLTEControlSidebarComponent', () => {
  let component: AdminLTEControlSidebarComponent;
  let fixture: ComponentFixture<AdminLTEControlSidebarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AdminLTEControlSidebarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AdminLTEControlSidebarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
