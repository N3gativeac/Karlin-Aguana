package net.simplifiedcoding.simplifiedcoding;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class PowerAdvisory extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_power_advisory);
        //webView stuff
        WebView webView = (WebView) findViewById(R.id.renderPowerAdvisory);
        webView.loadUrl("http://www.sukelco.com.ph/index.php/power-advisory/");
    }
}