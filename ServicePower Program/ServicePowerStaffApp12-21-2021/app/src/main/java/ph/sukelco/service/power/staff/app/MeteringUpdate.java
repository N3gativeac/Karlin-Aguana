package ph.sukelco.service.power.staff.app;

import androidx.annotation.RequiresPermission;
import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;

public class MeteringUpdate extends AppCompatActivity {
    //Declare global variables
    DrawerLayout drawerLayout;
    EditText ConsumerMeterID, EnterCurrentKWH;
    TextView UserPreview, UpdateSummary;
    String MeterIDGlobal, ConsumerUsername, ConsumerBuildingType;
    Integer PreviousKWH, CurrentKWH, TotalKWH;
    Button SearchMeterID, CreateTransactionSummary, UpdatePowerConsumption;
    Boolean isMeterIDNull, isLatestKWHNull;
    Boolean isMeterIDFound, isSummaryCreated, isPreviousMethodsCreated;
    Float PHPKWHGlobal, TotalPHPConsumption;
    ProgressDialog progressDialog;
    //getting the current user
    User user = SharedPrefManager.getInstance(this).getUser();
    connBridgeFetchLatestBillingInfo connBridgeFetchLatestBillingInfo;
    connBridgeUpdateConsumerBilling connBridgeUpdateConsumerBilling;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_metering_update);
        //hide actionBar
        getSupportActionBar().hide();

        //Set IDs
        drawerLayout = findViewById(R.id.drawer_layout);
        ConsumerMeterID = findViewById(R.id.editTextSearchMeterID);
        EnterCurrentKWH = findViewById(R.id.editTextUpdateKWH);
        UserPreview = findViewById(R.id.textViewMeterIDInfo);
        UpdateSummary = findViewById(R.id.textViewUpdateSummary);
        SearchMeterID = findViewById(R.id.buttonDetectMeterID);
        CreateTransactionSummary = findViewById(R.id.buttonGenerateReportForSummary);
        UpdatePowerConsumption = findViewById(R.id.buttonUpdatePowerConsumption);

        //pre load SQL bridge(s) and progress dialog
        connBridgeUpdateConsumerBilling = new connBridgeUpdateConsumerBilling();
        connBridgeFetchLatestBillingInfo = new connBridgeFetchLatestBillingInfo();
        progressDialog = new ProgressDialog(MeteringUpdate.this);

        //Step 1: Search meter ID and retrieve meterID, username, previous KWH,and building type
        SearchMeterID.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String CheckConsumerMeterID = ConsumerMeterID.getText().toString();
                Log.d("Entered MeterID ", CheckConsumerMeterID);
                if (TextUtils.isEmpty(CheckConsumerMeterID)){
                    Log.e("Error (MU) ", "Empty meter ID");
                    ConsumerMeterID.setError("Enter meter ID");
                    ConsumerMeterID.requestFocus();
                    isMeterIDNull = true;
                    isMeterIDFound = false;
                    Log.e("Meter ID", "Check failed (Null)");
                }
                else {
                    isMeterIDNull = false;
                    isMeterIDFound = true;
                    AsyncFetchUserData asyncFetchUserData = new AsyncFetchUserData();
                    asyncFetchUserData.execute("");
                    Log.d("Meter ID", "Check success (Not null)");
                }
            }
        });
        CreateTransactionSummary.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String CheckEnterCurrentKWH = EnterCurrentKWH.getText().toString();
                Log.d("Entered KWH ", CheckEnterCurrentKWH);
                if (TextUtils.isEmpty(CheckEnterCurrentKWH)){
                    Log.e("Error (MU) ", "No KWH value");
                    EnterCurrentKWH.setError("Enter latest KWH");
                    EnterCurrentKWH.requestFocus();
                    isLatestKWHNull = true;
                    isSummaryCreated = false;
                    Log.e("Current KWH", "Check failed");
                }
                else {
                    isLatestKWHNull = false;
                    isSummaryCreated = true;
                    AsyncFetchBillingData asyncFetchBillingData = new AsyncFetchBillingData();
                    asyncFetchBillingData.execute("");
                    Log.d("Current KWH", "Check success");
                }
            }
        });
        UpdatePowerConsumption.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Log.d("Meter ID found", isMeterIDFound.toString());
                Log.d("Made Summary", isSummaryCreated.toString());
                if (isMeterIDFound & isSummaryCreated){
                    //run async command
                    isPreviousMethodsCreated = true;
                    AsyncSubmitUpdateTransaction asyncSubmitUpdateTransaction = new AsyncSubmitUpdateTransaction();
                    asyncSubmitUpdateTransaction.execute("");
                }
                else {
                    //fail outright
                    isPreviousMethodsCreated = false;
                    Toast.makeText(MeteringUpdate.this, "Summary not generated. Please try again.", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    //Step 1: Search meter ID and retrieve meterID, username, previous KWH,and building type
    private class AsyncFetchUserData extends AsyncTask<String,String,String> {

        //initialize variables
        String ReadMeterID=ConsumerMeterID.getText().toString();
        String ToastNotify="";
        boolean isSuccess=false;
        String FetchMeterID,FetchUsername,FetchBuildingType;
        Integer FetchPreviousKWH;



        //Bootstrap loading process
        @Override
        protected void onPreExecute() {
            progressDialog.setMessage("Searching for user: " + ReadMeterID);
            progressDialog.show();
            super.onPreExecute();
        }
        @Override
        protected String doInBackground(String... params) {
            //check if isMeterIDNull is actually null
            Log.d("isMeterIDNull ", isMeterIDNull.toString());
            Boolean isMeterIDActuallyNull = isMeterIDNull;
            Log.d("IMIDANULL", isMeterIDActuallyNull.toString());
            //simple check if these fields are NULL, notify user to fill EVERYTHING
            if(isMeterIDActuallyNull){
                Log.e("Error ", "Empty meter ID");
                ToastNotify = "Empty Meter ID";
            }
            else
            {
                try {
                    //try to connect to MySQL
                    Log.d("SQL status ","Connecting to database... Please wait");
                    Connection con = connBridgeUpdateConsumerBilling.CONN();
                    if (con == null) {
                        //no internet
                        ToastNotify = "Please check your internet connection amd try again...";
                        Log.e("SQL bridge: ","Not initialized");
                    }
                    else {
                        //checks meterID into a SQL friendly command
                        String query= "SELECT * FROM users WHERE meterid = '"+ReadMeterID+"'";
                        Statement stmt = con.createStatement();
                        Log.d("SQL status ", "Fetching userdata from meterID, please wait");
                        // stmt.executeUpdate(query);
                        //create a result set (note: username=2, meterID=13, totalKWH=14, buildingType=15)
                        ResultSet rs=stmt.executeQuery(query);
                        String resultSetFromServer = rs.toString();
                        //if result set is empty commit error, else continue
                        if (TextUtils.isEmpty(resultSetFromServer)){
                            Log.e("SQL Server ", "Empty result set.");
                        }
                        else {
                            Log.d("SQL Server ", "Result set exist!");
                        }
                        while (rs.next())
                        {
                            //copy variables from query to local string variables
                            FetchMeterID= rs.getString(13);
                            FetchUsername=rs.getString(2);
                            FetchPreviousKWH=rs.getInt(14);
                            FetchBuildingType=rs.getString(15);
                            //Debug log
                            Log.d("Server MeterID: ", FetchMeterID);
                            Log.d("Server Username: ", FetchUsername);
                            Log.d("Server PreviousKWH: ", FetchPreviousKWH.toString());
                            Log.d("Server BuildingType: ", FetchBuildingType);
                            //if the credentials exist, load the user
                            Log.d("Server MeterID ", FetchMeterID);
                            Log.d("Client MeterID ", ReadMeterID);
                            //if the client meterID is equal to the server meterID, set the values
                            if(ReadMeterID.equals(FetchMeterID))
                            {
                                Log.d("Find MeterID ", "User found!");
                                isSuccess=true;
                                //copy to global (for later use)
                                MeterIDGlobal = FetchMeterID;
                                ConsumerUsername = FetchUsername;
                                PreviousKWH = FetchPreviousKWH;
                                ConsumerBuildingType = FetchBuildingType;
                                ToastNotify = "Consumer found successfully!";
                            }
                            //if not, try again
                            else {
                                Log.e("Find MeterID ", "Meter ID not found on database");
                                isSuccess = false;
                                ToastNotify = "Meter ID not found on the database";
                            }
                        }
                    }
                }
                //if error, create exception
                catch (Exception ex)
                {
                    isSuccess = false;
                    ToastNotify = "SQL Exception: "+ex;
                }
            }
            return ToastNotify;
        }
        @Override
        protected void onPostExecute(String s) {
            Toast.makeText(MeteringUpdate.this,""+ToastNotify,Toast.LENGTH_LONG).show();

            //if successful, set the user credentials to be displayed
            if(isSuccess) {
                String ConfigText = "Username: " + FetchUsername + " \n MeterID: " + FetchMeterID + "\n Previous KWH: " + FetchPreviousKWH.toString() + "\n Building Type: " + FetchBuildingType;
                UserPreview.setText(ConfigText);
            }
            else {
                Log.e("Find MeterID ", "Failed to find user...");
                Toast.makeText(MeteringUpdate.this, "Meter ID could not be found. Please try again.", Toast.LENGTH_SHORT).show();
            }
            progressDialog.hide();
        }
    }
    //Step 2: Using building type (from meterID), retrieve latest commercial/residential data
    private class AsyncFetchBillingData extends AsyncTask<String,String,String> {

        //initialize variables
        Integer CalculatePreviousKWH = PreviousKWH;
        String CalculateNewKWH = EnterCurrentKWH.getText().toString();
        Integer DiffOfKWH;
        String BuildingType = ConsumerBuildingType;
        String ToastNotify="";
        String GeneratedSummary = "Search for meterID first";
        boolean isSuccess=false;
        String GrabBuildingType;
        Float PesoPerKWH, TotalConsumerConsumption;


        //Bootstrap loading process
        @Override
        protected void onPreExecute() {
            progressDialog.setMessage("Fetching billing data... Please wait.");
            progressDialog.show();
            super.onPreExecute();
        }
        @Override
        protected String doInBackground(String... params) {
            //simple check if these fields are NULL, notify user to fill EVERYTHING
            Boolean isLatestKWHIsActuallyNull = isLatestKWHNull;
            if(isLatestKWHIsActuallyNull){
                Log.e("Error ", "No KWH value");
                ToastNotify = "Enter KWH value first.";
            }

            else
            {
                try {
                    //try to connect to MySQL
                    Connection con = connBridgeFetchLatestBillingInfo.CONN();
                    if (con == null) {
                        //no internet
                        ToastNotify = "Please check your internet connection amd try again...";
                        Log.e("SQL bridge: ","Not initialized");
                    }
                    else {
                        //Step 3: User enters current KWH and when pressed calculate, show summary data before updating

                        //Residential building type
                        if (BuildingType.equals("Residential") && !BuildingType.equals(null))
                        {
                            //checks meterID into a SQL friendly command
                            String query=" SELECT * FROM sukelco_admin.billing_to_consumer_info WHERE `buildingtype`='Residential' ORDER BY id DESC LIMIT 1;";
                            Statement stmt = con.createStatement();
                            // stmt.executeUpdate(query);
                            //create a result set (note: buildingtype = 2, PesoPerKWH = 3)
                            ResultSet rs=stmt.executeQuery(query);
                            while (rs.next())
                            {
                                //copy variables from query to local string variables
                                GrabBuildingType= rs.getString(2);
                                PesoPerKWH=rs.getFloat(3);
                                //copy to global (for later use)
                                //Debug log
                                Log.d("Server BuildingType: ", GrabBuildingType);
                                Log.d("Server PesoPerKWH: ", PesoPerKWH.toString());
                                //if appropriate values match, create summary
                                if(!GrabBuildingType.equals(null) && !PesoPerKWH.equals(null))
                                {
                                    isSuccess=true;
                                    PHPKWHGlobal = PesoPerKWH;

                                    //What if the algebra teachers are really pirates, and are using us to find X.
                                    //Subtract current from previous KWH readings
                                    Integer CalculateNewKWHInt = Integer.parseInt(CalculateNewKWH);
                                    CurrentKWH = CalculateNewKWHInt;
                                    DiffOfKWH =  CalculateNewKWHInt - CalculatePreviousKWH;
                                    TotalKWH = DiffOfKWH;
                                    //Multiply Current KWH with PesoPerKWH
                                    Float CalculateNewKWHFloat = Float.parseFloat(String.valueOf(CalculateNewKWHInt));
                                    TotalConsumerConsumption = DiffOfKWH * PesoPerKWH;
                                    TotalPHPConsumption = TotalConsumerConsumption;
                                    //Display summary
                                    Log.d ("Current KWH ", CalculateNewKWH);
                                    Log.d ("Current Peso pew KWH ", PesoPerKWH.toString());
                                    Log.d("Total KWH used", DiffOfKWH.toString());
                                    Log.d("Total Cost ", TotalConsumerConsumption.toString());
                                    GeneratedSummary = "Current KWH: " + CalculateNewKWH.toString() + "\n Current Peso per KWH: " + PesoPerKWH.toString() + "\n Total KWH used: " + DiffOfKWH.toString() + "\n Total Cost: " + TotalConsumerConsumption.toString();
                                    ToastNotify = "Calculation complete!";

                                }
                                //if not, try again
                                else {
                                    isSuccess = false;
                                    ToastNotify = "Empty KWH... Please try again";
                                }
                            }
                        }
                        //commercial building type
                        else if (BuildingType.equals("Commercial") && !BuildingType.equals(null))
                        {
                            //checks meterID into a SQL friendly command
                            String query=" SELECT * FROM sukelco_admin.billing_to_consumer_info WHERE `buildingtype`='Commercial' ORDER BY id DESC LIMIT 1;";
                            Statement stmt = con.createStatement();
                            // stmt.executeUpdate(query);
                            //create a result set (note: buildingtype = 2, PesoPerKWH = 3)
                            ResultSet rs=stmt.executeQuery(query);
                            while (rs.next())
                            {
                                //copy variables from query to local string variables
                                GrabBuildingType= rs.getString(2);
                                PesoPerKWH=rs.getFloat(3);
                                //copy to global (for later use)
                                //Debug log
                                Log.d("Server BuildingType: ", GrabBuildingType);
                                Log.d("Server PesoPerKWH: ", PesoPerKWH.toString());
                                //if appropriate values match, create summary
                                if(!GrabBuildingType.equals(null) && !PesoPerKWH.equals(null))
                                {
                                    isSuccess=true;
                                    PHPKWHGlobal = PesoPerKWH;
                                    //How to do math:
                                    // 1. Write down the problem.
                                    // 2. Cry.
                                    //subtract between new and old KWH readings
                                    Integer CalculateNewKWHInt = Integer.parseInt(CalculateNewKWH);
                                    DiffOfKWH = CalculateNewKWHInt - CalculatePreviousKWH;
                                    CurrentKWH = CalculateNewKWHInt;
                                    TotalKWH = DiffOfKWH;
                                    //Multiply Current KWH with PesoPerKWH
                                    Float CalculateNewKWHFloat = Float.parseFloat(String.valueOf(CurrentKWH));
                                    TotalConsumerConsumption = DiffOfKWH * PesoPerKWH;
                                    TotalPHPConsumption = TotalConsumerConsumption;
                                    //Display summary
                                    Log.d ("Current KWH ", CalculateNewKWH);
                                    Log.d ("Current Peso pew KWH ", PesoPerKWH.toString());
                                    Log.d("Total KWH Used", DiffOfKWH.toString());
                                    Log.d("Total Cost ", TotalConsumerConsumption.toString());
                                    GeneratedSummary = "Current KWH: " + CalculateNewKWH.toString() + "\n Current Peso per KWH: " + PesoPerKWH.toString() + "\n Total KWH used: " + DiffOfKWH.toString() + "\n Total Cost: " + TotalConsumerConsumption.toString();
                                    ToastNotify = "Calculation complete!";

                                }
                                //if not, try again
                                else {
                                    isSuccess = false;
                                    ToastNotify = "Empty KWH... Please try again";
                                }
                            }
                        }
                    }
                }
                //if error, create exception
                catch (Exception ex)
                {
                    isSuccess = false;
                    ToastNotify = "SQL Exception: "+ex;
                }
            }
            return ToastNotify;
        }
        @Override
        protected void onPostExecute(String s) {
            Toast.makeText(MeteringUpdate.this,""+ToastNotify,Toast.LENGTH_LONG).show();

            //if successful, set the user credentials to be displayed
            if(isSuccess = true) {
                //Display summary
                UpdateSummary.setText(GeneratedSummary);
            }
            else {
                Toast.makeText(MeteringUpdate.this, "Current KWH cannot be null. Please try again.", Toast.LENGTH_SHORT).show();
            }
            progressDialog.hide();
        }
    }

    //Java class for sending updated consumer data

    public class AsyncSubmitUpdateTransaction extends AsyncTask<String,String,String> {


        String meterIdStr = MeterIDGlobal;  //meterID
        Float totalConsumptionFloat = TotalPHPConsumption; //Power consumption in PhP
        Integer totalKwHUsed = CurrentKWH; //Total power consumption between previous and new reading in kWh
        String toastNotify = "Hello"; //temporary variable for toast
        boolean isSuccess = false; //if the update is successful or not
        String StaffUsername = user.getUsername();

        @Override
        protected void onPreExecute() {
            progressDialog.setMessage("Updating user details...");
            progressDialog.show();
        }
        //background task to communicate into database
        @Override
        protected String doInBackground(String... params) {
            //debug
            Log.d("MeterID", meterIdStr);
            Log.d("Total PHP cons.", totalConsumptionFloat.toString());
            Log.d("Total KWH used", totalKwHUsed.toString());
            Log.d("Staff username", StaffUsername);
            //if registration fields (e.g. meterID, totalKwH), create toast for filling all the fields
            if(!isPreviousMethodsCreated) {
                toastNotify = "Please fill necessary data to proceed";
            }
            else
            {
                try {
                    Connection con = connBridgeUpdateConsumerBilling.CONN(); //connect to MySQL
                    //if no network connection, notify user to check their network connection
                    if (con == null) {
                        Log.e("SQL bridge: ","Not initialized");
                        toastNotify = "Updating transaction(s) requires an internet connection. Please try again";
                    }
                    else {

                        //otherwise, update user balance to users (using meterID) and insert data to customerlogs
                        String UpdateQuery="UPDATE `users` SET `totalKWH`='"+totalKwHUsed+"',`customerbalance`='"+totalConsumptionFloat+"',`phpKWH`='"+PHPKWHGlobal+"',`measuredbyemployeeid`='"+StaffUsername+"', `dateLastMeasured`=now() WHERE `meterid`='"+meterIdStr+"'";
                        String InsertQuery="INSERT INTO `customerlogs`(`meterid`, `totalKWH`, `customerbalance`, `measuredbyemployeeid`) VALUES ('"+meterIdStr+"','"+totalKwHUsed+"','"+totalConsumptionFloat+"','"+StaffUsername+"')";
                        //Update SQL
                        Statement stmt = con.createStatement();
                        stmt.executeUpdate(UpdateQuery);
                        stmt.executeUpdate(InsertQuery);
                        //Say registration successful afterwards (if conditions are met)
                        toastNotify = "Update transaction success!";
                        isSuccess=true;
                    }
                }
                //if failed, create a toast saying registration failed or something
                catch (Exception ex)
                {
                    isSuccess = false;
                    toastNotify = "SQL Exception: "+ex;
                }
            }
            return toastNotify;
        }

        @Override
        protected void onPostExecute(String s) {
            //show the appropriate toast message
            Toast.makeText(getBaseContext(),""+toastNotify,Toast.LENGTH_LONG).show();
            progressDialog.hide();
        }
    }



    //fancy menu system
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

    public void ClickMeteringUpdate(View view){
        //recreate activity (Metering update only)
        recreate();
    }

    public void ClickAnnouncementWebView(View view){
        //redirect activity to announcements
        MainActivity.redirectActivity(this,Announcement_Webview.class);
    }

    public void ClickPowerAdvisoryWebView(View view){
        //redirect activity to power advisory
        MainActivity.redirectActivity(this,PowerAdvisory_Webview.class);
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