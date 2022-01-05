package com.example.arsenio.viewmodels;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import com.example.arsenio.models.BattlePlayerEnemy;
import com.example.arsenio.models.BattleQuestion;
import com.example.arsenio.repositories.BattleRepository;

public class BattleViewModel extends AndroidViewModel {
    private BattleRepository battleRepository;
    private static final String TAG = "BattleViewModel";

    public BattleViewModel(@NonNull Application application) {
        super(application);
    }

    public void init(String token){
        battleRepository = BattleRepository.getInstance(token);
    }

    private MutableLiveData<BattleQuestion> resultBattleQuestion = new MutableLiveData<>();
    public void getBattleQuestion(int levelId, int questionIndex){
        resultBattleQuestion = battleRepository.getBattleQuestion(levelId, questionIndex);
    }
    public LiveData<BattleQuestion> getBattleQuestionResult(){
        return resultBattleQuestion;
    }

    private MutableLiveData<BattlePlayerEnemy> resultBattle = new MutableLiveData<>();
    public void getBattle(int levelId){
        resultBattle = battleRepository.getBattle(levelId);
    }
    public LiveData<BattlePlayerEnemy> getBattleResult(){
        return resultBattle;
    }

    @Override
    protected void onCleared() {
        super.onCleared();
        battleRepository.resetInstance();
    }
}
