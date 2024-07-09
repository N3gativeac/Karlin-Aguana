package xyz.infinitydoki.sukelco.admin.app;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class Settings extends AppCompatActivity {

    Button UpdateAccountButton;
    Button ChangePasswordAndUsername;
    Button PoliciesAndGuidelines;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_settings);

        UpdateAccountButton = findViewById(R.id.updateAccButton);
        UpdateAccountButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(Settings.this, SettingsUpdateAccountStatus.class);
                startActivity(intent);
            }
        });
        ChangePasswordAndUsername = findViewById(R.id.changePasswordUsernameButton);
        ChangePasswordAndUsername.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(Settings.this, SettingsChangePasswordAndUsername.class);
                startActivity(intent);
            }
        });
        PoliciesAndGuidelines = findViewById(R.id.policiesAndGuidelinesButton);
        PoliciesAndGuidelines.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(Settings.this, SettingsPoliciesAndGuidelines.class);
                startActivity(intent);
            }
        });

    }
}