package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.RegisterResponse;
import com.example.arsenio.models.TokenResponse;
import com.example.arsenio.repositories.AuthRepository;

public class AuthViewModel extends AndroidViewModel {
    private AuthRepository authRepository;

    public AuthViewModel(@NonNull Application application) {
        super(application);

        authRepository = AuthRepository.getInstance();
    }

    public MutableLiveData<TokenResponse> login(String email, String password){
        return authRepository.login(email, password);
    }

    public MutableLiveData<RegisterResponse> register(String name, String email, String password, String confirmPassword){
        return authRepository.register(name, email, password, confirmPassword);
    }


}
