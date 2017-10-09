import { AppRoutingModule } from './app-routing/app-routing.module';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';

import { AdminLTEHeaderComponent } from './adminlte/header/header.component';
import { AdminLTEFooterComponent } from './adminlte/footer/footer.component';
import { AdminLTELeftSideComponent } from './adminlte/left-side/left-side.component';
import { AdminLTEControlSidebarComponent } from './adminlte/control-sidebar/control-sidebar.component';

import { HomepageComponent } from './pages/homepage/homepage.component';

@NgModule({
  declarations: [
    AppComponent,
    AdminLTEHeaderComponent,
    AdminLTEFooterComponent,
    AdminLTELeftSideComponent,
    AdminLTEControlSidebarComponent,
    HomepageComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
