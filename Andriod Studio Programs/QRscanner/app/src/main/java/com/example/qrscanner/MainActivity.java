package com.example.qrscanner;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

public class MainActivity extends AppCompatActivity {
    // initialize Var
    Button btScan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // assign Var
        btScan = findViewById(R.id.bt_scan);
        btScan.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {
                // initialize intent integrator
                IntentIntegrator intentIntegrator = new IntentIntegrator(
                        MainActivity.this
                );
                // set prompt text
                intentIntegrator.setPrompt("For flash volume up key");
                // set beep
                intentIntegrator.setBeepEnabled(true);
                // lock orentation
                intentIntegrator.setOrientationLocked(true);
                // set capture activity
                intentIntegrator.setCaptureActivity(Capture.class);
                // initiate scan
                intentIntegrator.initiateScan();
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        // initialize intent result
        IntentResult intentResult = IntentIntegrator.parseActivityResult(
                requestCode,resultCode,data
        );
        // check condition
        if (intentResult.getContents() != null){
            // When result content is not null
            // Initialize alert dialog
            AlertDialog.Builder builder = new AlertDialog.Builder(
                    MainActivity.this
            );
            // set title
            builder.setTitle("Result");
            // Set Message
            builder.setMessage(intentResult.getContents());
            //set positive button
            builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {
                    // Dismiss Dialog
                    dialogInterface.dismiss();
                }
            });
            // Show alert dialog
            builder.show();
        }else{
            // When result content is null
            // Display toast
            Toast.makeText(getApplicationContext()
            ,"OOPS... You did not scan anything", Toast.LENGTH_LONG)
                    .show();
        }
    }
}