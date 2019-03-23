package com.example.barcodereader;

import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import java.util.ArrayList;

public class Send_Scan_Data extends AsyncTask<String, Void, String> {

    @Override
    protected String doInBackground(String... data) {

        // 1) Connect via HTTP. 2) Encode data. 3) Send data.
        ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(7);
        nameValuePairs.add(new BasicNameValuePair("prefix", data[0]));
        nameValuePairs.add(new BasicNameValuePair("token",data[1]));

        try
        {
            HttpClient httpclient = new DefaultHttpClient();
            HttpPost httppost = new HttpPost("https://mgoeckler.ddns.net/sew-web/api/getjson.php");
            httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));
            HttpResponse response = httpclient.execute(httppost);
            Log.e("log_tag", "OKK:  "+response.getStatusLine().toString());
            Log.e("log_tag", "OKK2:  "+response.getLocale());
            //Could do something better with response.
        }
        catch(Exception e)
        {
            Log.e("log_tag", "Error:  "+e.toString());
        }

        return null;
    }
}



