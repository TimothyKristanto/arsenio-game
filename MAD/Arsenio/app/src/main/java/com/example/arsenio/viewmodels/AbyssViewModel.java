package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Abyss;
import com.example.arsenio.repositories.AbyssRepository;

public class AbyssViewModel extends AndroidViewModel {
    private AbyssRepository abyssRepository;
    private static final String TAG = "AbyssViewModel";

    public AbyssViewModel(@NonNull Application application) {
        super(application);
    }

    public void init(String token){
        abyssRepository = AbyssRepository.getInstance(token);
    }

    private MutableLiveData<Abyss> resultAbyss = new MutableLiveData<>();

    public void getAbyss(){
        resultAbyss = abyssRepository.getAbyss();
    }

    public LiveData<Abyss> getAbyssResult(){
        return resultAbyss;
    }

    @Override
    protected void onCleared() {
        super.onCleared();
        abyssRepository.resetInstance();
    }
}
