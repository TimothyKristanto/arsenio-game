package com.example.arsenio.views;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.core.view.WindowInsetsControllerCompat;
import androidx.navigation.NavController;
import androidx.navigation.fragment.NavHostFragment;

import android.os.Bundle;
import android.view.View;

import com.example.arsenio.R;

public class MainActivity extends AppCompatActivity {
    private NavHostFragment navHostFragmentMain;
    private NavController navControllerMain;
    private static final String TAG = "MainActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        initView();
        hideSystemBars();
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

    private void initView() {
        navHostFragmentMain = (NavHostFragment) getSupportFragmentManager().findFragmentById(R.id.fragmentContainerViewMain);
        navControllerMain = navHostFragmentMain.getNavController();
    }
}