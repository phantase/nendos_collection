import { TestBed, async } from '@angular/core/testing';

import { RouterTestingModule } from '@angular/router/testing';

import { AppComponent } from './app.component';
import { AdminLTEHeaderComponent } from './adminlte/header/header.component';
import { AdminLTEFooterComponent } from './adminlte/footer/footer.component';
import { AdminLTELeftSideComponent } from './adminlte/left-side/left-side.component';
import { AdminLTEControlSidebarComponent } from './adminlte/control-sidebar/control-sidebar.component';

describe('AppComponent', () => {
  beforeEach(async(() => {
    TestBed.configureTestingModule({
      imports: [
        RouterTestingModule
      ],
      declarations: [
        AppComponent,
        AdminLTEHeaderComponent,
        AdminLTEFooterComponent,
        AdminLTELeftSideComponent,
        AdminLTEControlSidebarComponent
      ],
    }).compileComponents();
  }));

  it('should create the app', async(() => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.debugElement.componentInstance;
    expect(app).toBeTruthy();
  }));
});
