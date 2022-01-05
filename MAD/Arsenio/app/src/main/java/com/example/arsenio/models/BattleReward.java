package com.example.arsenio.models;

import com.google.gson.Gson;

public class BattleReward {

    private int gold_rewards;
    private int exp_rewards;

    public static BattleReward objectFromData(String str) {

        return new Gson().fromJson(str, BattleReward.class);
    }

    public int getGold_rewards() {
        return gold_rewards;
    }

    public void setGold_rewards(int gold_rewards) {
        this.gold_rewards = gold_rewards;
    }

    public int getExp_rewards() {
        return exp_rewards;
    }

    public void setExp_rewards(int exp_rewards) {
        this.exp_rewards = exp_rewards;
    }
}
