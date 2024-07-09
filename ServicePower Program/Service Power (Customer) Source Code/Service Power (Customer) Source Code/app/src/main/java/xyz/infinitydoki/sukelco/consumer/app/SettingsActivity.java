package xyz.infinitydoki.sukelco.consumer.app;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class SettingsActivity extends AppCompatActivity {

    Button UpdateAccountStatus;
    Button ChangePasswordAndUsername;
    Button PoliciesAndGuidelines;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_settings);

        UpdateAccountStatus = findViewById(R.id.updateAccButton);
        UpdateAccountStatus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(SettingsActivity.this, SettingsUpdateAccountStatus.class);
                startActivity(intent);
            }
        });

        ChangePasswordAndUsername = findViewById(R.id.changePassAndUserButton);
        ChangePasswordAndUsername.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(SettingsActivity.this, SettingsChangePasswordAndUsername.class);
                startActivity(intent);
            }
        });

        PoliciesAndGuidelines = findViewById(R.id.policiesAndGuidelinesButton);
        PoliciesAndGuidelines.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(SettingsActivity.this, SettingsPoliciesAndGuidelines.class);
                startActivity(intent);
            }
        });
    }
}