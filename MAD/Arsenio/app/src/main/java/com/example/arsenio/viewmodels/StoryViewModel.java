package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Home;
import com.example.arsenio.models.Story;
import com.example.arsenio.repositories.HomeRepository;
import com.example.arsenio.repositories.StoryRepository;

public class StoryViewModel extends AndroidViewModel {
    private StoryRepository storyRepository;
    private static final String TAG = "StoryViewModel";

    public StoryViewModel(@NonNull Application application) {
        super(application);
    }

    public void init(String token){
        storyRepository = StoryRepository.getInstance(token);
    }

    private MutableLiveData<Story> resultStory = new MutableLiveData<>();

    public void getStory(String id){
        resultStory = storyRepository.getStory(id);
    }

    public LiveData<Story> getStoryResult(){
        return resultStory;
    }

    @Override
    protected void onCleared() {
        super.onCleared();
        storyRepository.resetInstance();
    }
}
