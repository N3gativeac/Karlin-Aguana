package net.simplifiedcoding.simplifiedcoding;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class feedbackActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback);

        //webView rendering stuff

        WebView webView = (WebView) findViewById(R.id.renderFeedBack);
        //replace this line in final release...
        webView.loadUrl("http://192.168.1.7/sukelco_feedback/index.php");
        WebSettings webSettings = webView.getSettings();
        //enable javascript and popups
        webSettings.setJavaScriptEnabled(true);
        webSettings.setSupportMultipleWindows(true);
        //allow popup to work in the webView
        webView.setWebChromeClient(new WebChromeClient() {
            @Override
            public boolean onJsAlert(WebView view, String url, String message, JsResult result) {
                //Required functionality here
                return super.onJsAlert(view, url, message, result);
            }
        });

    }
}