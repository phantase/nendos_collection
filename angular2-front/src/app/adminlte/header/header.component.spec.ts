import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';

import { AdminLTEHeaderComponent } from './header.component';

describe('AdminLTEHeaderComponent', () => {
  let component: AdminLTEHeaderComponent;
  let fixture: ComponentFixture<AdminLTEHeaderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AdminLTEHeaderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AdminLTEHeaderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });

  it('should have a logo-mini with Ndb', () => {
    expect(fixture.debugElement.query(By.css('.logo-mini')).nativeElement.textContent).toContain('Ndb');
  })
  it('should have a logo-lg with Nendoroids db', () => {
    expect(fixture.debugElement.query(By.css('.logo-lg')).nativeElement.textContent).toContain('Nendoroids db');
  })
});
