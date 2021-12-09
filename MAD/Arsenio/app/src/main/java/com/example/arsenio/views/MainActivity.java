package com.example.arsenio.views;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.core.view.WindowInsetsControllerCompat;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModel;
import androidx.lifecycle.ViewModelProvider;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.viewmodels.HomeViewModel;

public class MainActivity extends AppCompatActivity {
    private Button btnLogoutMain;

    private SharedPreferenceHelper sharedPreferenceHelper;
    private HomeViewModel homeViewModel;

    private static final String TAG = "MainActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        initView();
        setListener();
        hideSystemBars();

        Log.d(TAG, "token: " + sharedPreferenceHelper.getAccessToken());
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
        btnLogoutMain.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                homeViewModel.logout().observe(MainActivity.this, showLogoutResult);
            }
        });
    }

    private Observer<String> showLogoutResult = new Observer<String>() {
        @Override
        public void onChanged(String s) {
            if(s != null){
                sharedPreferenceHelper.clearPref();
                Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(intent);
                finish();
            }
        }
    };

    private void initView() {
        btnLogoutMain = findViewById(R.id.btnLogoutMain);

        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(MainActivity.this);
        homeViewModel = new ViewModelProvider(MainActivity.this).get(HomeViewModel.class);
        homeViewModel.init(sharedPreferenceHelper.getAccessToken());
    }
}