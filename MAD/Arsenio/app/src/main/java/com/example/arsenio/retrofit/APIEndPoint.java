package com.example.arsenio.retrofit;

import com.example.arsenio.models.Abyss;
import com.example.arsenio.models.BattlePlayerEnemy;
import com.example.arsenio.models.BattleQuestion;
import com.example.arsenio.models.BattleReward;
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
  
    @GET("battle/{levelId}/{questionIndex}")
    Call<BattleQuestion> getBattleQuestion(@Path("levelId") int levelId, @Path("questionIndex") int questionIndex);

    @GET("battle/{levelId}")
    Call<BattlePlayerEnemy> getBattle(@Path("levelId") int levelId);

    @POST("battle/{levelId}")
    Call<BattleReward> updateBattleStudentData(@Path("levelId") int levelId);

    @GET("abyss/battle/{questionIndex}")
    Call<BattleQuestion> getAbyssBattleQuestion(@Path("questionIndex") int questionIndex);

    @POST("abyss/battle/{battleScore}")
    Call<BattleReward> updateAbyssBattleStudentData(@Path("battleScore") long battleScore);
}
