import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminLTEFooterComponent } from './footer.component';

describe('AdminLTEFooterComponent', () => {
  let component: AdminLTEFooterComponent;
  let fixture: ComponentFixture<AdminLTEFooterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AdminLTEFooterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AdminLTEFooterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
