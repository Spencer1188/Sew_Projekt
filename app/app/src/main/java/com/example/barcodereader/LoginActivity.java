package com.example.barcodereader;

import android.support.v7.app.AppCompatActivity;



import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;

import android.content.Intent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONObject;

import java.io.IOException;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.Headers;
import okhttp3.HttpUrl;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import okhttp3.ResponseBody;

//https://www.studytutorial.in/android-okhttp-post-and-get-request-tutorial
public class LoginActivity extends AppCompatActivity {
    private static final String TAG = "LoginActivity";
    private static final int REQUEST_SIGNUP = 0;
    private EditText _emailText,_passwordText;
    private Button _loginButton;
    private TextView _signupLink;

    public String mMessage;



    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        _emailText = findViewById(R.id.input_email);
        _passwordText = findViewById(R.id.input_password);
        _loginButton = findViewById(R.id.btn_login);
        _signupLink = findViewById(R.id.link_signup);

        _loginButton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                login();
            }
        });

        _signupLink.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // Start the Signup activity
                Intent intent = new Intent(getApplicationContext(), SignupActivity.class);
                startActivityForResult(intent, REQUEST_SIGNUP);
            }
        });
    }

    public void login() {
        Log.d(TAG, "Login");

        if (!validate()) {
            onLoginFailed();
            return;
        }

        _loginButton.setEnabled(false);

        final ProgressDialog progressDialog = new ProgressDialog(LoginActivity.this,
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Authenticating...");
        progressDialog.show();



        // TODO: Implement your own authentication logic here.

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        String email = _emailText.getText().toString();
                        String password = _passwordText.getText().toString();
                        try {
                            OkHttpClient client = new OkHttpClient();

                            HttpUrl.Builder urlBuilder = HttpUrl.parse("https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php").newBuilder();
                            urlBuilder.addQueryParameter("func", "login");
                            urlBuilder.addQueryParameter("mail", email);
                            urlBuilder.addQueryParameter("password", password);
                            String url = urlBuilder.build().toString();

                            Request request = new Request.Builder()
                                    .url(url)
                                    .build();

                            client.newCall(request).enqueue(new Callback() {
                                @Override
                                public void onFailure(Call call, IOException e) {
                                    mMessage = e.getMessage().toString();
                                    Log.w("failure Response", mMessage);
                                    //call.cancel();
                                }

                                @Override
                                public void onResponse(Call call, Response response) throws IOException {

                                    mMessage = response.body().string();
                                    if (response.isSuccessful()){

                                        try {

                                            if(mMessage != "error"){
                                                onLoginSuccess();
                                            }else {
                                                onLoginFailed();
                                            }

                                        } catch (Exception e){
                                            e.printStackTrace();
                                        }

                                    }
                                }
                            });
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                        progressDialog.dismiss();
                    }
                }, 3000);
    }


    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == REQUEST_SIGNUP) {
            if (resultCode == RESULT_OK) {
                Log.d("heretestnew","kummsther?");// TODO: Implement successful signup logic here
                // By default we just finish the Activity and log them in automatically
                // probably load webview
                this.finish();
            }
        }
    }

    @Override
    public void onBackPressed() {
        // disable going back to the MainActivity
        moveTaskToBack(true);
    }

    public void onLoginSuccess() {
        Toast.makeText(getBaseContext(), "Login success", Toast.LENGTH_LONG).show();
        Log.d("heretestnew","onLoginSuccess");
        Intent intent = new Intent(this, WebActivity.class);
        finish();
        startActivity(intent);
        _loginButton.setEnabled(true);

    }

    public void onLoginFailed() {
        Toast.makeText(getBaseContext(), "Login failed: " + mMessage, Toast.LENGTH_LONG).show();

    }

    public boolean validate() {
        boolean valid = true;

        String email = _emailText.getText().toString();
        String password = _passwordText.getText().toString();

        if (email.isEmpty() || !android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            _emailText.setError("enter a valid email address");
            valid = false;
        } else {
            _emailText.setError(null);
        }

        if (password.isEmpty() || password.length() < 1 || password.length() > 10) {
            _passwordText.setError("between 1 and 10 alphanumeric characters");
            valid = false;
        } else {
            _passwordText.setError(null);
        }

        return valid;
    }

}
 /*class AsynchronousGet {
    private final OkHttpClient client = new OkHttpClient();

    public void run(String email,String password) throws Exception {


        OkHttpClient client = new OkHttpClient();

        HttpUrl.Builder urlBuilder = HttpUrl.parse("https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php").newBuilder();
        urlBuilder.addQueryParameter("func", "login");
        urlBuilder.addQueryParameter("mail", email);
        urlBuilder.addQueryParameter("password", password);
        String url = urlBuilder.build().toString();

        Request request = new Request.Builder()
                .url(url)
                .build();

        client.newCall(request).enqueue(new Callback() {
            @Override
            public void onFailure(Call call, IOException e) {
                String mMessage = e.getMessage().toString();
                Log.w("failure Response", mMessage);
                //call.cancel();
            }

            @Override
            public void onResponse(Call call, Response response) throws IOException {

                String mMessage = response.body().string();
                if (response.isSuccessful()){

                    try {
                        Log.d("heretest",""+ mMessage);
                        if(mMessage != "error"){
                            new LoginActivity().onLoginSuccess();
                        }else {

                        }

                    } catch (Exception e){
                        e.printStackTrace();
                    }

                }
            }
        });
    }

}*/