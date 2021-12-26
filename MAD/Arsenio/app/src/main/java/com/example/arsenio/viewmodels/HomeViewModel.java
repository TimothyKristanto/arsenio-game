package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Home;
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

    private MutableLiveData<Home> resultHome = new MutableLiveData<>();

    public void getHome(){
        resultHome = homeRepository.getHome();
    }

    public LiveData<Home> getHomeResult(){
        return resultHome;
    }

    @Override
    protected void onCleared() {
        super.onCleared();
        homeRepository.resetInstance();
    }
}
