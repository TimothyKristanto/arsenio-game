package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Abyss;
import com.example.arsenio.models.Home;
import com.example.arsenio.retrofit.APIService;
import com.google.gson.Gson;
import com.google.gson.JsonObject;

import org.json.JSONException;
import org.json.JSONObject;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class AbyssRepository {
    private static AbyssRepository abyssRepository;
    private APIService apiService;
    private static final String TAG = "AbyssRepository";

    private AbyssRepository(String token){
        apiService = APIService.getInstance(token);
    }

    public static AbyssRepository getInstance(String token){
        if(abyssRepository == null){
            abyssRepository = new AbyssRepository(token);
        }

        return abyssRepository;
    }

    public synchronized void resetInstance(){
        if(abyssRepository != null){
            abyssRepository = null;
        }
    }

    public MutableLiveData<Abyss> getAbyss(){
        MutableLiveData<Abyss> getAbyssResult = new MutableLiveData<>();

        apiService.getAbyss().enqueue(new Callback<Abyss>() {
            @Override
            public void onResponse(Call<Abyss> call, Response<Abyss> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        getAbyssResult.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<Abyss> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return getAbyssResult;
    }
}
