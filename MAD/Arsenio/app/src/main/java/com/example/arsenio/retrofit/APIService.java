package com.example.arsenio.retrofit;

import android.media.session.MediaSession;

import com.example.arsenio.helper.Const;
import com.example.arsenio.models.Home;
import com.example.arsenio.models.RegisterResponse;
import com.example.arsenio.models.Story;
import com.example.arsenio.models.TokenResponse;
import com.google.gson.JsonObject;

import okhttp3.OkHttpClient;
import okhttp3.Request;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class APIService {
    private final APIEndPoint apiEndPoint;
    private static APIService apiService;

    public APIService(String token){
        OkHttpClient.Builder client = new OkHttpClient.Builder();

        if(token.equals("")){
            client.addInterceptor(chain -> {
                Request request = chain.request().newBuilder()
                        .addHeader("Accept", "application/json")
                        .build();

                return chain.proceed(request);
            });
        }else{
            client.addInterceptor(chain -> {
                Request request = chain.request().newBuilder()
                        .addHeader("Accept", "application/json")
                        .addHeader("Authorization", token)
                        .build();

                return chain.proceed(request);
            });
        }

        apiEndPoint = new Retrofit.Builder()
                .baseUrl(Const.BASE_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .client(client.build())
                .build().create(APIEndPoint.class);
    }

    public static APIService getInstance(String token){
        if(apiService == null){
            apiService = new APIService(token);
        }else if(!token.equals("")){
            apiService = new APIService(token);
        }

        return apiService;
    }

    public Call<RegisterResponse> register(String name, String email, String password, String confirmPassword){
        return apiEndPoint.register(name, email, password, confirmPassword);
    }

    public Call<TokenResponse> login(String email, String password){
        return apiEndPoint.login(email, password);
    }

    public Call<JsonObject> logout(){
        return apiEndPoint.logout();
    }

    public Call<Home> getHome(){
        return apiEndPoint.getHome();
    }

    public Call<Story> getStory(int id){return apiEndPoint.getStory(id);}
}
