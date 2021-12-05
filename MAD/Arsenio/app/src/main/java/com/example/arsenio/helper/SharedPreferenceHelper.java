package com.example.arsenio.helper;

import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;

public class SharedPreferenceHelper {
    private static SharedPreferenceHelper instance;
    private SharedPreferences sharedPreferences;

    private SharedPreferenceHelper(Context context){
        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(context);
    }

    public static SharedPreferenceHelper getInstance(Context context){
        if(instance == null){
            instance = new SharedPreferenceHelper(context);
        }

        return instance;
    }

    public void saveAccessToken(String token){
        sharedPreferences.edit().putString("pref", token);
    }

    public void saveRefreshToken(String token){
        sharedPreferences.edit().putString("pref", token);
    }

    public String getAccessToken(){
        return sharedPreferences.getString("pref", "");
    }

    public void clearPref(){
        sharedPreferences.edit().clear().apply();
    }
}