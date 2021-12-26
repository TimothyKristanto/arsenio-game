package com.example.arsenio.views;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.core.view.WindowInsetsControllerCompat;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProvider;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.TokenResponse;
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
        hideSystemBars();
        setListener();
    }

    private void hideSystemBars() {
        View window = getWindow().getDecorView();

        WindowInsetsControllerCompat windowInsetsController =
                ViewCompat.getWindowInsetsController(window);
        if (windowInsetsController == null) {
            return;
        }
        // Configure the behavior of the hidden system bars
        windowInsetsController.setSystemBarsBehavior(
                WindowInsetsControllerCompat.BEHAVIOR_SHOW_TRANSIENT_BARS_BY_SWIPE
        );
        // Hide both the status bar and the navigation bar
        windowInsetsController.hide(WindowInsetsCompat.Type.systemBars());
    }

    private Observer<TokenResponse> showLoginResult = new Observer<TokenResponse>() {
        @Override
        public void onChanged(TokenResponse tokenResponse) {
            if(tokenResponse != null) {
                sharedPreferenceHelper.saveAccessToken(tokenResponse.getAuthorization());
                Log.d(TAG, "token: " + sharedPreferenceHelper.getAccessToken());
                Toast.makeText(LoginActivity.this, "Login berhasil!", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
                finish();
            }else{
                Toast.makeText(LoginActivity.this, "Login gagal!", Toast.LENGTH_SHORT).show();
            }
        }
    };

    public void setListener(){
        btnMasukLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String email = txtInputEmailLogin.getEditText().getText().toString().trim();
                String password = txtInputPasswordLogin.getEditText().getText().toString();

                if(!TextUtils.isEmpty(email) && !TextUtils.isEmpty(password)){
                    authViewModel.login(email, password).observe(LoginActivity.this, showLoginResult);
                }else{
                    Toast.makeText(LoginActivity.this, "Semua data harus diisi!", Toast.LENGTH_SHORT).show();
                }
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

        if(!sharedPreferenceHelper.getAccessToken().isEmpty()){
            Intent intent = new Intent(LoginActivity.this, MainActivity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            startActivity(intent);
            finish();
        }

        authViewModel = new ViewModelProvider(LoginActivity.this).get(AuthViewModel.class);
    }
}