package ph.sukelco.service.power.staff.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.os.Bundle;
import android.view.View;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import ph.sukelco.service.power.staff.app.Dashboard;
import ph.sukelco.service.power.staff.app.MainActivity;
import ph.sukelco.service.power.staff.app.R;

public class Announcement_Webview extends AppCompatActivity {
    //Initialize and declare variables
    DrawerLayout drawerLayout;
    WebView view;
    SwipeRefreshLayout mySwipeRefreshLayout;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_announcement_webview);

        //hide actionBar
        getSupportActionBar().hide();

        //Assign variables
        drawerLayout = findViewById(R.id.drawer_layout);


        //webView rendering stuff
        Toast.makeText(getApplicationContext(), "Swipe down to refresh", Toast.LENGTH_SHORT).show();
        mySwipeRefreshLayout = (SwipeRefreshLayout) findViewById(R.id.swipeAnnouncement);
        String url = "http://www.sukelco.com.ph/index.php/announcements/";
        view = (WebView) findViewById(R.id.renderAnnouncement);
        //SECURITY WARNING: Enable javaScripts you trust
        view.getSettings().setJavaScriptEnabled(true);
        //Set-up the webClient
        view.setWebViewClient(new WebViewClient());
        view.loadUrl(url);
        //swipe down to refresh
        mySwipeRefreshLayout.setOnRefreshListener(
                new SwipeRefreshLayout.OnRefreshListener() {
                    @Override
                    public void onRefresh() {
                        view.reload();
                    }
                }
        );
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
        //recreate activity (announcement only)
        recreate();
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
        //redirect activity to about us
        MainActivity.redirectActivity(this,AboutUs.class);
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