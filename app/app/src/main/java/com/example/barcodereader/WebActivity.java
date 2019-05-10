package com.example.barcodereader;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.Toast;

import okhttp3.HttpUrl;

public class WebActivity extends AppCompatActivity{
    private Toolbar tb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_web);

        WebView mWebView = (WebView) findViewById(R.id.activity_main_webview);
        WebSettings webSettings = mWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);

        HttpUrl.Builder urlBuilder = HttpUrl.parse("https://mgoeckler.ddns.net/Sew_Projekt/web/mainface.php").newBuilder();
        urlBuilder.addQueryParameter("sessionid", "0");
        urlBuilder.addQueryParameter("nav", "0");
        String url = urlBuilder.build().toString();
        mWebView.getSettings().setDomStorageEnabled(true);
        mWebView.loadUrl(url);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu, menu);
        return true;
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            Toast.makeText(this, "gedrückt!", Toast.LENGTH_LONG).show();
            return true;
        }
        if (id==R.id.action_scan){
            Intent intent = new Intent(this, MainActivity.class);
            finish();
            startActivity(intent);
        }

        return super.onOptionsItemSelected(item);
    }
}
