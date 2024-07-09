package com.example.student_app;

/**
 * Created by Shashank on 14-Feb-18.
 */
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class DashboardActivity extends AppCompatActivity {

    String EmailHolder;
    TextView Email;
    Button LogOUT ;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        Email = (TextView)findViewById(R.id.textView1);
        LogOUT = (Button)findViewById(R.id.button1);

        Intent intent = getIntent();

        // Receiving User Email Send By MainActivity.
        EmailHolder = intent.getStringExtra(MainActivity.UserEmail);

        // Setting up received email to TextView.
        Email.setText(Email.getText().toString()+ EmailHolder);

        // Adding click listener to Log Out button.
        LogOUT.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                //Finishing current DashBoard activity on button click.
                finish();

                Toast.makeText(DashboardActivity.this,"Log Out Successful", Toast.LENGTH_LONG).show();

            }
        });

    }
}