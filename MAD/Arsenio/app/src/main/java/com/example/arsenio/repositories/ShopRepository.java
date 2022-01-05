package com.example.arsenio.repositories;

import android.util.Log;

import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Shop;
import com.example.arsenio.retrofit.APIService;
import com.google.gson.Gson;
import com.google.gson.JsonObject;

import org.json.JSONException;
import org.json.JSONObject;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ShopRepository {

    private static ShopRepository shopRepository;
    private APIService apiService;
    private static final String TAG = "ShopRepository";

    private ShopRepository (String token){
        apiService = APIService.getInstance(token);
    }

    public static ShopRepository getInstance(String token){
        if(shopRepository == null){
            shopRepository = new ShopRepository(token);
        }

        return shopRepository;
    }

    public synchronized void resetInstance(){
        if(shopRepository != null){
            shopRepository = null;
        }
    }

    //getItems
    public MutableLiveData<Shop> getItems(){
        MutableLiveData<Shop> getItemsResult = new MutableLiveData<>();

        apiService.getItems().enqueue(new Callback<Shop>() {
            @Override
            public void onResponse(Call<Shop> call, Response<Shop> response) {
                if(response.isSuccessful()){
                    if(response.body() != null){
                        getItemsResult.postValue(response.body());
                    }
                }
            }

            @Override
            public void onFailure(Call<Shop> call, Throwable t) {
                Log.e(TAG, "onFailure: " + t.getMessage());
            }
        });

        return getItemsResult;
    }

    //updateItemStudent
//    public MutableLiveData<Shop.ItemStudent> updateItemStudent(int id, int item_owned){
//        MutableLiveData<Shop.ItemStudent> updateItemStudentResult = new MutableLiveData<>();
//        apiService.updateItemStudent(id, item_owned).enqueue(new Callback<Shop.ItemStudent>() {
//            @Override
//            public void onResponse(Call<Shop.ItemStudent> call, Response<Shop.ItemStudent> response) {
//
//            }
//
//            @Override
//            public void onFailure(Call<Shop.ItemStudent> call, Throwable t) {
//
//            }
//        });
//
//
//        return updateItemStudentResult;
//    }

    public MutableLiveData<String> updateItemStudent(int item_id, int item_owned, int golds){
        MutableLiveData<String> updateItemStudentResult = new MutableLiveData<>();
        apiService.updateItemStudent(item_id, item_owned, golds).enqueue(new Callback<JsonObject>() {
            @Override
            public void onResponse(Call<JsonObject> call, Response<JsonObject> response) {
                if (response.isSuccessful()) {
                    if (response.body() != null) {
                        try {
                            JSONObject object = new JSONObject(new Gson().toJson(response.body()));
                            String msg = object.getString("message");
                            Log.d(TAG, "onResponse: " + msg);
                            updateItemStudentResult.postValue(msg);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }
            }
            @Override
            public void onFailure(Call<JsonObject> call, Throwable t) {
                Log.e(TAG, "onFailure: "+ t.getMessage());
            }
        });
        return updateItemStudentResult;
    }
}
