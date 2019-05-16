package com.example.barcodereader;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import com.android.volley.RequestQueue;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

import android.content.Intent;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.HashMap;
import java.util.Map;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.HttpUrl;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;


public class MainActivity extends AppCompatActivity {
    private Button scanBtn,reloaditems;
    private TextView formatTxt, contentTxt, productID,textViewProduct;
    private EditText productName;
    private ListView List;
    public String productId,scanContent,scanFormat;
    private Toolbar tb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        scanBtn = findViewById(R.id.scan_button);
        productName = findViewById(R.id.pName);
        textViewProduct = findViewById(R.id.text_enterProduct);
        tb = (Toolbar) findViewById(R.id.my_toolbar);
        setSupportActionBar(tb);
     //   scanBtn.setOnClickListener(this);

    }

   /* public void onClick(View v){
        if(v.getId()==R.id.scan_button){
            IntentIntegrator scanIntegrator = new IntentIntegrator(this);
            scanIntegrator.initiateScan();
        }
    }*/
    public void onClickScan(View v){
        IntentIntegrator scanIntegrator = new IntentIntegrator(this);
        scanIntegrator.initiateScan();
    }
    public void onClickDelete(View v) {
        productName.getText().clear(); //or you can use editText.setText("");
    }
    public void onClickSubmit(View v){
         String s = productName.getText().toString();
       // Toast.makeText(MainActivity.this, "Product Name Changed to: "+ s, Toast.LENGTH_SHORT).show();
        if (productId == "scanFirst"){
            Toast.makeText(MainActivity.this, "Scannen sie zuerst ein Product um den Namen zu Ändern!", Toast.LENGTH_SHORT).show();
        }
        RequestQueue queue = Volley.newRequestQueue(MainActivity.this);
        String url = "https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php";
        StringRequest putRequest = new StringRequest(com.android.volley.Request.Method.PUT, url,
                new com.android.volley.Response.Listener<String>()
                {
                    @Override
                    public void onResponse(String response) {

                        //Toast.makeText(MainActivity.this, "put res: " + response, Toast.LENGTH_SHORT).show();
                        if(productId != "scanFirst"){
                        Toast.makeText(MainActivity.this, "product name successfully set to: "+ productName.getText().toString(), Toast.LENGTH_SHORT).show();
                        }
                        textViewProduct.setText("Scan a product");
                        productId = "scanFirst";
                    }
                },
                new com.android.volley.Response.ErrorListener()
                {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // error
                        Toast.makeText(MainActivity.this, "put error: " + error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }

        ) {
            @Override
            protected Map<String, String> getParams()
            {
                Map<String, String>  params = new HashMap<String, String>();
                String s = productName.getText().toString();
                //String s2 = productID.getText().toString();
                params.put("Name", s);
                if(productId == null || productId.isEmpty()){
                    productId = "scanFirst";
                    return params;
                }else {
                    params.put("Id", productId);
                }
                return params;
            }
        };

        queue.add(putRequest);
        //Toast.makeText(MainActivity.this, "put rq send", Toast.LENGTH_SHORT).show();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        //getMenuInflater().inflate(R.menu.menu_scan, menu);
        getMenuInflater().inflate(R.menu.menu_scan, menu);
        return true;
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement

        if (id==R.id.action_website){
            Intent intent = new Intent(this, WebActivity.class);
            finish();
            startActivity(intent);
        }
        if (id==R.id.action_shopinglist){
            Intent intent = new Intent(this, ShopingListActivity.class);
            finish();
            startActivity(intent);
        }

        return super.onOptionsItemSelected(item);
    }
    public void onActivityResult(int requestCode, int resultCode, Intent intent) {
        IntentResult scanningResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent);
        if (scanningResult != null) {
          scanContent = scanningResult.getContents();
          scanFormat = scanningResult.getFormatName();

            try {
                sendScanData();
            } catch (IOException e) {
                Log.d("testamk","youre here: ERROR msg");
                formatTxt.setText("" + e.toString());
                e.printStackTrace();
            }

        }
        else{
            formatTxt.setText("Error");
        }
    }

    void sendScanData() throws IOException {
        final ProgressDialog progressDialog = new ProgressDialog(MainActivity.this,
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Item wird gespeichert...");
        progressDialog.show();

        //String url ="https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php?func=additem&prefix=%22EAN_8%22&eantoken=12093809&usrid=0";

        new android.os.Handler().postDelayed(
                new Runnable() {
                    @Override
                    public void run() {
                        RequestQueue queue = Volley.newRequestQueue(MainActivity.this);
                        String url = "https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php?func=additem&prefix=" + scanFormat+ "&eantoken=" + scanContent + "&usrid" + "0";
                        JsonObjectRequest jsonRequest = new JsonObjectRequest
                                (com.android.volley.Request.Method.GET, url, null, new com.android.volley.Response.Listener // CHANGES HERE
                                        <JSONObject>() {
                                    @Override
                                    public void onResponse(JSONObject response) {
                                        // the response is already constructed as a JSONObject!
                                        try {

                                            String scan = response.getJSONObject("scan").getJSONObject("n").getString("0");
                                            productId = response.getJSONObject("scan").getString("id");

                                            if (scan != null && !scan.isEmpty()) {
                                                if (scan == "error") {
                                                    scanFailed();
                                                } else {
                                                    textViewProduct.setText("Change product text now!");

                                                    scanWorked(scan);
                                                }
                                            }
                                            if (scan == "noname") {
                                                textViewProduct.setText("Name the product you just scaned.");
                                                productName.setHint("Change name here:");
                                                scanWorked(scan);
                                            }

                                        } catch (JSONException e) {
                                            textViewProduct.setText("Name the product you just scaned.");
                                            productName.setHint("Change name here!");
                                        }
                                    }
                                }, new com.android.volley.Response.ErrorListener // CHANGES HERE
                                        () {

                                    @Override
                                    public void onErrorResponse(VolleyError error) {
                                        Toast.makeText(MainActivity.this, "volley error: " + error.toString(), Toast.LENGTH_SHORT).show();
                                    }
                                });

                        jsonRequest.setRetryPolicy(new

                                                           RetryPolicy() {
                                                               @Override
                                                               public int getCurrentTimeout () {
                                                                   return 50000;
                                                               }

                                                               @Override
                                                               public int getCurrentRetryCount () {
                                                                   return 50000;
                                                               }

                                                               @Override
                                                               public void retry (VolleyError error) throws VolleyError {

                                                               }
                                                           });
                        queue.add(jsonRequest);
                        progressDialog.dismiss();
                    }

    }, 10000);
    }
    private void scanWorked(String scan) {
        Toast.makeText(this, scan + "has been added", Toast.LENGTH_LONG).show();
        productName.setText(scan);

    }

    private void scanFailed() {
        Toast.makeText(this, "scan failed :( try again", Toast.LENGTH_SHORT).show();
    }

}

