package net.simplifiedcoding.simplifiedcoding;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class AnnouncementActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_announcement);

        //webView rendering stuff

        WebView webView = (WebView) findViewById(R.id.renderAnnouncement);
        webView.loadUrl("http://www.sukelco.com.ph/index.php/announcements/");

    }
}