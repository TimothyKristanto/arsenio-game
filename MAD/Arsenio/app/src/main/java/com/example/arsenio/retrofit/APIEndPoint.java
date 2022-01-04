package com.example.arsenio.retrofit;

import com.example.arsenio.models.Abyss;
import com.example.arsenio.models.Home;
import com.example.arsenio.models.RegisterResponse;
import com.example.arsenio.models.Shop;
import com.example.arsenio.models.Story;
import com.example.arsenio.models.TokenResponse;
import com.google.gson.JsonObject;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

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


    @GET("story/{id}")
    Call<Story> getStory(@Path("id") int id);
    
    @GET("abyss")
    Call<Abyss> getAbyss();

    @GET("shop")
    Call<Shop> getItems();

    @GET("buy/{item_id}/{item_owned}/{golds}")
    Call<JsonObject> updateItemStudent(
            @Path("item_id") int item_id, // 1-3
            @Path("item_owned") int item_owned,
            @Path("golds") int golds);

//    @PUT("shop/{shop}")
//    Call<Shop.Navbar> updateGold(
//            @Path("shop") int item_id,
//            @Field("golds") int golds);
}
