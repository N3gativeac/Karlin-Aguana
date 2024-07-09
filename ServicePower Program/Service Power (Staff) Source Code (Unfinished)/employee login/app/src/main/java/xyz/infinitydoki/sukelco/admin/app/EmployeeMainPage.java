package xyz.infinitydoki.sukelco.admin.app;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class EmployeeMainPage extends AppCompatActivity {
    //Declare buttons
    Button SettingButton;
    Button MRUpdateButton;
    Button RSUButton;
    Button LogoutButton;
    //Declare textViews
    TextView TextViewEmployeeFullName, textViewEmployeeAge, textViewEmployeePosition, textViewEmployeeAddress;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_employee_main_page);


        //if the user is not logged in
        //starting the login activity
        /*if (!SharedPrefManager.getInstance(this).isLoggedIn()) {
            finish();
            startActivity(new Intent(this, LoginActivity.class));
        }*/
        //Enable textViews
        TextViewEmployeeFullName = (TextView) findViewById(R.id.TextViewEmployeeFullName);
        textViewEmployeeAge = (TextView)  findViewById(R.id.textViewEmployeeAge);
        textViewEmployeePosition = (TextView) findViewById(R.id.textViewEmployeePosition);
        textViewEmployeeAddress = (TextView) findViewById(R.id.textViewEmployeeAddress);

        //getting the current user
        User user = SharedPrefManager.getInstance(this).getUser();
        //set textView
        TextViewEmployeeFullName.setText(user.getEmployeeName());
        textViewEmployeeAge.setText(String.valueOf(user.getEmployeeAge()));
        textViewEmployeePosition.setText(user.getEmployeePosition());
        textViewEmployeeAddress.setText(user.getEmployeeAddress());

        //Button monitoring stuff
        MRUpdateButton = findViewById(R.id.MRUpdateButton);
        MRUpdateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(EmployeeMainPage.this, MeteringUpdate.class);
                startActivity(intent);
            }
        });
        RSUButton = findViewById(R.id.RSUButton);
        RSUButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(EmployeeMainPage.this, ReportStatusUpdate.class);
                startActivity(intent);
            }
        });
        SettingButton = findViewById(R.id.SettingButton);
        SettingButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(EmployeeMainPage.this, Settings.class);
                startActivity(intent);
            }
        });
        LogoutButton = findViewById(R.id.logoutButton);
        LogoutButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent intent = new Intent(EmployeeMainPage.this, LoginActivity.class);
                startActivity(intent);
                SharedPrefManager.getInstance(getApplicationContext()).logout();
                finish();
            }
        });
    }
}