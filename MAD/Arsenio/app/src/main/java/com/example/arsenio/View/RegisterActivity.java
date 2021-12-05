package com.example.arsenio.View;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.example.arsenio.R;

public class RegisterActivity extends AppCompatActivity {

    TextView TextBtnMoveLogin;
    Button ButtonDaftarRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        onClickListener();

    }

    private void onClickListener() {
        initView();
        TextBtnMoveLogin.setOnClickListener(v -> {
            Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
            startActivity(intent);
            finish();
        });

        ButtonDaftarRegister.setOnClickListener(v -> {
            //Register Logic
        });
    }

    private void initView() {
        TextBtnMoveLogin = findViewById(R.id.TextBtnMoveLogin);
        ButtonDaftarRegister = findViewById(R.id.ButtonDaftarRegister);
    }
}