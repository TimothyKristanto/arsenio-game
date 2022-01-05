package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.BattlePlayerEnemy;
import com.example.arsenio.models.BattleQuestion;
import com.example.arsenio.retrofit.APIService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class BattleRepository {
    private static BattleRepository battleRepository;
    private APIService apiService;
    private static final String TAG = "BattleRepository";

    private BattleRepository(String token){
        apiService = APIService.getInstance(token);
    }

    public static BattleRepository getInstance(String token){
        if(battleRepository == null){
            battleRepository = new BattleRepository(token);
        }

        return battleRepository;
    }

    public synchronized void resetInstance(){
        if(battleRepository != null){
            battleRepository = null;
        }
    }

    public MutableLiveData<BattleQuestion> getBattleQuestion(int levelId, int questionIndex){
        MutableLiveData<BattleQuestion> result = new MutableLiveData<>();

        apiService.getBattleQuestion(levelId, questionIndex).enqueue(new Callback<BattleQuestion>() {
            @Override
            public void onResponse(Call<BattleQuestion> call, Response<BattleQuestion> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        result.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<BattleQuestion> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return result;
    }

    public MutableLiveData<BattlePlayerEnemy> getBattle(int levelId){
        MutableLiveData<BattlePlayerEnemy> result = new MutableLiveData<>();

        apiService.getBattle(levelId).enqueue(new Callback<BattlePlayerEnemy>() {
            @Override
            public void onResponse(Call<BattlePlayerEnemy> call, Response<BattlePlayerEnemy> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        result.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<BattlePlayerEnemy> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return result;
    }
}
