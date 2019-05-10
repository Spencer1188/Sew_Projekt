package com.example.barcodereader;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;

import okhttp3.Call;
import okhttp3.Callback;
import okhttp3.HttpUrl;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;


public class SignupActivity extends AppCompatActivity {
    private static final String TAG = "SignupActivity";

    private EditText _nameText,_emailText,_passwordText;
    private Button _signupButton;
    private TextView _loginLink;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        _nameText = findViewById(R.id.input_name);
        _emailText = findViewById(R.id.input_email);
        _passwordText = findViewById(R.id.input_password);
        _signupButton = findViewById(R.id.btn_signup);
        _loginLink = findViewById(R.id.link_login);

        _signupButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                signup();
            }
        });

        _loginLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Finish the registration screen and return to the Login activity
                finish();
            }
        });
    }

    public void signup() {
        Log.d(TAG, "Signup");

        if (!validate()) {
            onSignupFailed();
            return;
        }

        _signupButton.setEnabled(false);

        final ProgressDialog progressDialog = new ProgressDialog(SignupActivity.this,
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Creating Account...");
        progressDialog.show();



        // TODO: Implement your own signup logic here.

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {
                        String username = _nameText.getText().toString();
                        String email = _emailText.getText().toString();
                        String password = _passwordText.getText().toString();
                        try {
                            OkHttpClient client = new OkHttpClient();

                            HttpUrl.Builder urlBuilder = HttpUrl.parse("https://mgoeckler.ddns.net/Sew_Projekt/web/api/getjson.php").newBuilder();
                            urlBuilder.addQueryParameter("func", "signup");
                            urlBuilder.addQueryParameter("username", username);
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
                                            Log.d("heretestnew", mMessage);
                                            if(mMessage != "error"){
                                                onSignupSuccess();
                                            }else {
                                                onSignupFailed();
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


    public void onSignupSuccess() {
        Log.d("heretestnew","onSignupSuccess");
        _signupButton.setEnabled(true);
        setResult(RESULT_OK, null);
        finish();
    }

    public void onSignupFailed() {
        Toast.makeText(getBaseContext(), "Signup failed", Toast.LENGTH_LONG).show();

        _signupButton.setEnabled(true);
    }

    public boolean validate() {
        boolean valid = true;

        String name = _nameText.getText().toString();
        String email = _emailText.getText().toString();
        String password = _passwordText.getText().toString();

        if (name.isEmpty() || name.length() < 3) {
            _nameText.setError("at least 3 characters");
            valid = false;
        } else {
            _nameText.setError(null);
        }

        if (email.isEmpty() || !android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            _emailText.setError("enter a valid email address");
            valid = false;
        } else {
            _emailText.setError(null);
        }

        if (password.isEmpty() || password.length() < 4 || password.length() > 10) {
            _passwordText.setError("between 4 and 10 alphanumeric characters");
            valid = false;
        } else {
            _passwordText.setError(null);
        }

        return valid;
    }
}