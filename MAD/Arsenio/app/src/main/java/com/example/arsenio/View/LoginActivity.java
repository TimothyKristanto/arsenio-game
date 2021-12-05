package com.example.arsenio.View;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.ViewModel;
import androidx.lifecycle.ViewModelProvider;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.viewmodels.AuthViewModel;
import com.google.android.material.textfield.TextInputLayout;

public class LoginActivity extends AppCompatActivity {

    private TextInputLayout txtInputEmailLogin, txtInputPasswordLogin;
    private Button btnMasukLogin;
    private TextView txtDaftarLogin;

    private static final String TAG = "LoginActivity";

    private SharedPreferenceHelper sharedPreferenceHelper;
    private AuthViewModel authViewModel;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        initView();
        setListener();
    }

    public void setListener(){
        btnMasukLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

            }
        });

        txtDaftarLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginActivity.this, RegisterActivity.class);
                startActivity(intent);
            }
        });
    }

    private void initView() {
        txtInputEmailLogin = findViewById(R.id.txtInputEmailLogin);
        txtInputPasswordLogin = findViewById(R.id.txtInputPasswordLogin);
        btnMasukLogin = findViewById(R.id.btnMasukLogin);
        txtDaftarLogin = findViewById(R.id.txtDaftarLogin);

        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(LoginActivity.this);
        authViewModel = new ViewModelProvider(LoginActivity.this).get(AuthViewModel.class);
    }
}