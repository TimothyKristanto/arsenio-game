package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;

import com.example.arsenio.repositories.HomeRepository;

public class HomeViewModel extends AndroidViewModel {
    private HomeRepository homeRepository;
    private static final String TAG = "HomeViewModel";

    public HomeViewModel(@NonNull Application application) {
        super(application);
    }

    public void init(String token){
        homeRepository = HomeRepository.getInstance(token);
    }

    public LiveData<String> logout(){
        homeRepository.resetInstance();
        return homeRepository.logout();
    }

    @Override
    protected void onCleared() {
        super.onCleared();
        homeRepository.resetInstance();
    }
}
