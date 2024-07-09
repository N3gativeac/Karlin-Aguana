package xyz.infinitydoki.sukelco.consumer.app;

import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

public class PowerAdvisory extends AppCompatActivity {
    //declare stuff
    WebView view;
    SwipeRefreshLayout mySwipeRefreshLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_power_advisory);
        //webView stuff
        //webView rendering stuff
        Toast.makeText(getApplicationContext(), "Swipe down to refresh", Toast.LENGTH_SHORT).show();
        mySwipeRefreshLayout = (SwipeRefreshLayout) this.findViewById(R.id.swipePowerAdvisory);
        String url = "http://www.sukelco.com.ph/index.php/power-advisory/";
        view = (WebView) this.findViewById(R.id.renderPowerAdvisory);
        //SECURITY WARNING: Enable javaScripts you trust
        view.getSettings().setJavaScriptEnabled(true);
        //Extra controls
        //view.getSettings().setBuiltInZoomControls(true);
        //view.getSettings().setDisplayZoomControls(false);
        //Set-up the webClient
        view.setWebViewClient(new WebViewClient());
        view.loadUrl(url);
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
