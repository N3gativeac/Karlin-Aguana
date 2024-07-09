package ph.sukelco.service.power.staff.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.media.AudioMetadataMap;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    //Initialize and declare variables
    DrawerLayout drawerLayout;
    ImageButton PersonalInfo, Announcements, PowerAdvisories, LogOut;
    TextView UserNameMainAct;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //hide actionBar
        getSupportActionBar().hide();

        //if the user is not logged in
        //start the login activity

        checkLogin();

        //getting the current user
        User user = SharedPrefManager.getInstance(this).getUser();

        //Map and assign variables
        UserNameMainAct = findViewById(R.id.textViewMAUserName);
        drawerLayout = findViewById(R.id.drawer_layout);
        PersonalInfo = findViewById(R.id.imageButtonPersonalInfo);
        Announcements = findViewById(R.id.imageButtonAnnouncements);
        PowerAdvisories = findViewById(R.id.imageButtonPowerAdvisories);
        LogOut = findViewById(R.id.imageButtonLogout);

        String mainActUserName = user.getUsername();
        UserNameMainAct.setText(mainActUserName);

        PersonalInfo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MainActivity.this, Dashboard.class);
                startActivity(intent);
            }
        });
        Announcements.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MainActivity.this, Announcement_Webview.class);
                startActivity(intent);
            }
        });
        PowerAdvisories.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(MainActivity.this, PowerAdvisory_Webview.class);
                startActivity(intent);
            }
        });
        LogOut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                logout(MainActivity.this);
            }
        });

    }
    public void ClickMenu (View view){
        //Open navigation drawer
        openDrawer(drawerLayout);
    }

    public static void openDrawer(DrawerLayout drawerLayout) {
        //open drawerLayout
        drawerLayout.openDrawer(GravityCompat.START);
    }

    public void ClickLogo (View view){
        //close the navigation drawer after pressing the logo
        closeDrawer(drawerLayout);
    }

    public static void closeDrawer(DrawerLayout drawerLayout) {
        //close drawerLayout
        //conditional statement
        if (drawerLayout.isDrawerOpen(GravityCompat.START)){
            //when drawer is open,
            // close it (Grumpy cat reference)
            drawerLayout.closeDrawer(GravityCompat.START);
        }
    }

    public void ClickHome(View view){
        //Recreate activity (home activity only)
        recreate();
    }

    public void ClickDashboard(View view){
        //Redirect activity to dashboard
        redirectActivity(this,Dashboard.class);
    }

    public void ClickAnnouncementWebView(View view){
        //Redirect activity to announcements
        redirectActivity(this,Announcement_Webview.class);
    }

    public void ClickPowerAdvisoryWebView(View view){
        //Redirect activity to power advisory
        redirectActivity(this,PowerAdvisory_Webview.class);
    }

    public void ClickMeteringUpdate(View view){
        //Redirect activity to metering update
        redirectActivity(this, MeteringUpdate.class);
    }

    public void ClickAboutUs(View view){
        //Redirect activity to about us
        redirectActivity(this,AboutUs.class);
    }

    public void ClickLogout(View view){
        //close application
        logout(this);
    }

    public static void logout(Activity activity) {
        //Initialize alert dialog
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);
        //set the dialog title
        builder.setTitle("Logout");
        //set the dialog message
        builder.setMessage("Are you sure you want to logout?");
        //if user selected a positive option (like yes)
        builder.setPositiveButton("YES", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                //finish activity
                activity.finishAffinity();
                SharedPrefManager.getInstance(activity.getBaseContext()).logout();
            }
        });
        //if user selected a negative option (like no)
        builder.setNegativeButton("NO", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                //dismiss this dialog
                dialogInterface.dismiss();
            }
        });
        //show the dialog box
        builder.show();

    }

    public static void redirectActivity(Activity activity, Class aClass) {
        //Prepare and initialize intent
        Intent intent = new Intent(activity,aClass);
        //Set the intent flags
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        //start the activity
        activity.startActivity(intent);
    }

    @Override
    protected void onPause() {
        super.onPause();
        //close drawer
        closeDrawer(drawerLayout);
    }

    protected void checkLogin() {
        if (!SharedPrefManager.getInstance(this).isLoggedIn()) {
            finish();
            startActivity(new Intent(this, login_activity.class));
        }
    }
}