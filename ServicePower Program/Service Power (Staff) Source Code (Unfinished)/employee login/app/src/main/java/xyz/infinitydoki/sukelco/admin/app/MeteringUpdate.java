package xyz.infinitydoki.sukelco.admin.app;

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
import android.widget.TextView;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DecimalFormat;

public class MeteringUpdate extends AppCompatActivity {
    //Declare variables
    EditText enterMeterID;
    EditText enterValuePhpKwH;
    EditText enterOldKwH;
    EditText enterCurrentKwH;
    TextView currentValuePhPKwH, totalValueKwH, totalPowerConsumption;
    Button calculateButton, submitUpdatedBillingButton;
    ProgressDialog progressDialog;
    connectionBridgeUpdateCustomerData connectionBridgeUpdateCustomerData;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_metering_update);
        //Map ids
        //
        //EditText
        enterMeterID = (EditText)findViewById(R.id.editTextInputMeterID);
        enterValuePhpKwH = (EditText) findViewById(R.id.editTextValuePhpKwh);
        enterOldKwH = (EditText) findViewById(R.id.editTextOldReading);
        enterCurrentKwH = (EditText) findViewById(R.id.editTextCurrentReading);
        //TextView
        currentValuePhPKwH = (TextView) findViewById(R.id.textViewCurrentValuePhPKwh);
        totalValueKwH = (TextView) findViewById(R.id.textViewTotalkWhReading);
        totalPowerConsumption = (TextView) findViewById(R.id.textViewTotalPowerPhpKwh);
        //Buttons
        calculateButton = (Button) findViewById(R.id.buttonCalculatePhpKwh);
        submitUpdatedBillingButton = (Button) findViewById(R.id.buttonSubmitUpdatedBillInfo);
        //Initialize ProgressDialog and connectionBridge
        progressDialog=new ProgressDialog(this);
        connectionBridgeUpdateCustomerData = new connectionBridgeUpdateCustomerData();
        //Calculate Button
        calculateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //Dear math, please grow up and solve your own problems. I'm tired of solving them for you.
                //Set the value for the PHP/kWh
                currentValuePhPKwH.setText(enterValuePhpKwH.getText().toString());
                //Current KwH minus Previous KwH
                int oldKwH = Integer.parseInt(enterOldKwH.getText().toString());
                int newKwH = Integer.parseInt(enterCurrentKwH.getText().toString());
                int totalKwH = newKwH - oldKwH;
                totalValueKwH.setText(String.valueOf(totalKwH));
                //Calculate total power consumption (in PHP)
                float ValueOfPHPKwH = Float.parseFloat(enterValuePhpKwH.getText().toString());
                float totalKwHinFloat = (float) totalKwH;
                float totalOfPHPKwHCustomerFloat = ValueOfPHPKwH * totalKwHinFloat;
                DecimalFormat twoDecPlace = new DecimalFormat("#.##");
                totalPowerConsumption.setText(String.valueOf(twoDecPlace.format(totalOfPHPKwHCustomerFloat)));
            }
        });
        //Submit Button
        submitUpdatedBillingButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(getApplicationContext(), "Currently under development...", Toast.LENGTH_SHORT).show();
            }
        });
    }
}