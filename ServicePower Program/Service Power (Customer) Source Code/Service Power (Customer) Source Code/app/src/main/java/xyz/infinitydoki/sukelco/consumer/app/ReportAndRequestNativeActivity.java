package xyz.infinitydoki.sukelco.consumer.app;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.Statement;

public class ReportAndRequestNativeActivity extends AppCompatActivity {
    //Declare Stuff
    RadioGroup reporttype;
    EditText requestinfo;
    EditText name;
    EditText phonenumber;
    EditText purok;
    Spinner spinnerBarangayRequest;
    Spinner spinnerTownRequest;
    Button submitRequest;
    String tempTownRequest, tempBarangayRequest;
    ProgressDialog progressDialog;
    connectionBridgeSQL connectionBridgeSQL;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_report_and_request_native);

        //Remap stuff
        reporttype = (RadioGroup) findViewById(R.id.RadioGroupReportRequest);
        requestinfo = (EditText) findViewById(R.id.editTextSpecificRequestReport);
        name = (EditText) findViewById(R.id.editTextNameRequest);
        phonenumber = (EditText) findViewById(R.id.editTextPhoneNumRequest);
        purok = (EditText) findViewById(R.id.editTextPurokRequest);
        spinnerBarangayRequest = (Spinner) findViewById(R.id.spinnerBarangayRequest);
        spinnerTownRequest = (Spinner) findViewById(R.id.spinnerTownRequest);
        submitRequest = (Button) findViewById(R.id.buttonSubmitRequest);

        //Initialize SQL connection bridge
        connectionBridgeSQL = new connectionBridgeSQL();
        //Initialize progress dialog box
        progressDialog=new ProgressDialog(this);

        //Dual spinner stuff
        //First spinner (spinnerTownRequest)
        spinnerTownRequest.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                String selectedCity = adapterView.getItemAtPosition(i).toString();
                //assign each town to set the value for the barangay array and set the town directly
                switch (selectedCity)
                {
                    case "Bagumbayan":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.BagumbayanBarangay)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Columbio":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.ColumbioBarangay)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Esperanza":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.EsperanzaBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Isulan":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.IsulanBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Kalamansig":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.KalamansigBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Lambayong":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.LabayongBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Lebak":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.LebakBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Lutayan":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.LutayanBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Palimbang":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.PalimbangBarangays)));
                        tempTownRequest = selectedCity;

                        break;
                    case "President Quirino":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.PresQuirinoBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Senator Ninoy Aquino":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.SenNinoyAquinoBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    case "Tacurong City":
                        spinnerBarangayRequest.setAdapter(new ArrayAdapter<String>(ReportAndRequestNativeActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.TacurongBarangays)));
                        tempTownRequest = selectedCity;
                        break;
                    default:
                        Toast.makeText(getApplicationContext(), "Please select a town or city", Toast.LENGTH_SHORT).show();
                        break;
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {
                //Pretend there is data here
            }
        });
        //Second Spinner (spinnerBarangayRequest)
        spinnerBarangayRequest.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                //Set the appropriate barangay
                String selectedBarangays = adapterView.getItemAtPosition(i).toString();
                tempBarangayRequest = selectedBarangays;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {
                //filler data
            }
        });
        //Task when submit report/request is pressed
        submitRequest.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AsyncSubmitReportRequest asyncSubmitReportRequest = new AsyncSubmitReportRequest();
                asyncSubmitReportRequest.execute("");
            }
        });
    }
    //Java class for sending report/request
    public class AsyncSubmitReportRequest extends AsyncTask<String,String,String> {


        String namestr = name.getText().toString();  //name
        String phonenumstr = phonenumber.getText().toString(); //phone number
        String purokstr = purok.getText().toString(); //purok
        String townstr = tempTownRequest; //town
        String barangaystr = tempBarangayRequest; //barangay
        String reportRequestTypestr = ((RadioButton) findViewById(reporttype.getCheckedRadioButtonId())).getText().toString(); //Report or Request
        String specifyreportstr = requestinfo.getText().toString(); //specify report

        String toastNotify = "Hello"; //temporary variable for toast
        boolean isSuccess = false; //if the feedback is successful

        @Override
        protected void onPreExecute() {
            progressDialog.setMessage("Submitting report/request...");
            progressDialog.show();
        }
        //background task to communicate into database
        @Override
        protected String doInBackground(String... params) {
            //if registration fields (e.g. name, email, and password), create toast for filling all the fields
            if(specifyreportstr.trim().equals("")|| reportRequestTypestr.trim().equals("")||namestr.trim().equals("")||phonenumstr.trim().equals("")||purokstr.trim().equals("")||townstr.trim().equals("")||barangaystr.trim().equals("")) {
                toastNotify = "Please fill in the necessary information.";
            }
            else
            {
                try {
                    Connection con = connectionBridgeSQL.CONN(); //connect to MySQL
                    //if no network connection, notify user to check their network connection
                    if (con == null) {
                        toastNotify = "Sending a report or request requires an internet connection. Please try again";
                    } else {
                        //otherwise, insert values to requests (using name, phone, address, type of request and request info)
                        String query="INSERT INTO requests (name, phonenumber, purok, barangay, town, requesttype, requestinfo) VALUES ('"+namestr+"','"+phonenumstr+"','"+purokstr+"','"+barangaystr+"','"+townstr+"','"+reportRequestTypestr+"','"+specifyreportstr+"')";
                        //Update SQL
                        Statement stmt = con.createStatement();
                        stmt.executeUpdate(query);
                        //Say registration successful afterwards (if conditions are met)
                        toastNotify = "Feedback has been sent!";
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
            finish();
        }
    }
}