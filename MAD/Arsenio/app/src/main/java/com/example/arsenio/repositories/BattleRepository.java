package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.BattlePlayerEnemy;
import com.example.arsenio.models.BattleQuestion;
import com.example.arsenio.models.BattleReward;
import com.example.arsenio.retrofit.APIService;
import com.google.gson.Gson;
import com.google.gson.JsonObject;

import org.json.JSONException;
import org.json.JSONObject;

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
                    Log.d(TAG, "onResponse: " + response.code());
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

    public MutableLiveData<BattleReward> updateBattleStudentData(int levelId){
        MutableLiveData<BattleReward> result = new MutableLiveData<>();

        apiService.updateBattleStudentData(levelId).enqueue(new Callback<BattleReward>() {
            @Override
            public void onResponse(Call<BattleReward> call, Response<BattleReward> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        result.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<BattleReward> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return result;
    }

    public MutableLiveData<BattleQuestion> getAbyssBattleQuestion(int questionIndex){
        MutableLiveData<BattleQuestion> result = new MutableLiveData<>();

        apiService.getAbyssBattleQuestion(questionIndex).enqueue(new Callback<BattleQuestion>() {
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

    public MutableLiveData<BattleReward> updateAbyssBattleStudentData(long battleScore){
        MutableLiveData<BattleReward> result = new MutableLiveData<>();

        apiService.updateAbyssBattleStudentData(battleScore).enqueue(new Callback<BattleReward>() {
            @Override
            public void onResponse(Call<BattleReward> call, Response<BattleReward> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        result.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<BattleReward> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return result;
    }

    public MutableLiveData<String> updateStudentBattleItem(int bandageAmount, int jamuAmount, int hourglassAmount){
        MutableLiveData<String> result = new MutableLiveData<>();

        apiService.updateStudentBattleItem(bandageAmount, jamuAmount, hourglassAmount).enqueue(new Callback<JsonObject>() {
            @Override
            public void onResponse(Call<JsonObject> call, Response<JsonObject> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        try{
                            JSONObject object = new JSONObject(new Gson().toJson(response.body()));
                            String msg = object.getString("message");
                            Log.d(TAG, "onResponse: " + msg);
                            result.postValue(msg);
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

        return result;
    }
}
