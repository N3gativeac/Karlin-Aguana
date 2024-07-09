package ph.sukelco.service.power.staff.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.os.Bundle;
import android.view.View;

public class AboutUs extends AppCompatActivity {
    //Initialize and declare variables
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_about_us);

        //hide actionBar
        getSupportActionBar().hide();

        //Assign variables
        drawerLayout = findViewById(R.id.drawer_layout);
    }

    public void ClickMenu(View view){
        //open drawer
        MainActivity.openDrawer(drawerLayout);
    }

    public void ClickLogo(View view){
        //close drawer
        MainActivity.closeDrawer(drawerLayout);
    }

    public void ClickHome(View view){
        //redirect activity to home
        MainActivity.redirectActivity(this,MainActivity.class);
    }

    public void ClickDashboard(View view){
        //redirect activity to dashboard
        MainActivity.redirectActivity(this, Dashboard.class);
    }

    public void ClickAnnouncementWebView(View view){
        //redirect activity to announcements
        MainActivity.redirectActivity(this,Announcement_Webview.class);
    }

    public void ClickPowerAdvisoryWebView(View view){
        //redirect activity to power advisory
        MainActivity.redirectActivity(this,PowerAdvisory_Webview.class);
    }

    public void ClickMeteringUpdate(View view){
        //redirect activity to metering update
        MainActivity.redirectActivity(this,MeteringUpdate.class);
    }

    public void ClickAboutUs(View view){
        //recreate activity (about us only)
        recreate();
    }

    public void ClickLogout(View view){
        //close application
        MainActivity.logout(this);
    }

    @Override
    protected void onPause() {
        super.onPause();
        MainActivity.closeDrawer(drawerLayout);
    }
}