package xyz.infinitydoki.sukelco.consumer.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.os.Bundle;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

public class feedbackActivity extends AppCompatActivity {
    //declare globally
    WebView view;
    SwipeRefreshLayout mySwipeRefreshLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback);
        //webView rendering stuff
        Toast.makeText(getApplicationContext(), "Swipe down to refresh", Toast.LENGTH_SHORT).show();
        mySwipeRefreshLayout = (SwipeRefreshLayout) this.findViewById(R.id.swipeFeedback);
        String url = "http://192.168.254.159/sukelco_feedback/index.php";
        view = (WebView) this.findViewById(R.id.renderFeedBack);
        //SECURITY WARNING: Enable javaScripts you trust
        view.getSettings().setJavaScriptEnabled(true);
        //Extra controls
        //view.getSettings().setBuiltInZoomControls(true);
        //view.getSettings().setDisplayZoomControls(false);
        //Set-up the webClient
        view.setWebViewClient(new WebViewClient());
        view.loadUrl(url);
        //Enable popup on webView
        view.setWebChromeClient(new WebChromeClient() {
            @Override
            public boolean onJsAlert(WebView view, String url, String message, JsResult result) {
                //Required functionality here
                return super.onJsAlert(view, url, message, result);
            }
        });
        //swipe down to refresh
        mySwipeRefreshLayout.setOnRefreshListener(
                new SwipeRefreshLayout.OnRefreshListener() {
                    @Override
                    public void onRefresh() {
                        view.reload();
                    }
                }
        );

    }
}