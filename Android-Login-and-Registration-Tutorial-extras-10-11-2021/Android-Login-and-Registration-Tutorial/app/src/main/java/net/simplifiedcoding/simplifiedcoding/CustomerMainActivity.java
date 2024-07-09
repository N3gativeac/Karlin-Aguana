package net.simplifiedcoding.simplifiedcoding;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.TextView;

public class CustomerMainActivity extends AppCompatActivity{
    //Global variables
    String tempBarangay, tempTown;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_customer_main);


         //if the user is not logged in
        //starting the login activity
        if (!SharedPrefManager.getInstance(this).isLoggedIn()) {
        finish();
        startActivity(new Intent(this, LoginActivity.class));
    }
        //Initialize stuff
        Button buttonSettings;
        Button buttonHistory;
        Button buttonAnnouncement;
        Button buttonReports;
        Button buttonPowerAdvisory;
        Button buttonTempLogOut;
        TextView textViewFullName, textViewFullAddress;
        TextView textViewPrevMeterID, textViewUserBalance, textViewComputationBilling, textViewReadingofKWh, textViewCurrPerKWh = null;
        String textViewUserBalanceString, textViewCurrPerKWhString;

        //Parse from elements
        textViewFullName = (TextView) findViewById(R.id.textViewFullName);
        textViewFullAddress = (TextView) findViewById(R.id.textViewFullAddress);
        textViewPrevMeterID = (TextView) findViewById(R.id.textViewPrevMeterID);
        textViewUserBalance = (TextView) findViewById(R.id.textViewUserBalance);
        textViewComputationBilling = (TextView) findViewById(R.id.textViewComputationBilling);
        textViewReadingofKWh = (TextView) findViewById(R.id.textViewReadingofKWh);


        //getting the current user
        User user = SharedPrefManager.getInstance(this).getUser();

        //setting the values to the textViews
        textViewFullName.setText(user.getFullname());
        textViewFullAddress.setText(user.getFullAddress());
        textViewReadingofKWh.setText(user.getTotalKWH());
        textViewPrevMeterID.setText(user.getMeterID());
        //set user balance
        //textViewUserBalanceString = Float.toString(user.getUserBalance());
        //textViewUserBalance.setText(textViewUserBalanceString);
        textViewUserBalanceString = Float.toString(user.getUserBalance());
        textViewComputationBilling.setText(textViewUserBalanceString);


        //Settings
            buttonSettings = findViewById(R.id.buttonSettings);
            buttonSettings.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(CustomerMainActivity.this, SettingsActivity.class);
                    startActivity(intent);
                }
            });
            //History of transaction(s)
            buttonHistory = findViewById(R.id.buttonHistory);
            buttonHistory.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(CustomerMainActivity.this, HistoryActivity.class);
                    startActivity(intent);
                }
            });
            //Announcements (SUKELCO/WebView)
            buttonAnnouncement = findViewById(R.id.buttonAnnouncement);
            buttonAnnouncement.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(CustomerMainActivity.this, AnnouncementActivity.class);
                    startActivity(intent);
                }
            });
            //User-reports
            buttonReports = findViewById(R.id.buttonReports);
            buttonReports.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(CustomerMainActivity.this, feedbackActivity.class);
                    startActivity(intent);
                }
            });
            //Power Advisory/Advisories (SUKELCO/WebView)
            buttonPowerAdvisory = findViewById(R.id.buttonPowerAdvisory);
            buttonPowerAdvisory.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(CustomerMainActivity.this, PowerAdvisory.class);
                startActivity(intent);
            }
        });
        //Logout button
        buttonTempLogOut = (Button) findViewById(R.id.buttonTempLogOut);
        findViewById(R.id.buttonTempLogOut).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
                SharedPrefManager.getInstance(getApplicationContext()).logout();
            }
        });
    }
}