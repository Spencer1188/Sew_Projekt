package com.example.barcodereader;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.database.MatrixCursor;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.ListView;
import android.widget.SimpleCursorAdapter;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import okhttp3.HttpUrl;

public class ShopingListActivity extends AppCompatActivity {
    private Toolbar tb;
    private ArrayList<HashMap<String, String>> list=new ArrayList<HashMap<String,String>>();
    public static final String FIRST_COLUMN="First";
    public static final String SECOND_COLUMN="Second";

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_shopinglist);

        tb = (Toolbar) findViewById(R.id.my_toolbar);
        setSupportActionBar(tb);


        delay();


    }

    private void delay(){


        final ProgressDialog progressDialog1 = new ProgressDialog(ShopingListActivity.this, R.style.AppTheme_Dark_Dialog);
        progressDialog1.setIndeterminate(true);
        progressDialog1.setMessage("Shoping List is loading...");
        progressDialog1.show();

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        try{
                           populateList();
                        }
                       catch(Exception e){
                            e.printStackTrace();
                       }

                        progressDialog1.dismiss();
                    }
                }, 5000);
    }

    private void populateList() {
        // TODO Auto-generated method stub



       // final List<HashMap<String, String>> listOfItems = new ArrayList<HashMap<String, String>>();


        try {

            RequestQueue queue = Volley.newRequestQueue(ShopingListActivity.this);
            String url ="https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php?func=getlist&usrid= "+ "0";

            JsonObjectRequest jsonRequest = new JsonObjectRequest
                    (com.android.volley.Request.Method.GET, url, null, new com.android.volley.Response.Listener // CHANGES HERE
                            <JSONObject>() {
                        @Override
                        public void onResponse(JSONObject response) {
                            // the response is already constructed as a JSONObject!
                            if(response != null){
                                try {
                                    int i=0;
                                    String s;
                                    String s2;
                                    HashMap<String,String> hashmap=new HashMap<String, String>();
                                    JSONArray jsArr = response.getJSONArray("items");
                                    for (i = 0; i < jsArr.length(); i++) {
                                        hashmap.clear();
                                        JSONObject listx = jsArr.getJSONObject(i);
                                        s = listx.getString("name");
                                        s2 = listx.getString("anzahl");
                                        s = s.substring(0,15);
                                        hashmap.put(FIRST_COLUMN,s);
                                        hashmap.put(SECOND_COLUMN,s2);
                                        list.add(new HashMap<String, String>(hashmap));

                                        // Toast.makeText(ShopingListActivity.this, "list: + " + list, Toast.LENGTH_SHORT).show();
                                        // Do you fancy stuff
                                        // Example: String gifUrl = jo.getString("url");
                                    }
                                    ListView listView=(ListView)findViewById(R.id.listView1);
                                    ListViewAdapter adapter=new ListViewAdapter(ShopingListActivity.this, list);
                                    listView.setAdapter(adapter);

                                } catch (JSONException e1) {
                                    e1.printStackTrace();
                                    Toast.makeText(ShopingListActivity.this, "JSONERROR", Toast.LENGTH_SHORT).show();
                                }
                            }


                        }
                    }, new com.android.volley.Response.ErrorListener // CHANGES HERE
                            () {

                        @Override
                        public void onErrorResponse(VolleyError error) {
                            error.printStackTrace();
                            Toast.makeText(ShopingListActivity.this, "error response list: " + error.toString(), Toast.LENGTH_LONG).show();

                        }
                    });
            Volley.newRequestQueue(ShopingListActivity.this).add(jsonRequest);
        } catch (Exception e) {
            e.printStackTrace();
            Toast.makeText(this, "volley error: ", Toast.LENGTH_SHORT).show();
        }


/*
        hashmap.put(FIRST_COLUMN, "Allo messaging");
        hashmap.put(SECOND_COLUMN, "google");

        list.add(hashmap);

        HashMap<String,String> hashmap2=new HashMap<String, String>();
        hashmap2.put(FIRST_COLUMN, "Allo messaging");
        hashmap2.put(SECOND_COLUMN, "google");

        list.add(hashmap2);

        HashMap<String,String> hashmap3=new HashMap<String, String>();
        hashmap3.put(FIRST_COLUMN, "Allo messaging");
        hashmap3.put(SECOND_COLUMN, "google");
        list.add(hashmap3);

        HashMap<String,String> hashmap4=new HashMap<String, String>();
        hashmap4.put(FIRST_COLUMN, "Allo messaging");
        hashmap4.put(SECOND_COLUMN, "google");
        list.add(hashmap4);*/

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_list, menu);
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

        if (id==R.id.action_scan){
            Intent intent = new Intent(this, MainActivity.class);
            finish();
            startActivity(intent);
        }

        return super.onOptionsItemSelected(item);
    }


}
