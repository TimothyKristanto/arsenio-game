package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Story;
import com.example.arsenio.retrofit.APIService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class StoryRepository {
    private static StoryRepository storyRepository;
    private APIService apiService;
    private static final String TAG = "StoryRepository";

    private StoryRepository(String token){
        apiService = APIService.getInstance(token);
    }

    public static StoryRepository getInstance(String token){
        if(storyRepository == null){
            storyRepository = new StoryRepository(token);
        }

        return storyRepository;
    }

    public synchronized void resetInstance(){
        if(storyRepository != null){
            storyRepository = null;
        }
    }

    public MutableLiveData<Story> getStory(int id){
        MutableLiveData<Story> result = new MutableLiveData<>();

        apiService.getStory(id).enqueue(new Callback<Story>() {
            @Override
            public void onResponse(Call<Story> call, Response<Story> response) {
                if (response.isSuccessful()){
                    Log.d(TAG, "onResponse: " + response.code());
                   if (response.body() != null){
                       result.postValue(response.body());
                   }
                }
            }

            @Override
            public void onFailure(Call<Story> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });
        return result;
    }
}
