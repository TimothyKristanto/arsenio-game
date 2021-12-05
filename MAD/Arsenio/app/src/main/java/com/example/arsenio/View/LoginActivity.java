package com.example.arsenio.View;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.example.arsenio.R;

public class LoginActivity extends AppCompatActivity {

    TextView textBtnMoveRegister;
    Button buttonMasukLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        onClickListener();

    }

    public void onClickListener(){
        initView();
        textBtnMoveRegister.setOnClickListener(v -> {
            Intent intent = new Intent(getApplicationContext(), RegisterActivity.class);
            startActivity(intent);
            finish();
        });

        buttonMasukLogin.setOnClickListener(v -> {
            //Login Logic
        });
    }

    private void initView() {
        textBtnMoveRegister = findViewById(R.id.textBtnMoveRegister);
        buttonMasukLogin = findViewById(R.id.buttonMasukLogin);
    }
}