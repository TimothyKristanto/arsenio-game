package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.Shop;
import com.example.arsenio.models.Story;
import com.example.arsenio.repositories.ShopRepository;
import com.example.arsenio.repositories.StoryRepository;

public class ShopViewModel extends AndroidViewModel {
    private ShopRepository shopRepository;
    private static final String TAG = "ShopViewModel";

    public ShopViewModel(@NonNull Application application) { super(application); }

    public void init(String token){
        shopRepository = ShopRepository.getInstance(token);
    }

    // Get Items
    private MutableLiveData<Shop> resultItems = new MutableLiveData<>();
    public void getItems(){
        resultItems = shopRepository.getItems();
    }
    public LiveData<Shop> getItemsResult(){
        return resultItems;
    }

    // Update Item Student

    public MutableLiveData<String> updateItemStudent (int item_id, int item_owned, int golds){
        return shopRepository.updateItemStudent(item_id, item_owned, golds);
    }
//    private MutableLiveData<Shop.ItemStudent> resultUpdateItemStudent = new MutableLiveData<>();
//    public void updateItemStudent (int id, Shop.ItemStudent itemStudent){
//        resultUpdateItemStudent = shopRepository.updateItemStudent(id, itemStudent);
//    }
//    public LiveData<Shop.ItemStudent> updateItemStudentResult (){
//        return resultUpdateItemStudent;
//    }

    @Override
    protected void onCleared() {
        super.onCleared();
        shopRepository.resetInstance();
    }
}
