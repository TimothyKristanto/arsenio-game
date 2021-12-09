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
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.RegisterResponse;
import com.example.arsenio.viewmodels.AuthViewModel;
import com.google.android.material.textfield.TextInputLayout;

public class RegisterActivity extends AppCompatActivity {

    private TextInputLayout txtInputNamaRegister, txtInputEmailRegister, txtInputPasswordRegister, txtInputKonfirmasiPasswordRegister;
    private Button btnDaftarRegister;
    private TextView txtLoginRegister;

    private static final String TAG = "RegisterActivity";

    private SharedPreferenceHelper sharedPreferenceHelper;
    private AuthViewModel authViewModel;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        hideSystemBars();
        initView();
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

    private void setListener() {
        btnDaftarRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String nama = txtInputNamaRegister.getEditText().getText().toString().trim();
                String email = txtInputEmailRegister.getEditText().getText().toString().trim();
                String password = txtInputPasswordRegister.getEditText().getText().toString();
                String konfirmasiPassword = txtInputKonfirmasiPasswordRegister.getEditText().getText().toString();

                if(!TextUtils.isEmpty(nama) && !TextUtils.isEmpty(email) && !TextUtils.isEmpty(password) && !TextUtils.isEmpty(konfirmasiPassword)){
                    authViewModel.register(nama, email, password, konfirmasiPassword).observe(RegisterActivity.this, showRegisterResult);
                }else{
                    Toast.makeText(RegisterActivity.this, "Semua data harus diisi!", Toast.LENGTH_SHORT).show();
                }
            }
        });

        txtLoginRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
                finish();
            }
        });
    }

    private Observer<RegisterResponse> showRegisterResult = new Observer<RegisterResponse>() {
        @Override
        public void onChanged(RegisterResponse registerResponse) {
            if(registerResponse != null) {
                Toast.makeText(RegisterActivity.this, "Register berhasil!", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
                finish();
            }else{
                Toast.makeText(RegisterActivity.this, "Register gagal!", Toast.LENGTH_SHORT).show();
            }
        }
    };

    private void initView() {
        txtInputNamaRegister = findViewById(R.id.txtInputNamaRegister);
        txtInputEmailRegister = findViewById(R.id.txtInputEmailRegister);
        txtInputPasswordRegister = findViewById(R.id.txtInputPasswordRegister);
        txtInputKonfirmasiPasswordRegister = findViewById(R.id.txtInputKonfirmasiPasswordRegister);
        btnDaftarRegister = findViewById(R.id.btnDaftarRegister);
        txtLoginRegister = findViewById(R.id.txtLoginRegister);

        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(RegisterActivity.this);
        authViewModel = new ViewModelProvider(RegisterActivity.this).get(AuthViewModel.class);
    }
}