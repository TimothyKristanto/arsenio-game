package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.RegisterResponse;
import com.example.arsenio.models.TokenResponse;
import com.example.arsenio.retrofit.APIService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class AuthRepository {
    private APIService apiService;
    private static AuthRepository authRepository;
    private static final String TAG = "AuthRepository";

    private AuthRepository(){
        apiService = APIService.getInstance("");
    }

    public static AuthRepository getInstance(){
        if(authRepository == null){
            authRepository = new AuthRepository();
        }

        return authRepository;
    }

    public MutableLiveData<RegisterResponse> register(String name, String email, String password, String confirmPassword){
        final MutableLiveData<RegisterResponse> registerResult = new MutableLiveData<>();

        apiService.register(name, email, password, confirmPassword).enqueue(new Callback<RegisterResponse>() {
            @Override
            public void onResponse(Call<RegisterResponse> call, Response<RegisterResponse> response) {
                if(response.isSuccessful()){
                    if(response.code() == 200){
                        Log.d(TAG, "onResponse: " + response.code());

                        if(response.body() != null){
                            Log.d(TAG, "onResponse: " + response.body());
                            registerResult.postValue(response.body());
                        }
                    }
                }else{
                    Log.d(TAG, "onResponse: " + response.code());
                }

            }

            @Override
            public void onFailure(Call<RegisterResponse> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return registerResult;
    }

    public MutableLiveData<TokenResponse> login(String email, String password){
        final MutableLiveData<TokenResponse> loginResult = new MutableLiveData<>();

        apiService.login(email, password).enqueue(new Callback<TokenResponse>() {
            @Override
            public void onResponse(Call<TokenResponse> call, Response<TokenResponse> response) {
                if(response.isSuccessful()){
                    if(response.code() == 200){
                        if(response.body() != null){
                            Log.d(TAG, "onResponse: " + response.body().getAccess_token());
                            loginResult.postValue(response.body());
                        }
                    }
                }else{
                    Log.d(TAG, "onResponse: " + response.code());
                }
            }

            @Override
            public void onFailure(Call<TokenResponse> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return loginResult;
    }
}
