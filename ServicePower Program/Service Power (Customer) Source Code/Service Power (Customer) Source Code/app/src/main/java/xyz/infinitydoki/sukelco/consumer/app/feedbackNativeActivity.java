package xyz.infinitydoki.sukelco.consumer.app;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

public class feedbackNativeActivity extends AppCompatActivity {
    //Declare Stuff
    EditText name, phonenumber, suggestions;
    RadioGroup feedbackrating;
    String feedbackratingSTR = "test";
    Button submitFeedback;
    ProgressDialog progressDialog;
    connectionBridgeSQL connectionBridgeSQL;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback_native);
        //Map necessary ids
        name = (EditText) findViewById(R.id.editTextNameFeedback);
        phonenumber = (EditText) findViewById(R.id.editTextPhoneNumFeedBack);
        feedbackrating = (RadioGroup) findViewById(R.id.radiogroupfeedbacksatisfaction);
        suggestions = (EditText) findViewById(R.id.editTextSuggestion);
        submitFeedback = (Button) findViewById(R.id.buttonSubmitFeedBack);
        //Initialize SQL connection bridge
        connectionBridgeSQL = new connectionBridgeSQL();
        //Initialize progress dialog box
        progressDialog=new ProgressDialog(this);
        //Task when submit feedback is pressed
        submitFeedback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AsyncSubmitFeedBack asyncSubmitFeedBack = new AsyncSubmitFeedBack();
                asyncSubmitFeedBack.execute("");
            }
        });
    }

    //Java class for sending feedback
    public class AsyncSubmitFeedBack extends AsyncTask<String,String,String> {


        String namestr = name.getText().toString();  //name
        String phonenumstr = phonenumber.getText().toString(); //phone number
        String suggestionstr = suggestions.getText().toString(); //suggestion
        String feedbackratingstr = ((RadioButton) findViewById(feedbackrating.getCheckedRadioButtonId())).getText().toString(); //feedback rating
        String toastNotify = "Hello"; //temporary variable for toast
        boolean isSuccess = false; //if the feedback is successful

        @Override
        protected void onPreExecute() {
            progressDialog.setMessage("Submitting feedback...");
            progressDialog.show();
        }
        //background task to communicate into database
        @Override
        protected String doInBackground(String... params) {
            //if registration fields (e.g. name, email, and password), create toast for filling all the fields
            if(suggestionstr.trim().equals("")|| feedbackratingstr.trim().equals("")) {
                toastNotify = "Please fill in the feedback reason and/or select a feedback rating";
            }
            else
            {
                try {
                    Connection con = connectionBridgeSQL.CONN(); //connect to MySQL
                    //if no network connection, notify user to check their network connection
                    if (con == null) {
                        toastNotify = "Sending a feedback requires an internet connection. Please try again";
                    } else {
                        //otherwise, insert values to feedback (using name, phone, suggestion, feedback rating)
                        String query="INSERT INTO feedback (name, phonenumber, feedbackrating, suggestions) VALUES ('"+namestr+"','"+phonenumstr+"','"+feedbackratingstr+"','"+suggestionstr+"')";
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