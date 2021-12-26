package com.example.arsenio.retrofit;

import com.example.arsenio.models.Home;
import com.example.arsenio.models.RegisterResponse;
import com.example.arsenio.models.TokenResponse;
import com.google.gson.JsonObject;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;

public interface APIEndPoint {
    @POST("login")
    @FormUrlEncoded
    Call<TokenResponse> login(@Field("email") String email,
                              @Field("password") String password);

    @POST("register")
    @FormUrlEncoded
    Call<RegisterResponse> register(@Field("name") String name,
                                    @Field("email") String email,
                                    @Field("password") String password,
                                    @Field("confirmPassword") String confirmPassword);

    @POST("logout")
    Call<JsonObject> logout();

    @GET("home")
    Call<Home> getHome();
}
