package ph.sukelco.service.power.staff.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import org.w3c.dom.Text;

public class Dashboard extends AppCompatActivity {
    //Initialize and declare variables
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        //hide actionBar
        getSupportActionBar().hide();

        //Assign variable(s)
        drawerLayout = findViewById(R.id.drawer_layout);

        //map textViews
        TextView Username, FullName, BirthDate, Sex, Position, LineOfWork;
        //parse textViews
        Username = findViewById(R.id.textViewDashboardUsername);
        FullName = findViewById(R.id.textViewDashBoardFullName);
        BirthDate = findViewById(R.id.textViewBirthdate);
        Sex = findViewById(R.id.textViewDashboardSex);
        Position = findViewById(R.id.textViewDashboardPosition);
        LineOfWork = findViewById(R.id.textViewDashboardLineOfWork);
        //getting the current user
        User user = SharedPrefManager.getInstance(this).getUser();
        //set values to textViews
        Username.setText(user.getUsername());
        FullName.setText(user.getFullName());
        BirthDate.setText(user.getBirthdate());
        Sex.setText(user.getSex());
        Position.setText(user.getPosition());
        LineOfWork.setText(user.getLineOfWork());
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
        //recreate activity (dashboard only)
        recreate();
    }

    public void ClickMeteringUpdate(View view){
        //redirect activity to metering update
        MainActivity.redirectActivity(this,MeteringUpdate.class);
    }

    public void ClickAboutUs(View view){
        //redirect activity to about us
        MainActivity.redirectActivity(this, AboutUs.class);
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