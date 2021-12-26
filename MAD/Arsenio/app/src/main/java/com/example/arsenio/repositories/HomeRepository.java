package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Home;
import com.example.arsenio.retrofit.APIService;
import com.google.gson.Gson;
import com.google.gson.JsonObject;

import org.json.JSONException;
import org.json.JSONObject;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HomeRepository {
    private static HomeRepository homeRepository;
    private APIService apiService;
    private static final String TAG = "HomeRepository";

    private HomeRepository(String token){
        apiService = APIService.getInstance(token);
    }

    public static HomeRepository getInstance(String token){
        if(homeRepository == null){
            homeRepository = new HomeRepository(token);
        }

        return homeRepository;
    }

    public synchronized void resetInstance(){
        if(homeRepository != null){
            homeRepository = null;
        }
    }

    public LiveData<String> logout(){
        MutableLiveData<String> logoutResult = new MutableLiveData<>();

        apiService.logout().enqueue(new Callback<JsonObject>() {
            @Override
            public void onResponse(Call<JsonObject> call, Response<JsonObject> response) {
                if(response.isSuccessful()){
                    Log.d(TAG, "onResponse: " + response.code());
                    if(response.body() != null){
                        try{
                            JSONObject object = new JSONObject(new Gson().toJson(response.body()));
                            String msg = object.getString("message");
                            Log.d(TAG, "onResponse: " + msg);
                            logoutResult.postValue(msg);
                        }catch (JSONException e){
                            e.printStackTrace();
                        }
                    }
                }
            }

            @Override
            public void onFailure(Call<JsonObject> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return logoutResult;
    }

    public MutableLiveData<Home> getHome(){
        MutableLiveData<Home> getHomeResult = new MutableLiveData<>();

        apiService.getHome().enqueue(new Callback<Home>() {
            @Override
            public void onResponse(Call<Home> call, Response<Home> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        getHomeResult.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<Home> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return getHomeResult;
    }
}
