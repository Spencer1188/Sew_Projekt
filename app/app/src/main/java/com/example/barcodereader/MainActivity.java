package com.example.barcodereader;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;
import android.content.Intent;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;


public class MainActivity extends AppCompatActivity implements OnClickListener {
    private Button scanBtn,reloaditems;
    private TextView formatTxt, contentTxt;
    private ListView List;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        scanBtn = findViewById(R.id.scan_button);
        formatTxt = findViewById(R.id.scan_format);
        contentTxt = findViewById(R.id.scan_content);
        reloaditems = findViewById(R.id.ReloadList_button);
        List = findViewById(R.id.List);
        scanBtn.setOnClickListener(this);
        reloaditems.setOnClickListener(this);


    }

    public void onClick(View v){
        if(v.getId()==R.id.scan_button){
            IntentIntegrator scanIntegrator = new IntentIntegrator(this);
            scanIntegrator.initiateScan();
            Log.d("click","ok");
        }

        if(v.getId()==R.id.ReloadList_button){
            Log.d("click","ok");
        }
    }

    public void onActivityResult(int requestCode, int resultCode, Intent intent) {
        IntentResult scanningResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent);
        if (scanningResult != null) {
          String scanContent = scanningResult.getContents();
          String scanFormat = scanningResult.getFormatName();

            formatTxt.setText("FORMAT: " + scanFormat);
            contentTxt.setText("CONTENT: " + scanContent);

            sendAccelerationData(scanFormat,scanContent);
        }
        else{
            formatTxt.setText("Error");
        }
    }

    private void sendAccelerationData(String id, String name)
    {
        Send_Scan_Data r = new Send_Scan_Data();
        r.execute(id,name);
    }

}

