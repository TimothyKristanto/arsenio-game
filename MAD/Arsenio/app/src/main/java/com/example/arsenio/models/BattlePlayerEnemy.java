package com.example.arsenio.models;

import com.google.gson.Gson;

import java.util.List;

public class BattlePlayerEnemy {

    private List<BattleStudentData> battleStudentData;
    private List<Enemy> enemy;

    public static BattlePlayerEnemy objectFromData(String str) {

        return new Gson().fromJson(str, BattlePlayerEnemy.class);
    }

    public List<BattleStudentData> getBattleStudentData() {
        return battleStudentData;
    }

    public void setBattleStudentData(List<BattleStudentData> battleStudentData) {
        this.battleStudentData = battleStudentData;
    }

    public List<Enemy> getEnemy() {
        return enemy;
    }

    public void setEnemy(List<Enemy> enemy) {
        this.enemy = enemy;
    }

    public static class BattleStudentData {
        private int health;

        public static BattleStudentData objectFromData(String str) {

            return new Gson().fromJson(str, BattleStudentData.class);
        }

        public int getHealth() {
            return health;
        }

        public void setHealth(int health) {
            this.health = health;
        }
    }

    public static class Enemy {
        private String name;
        private int damage;

        public static Enemy objectFromData(String str) {

            return new Gson().fromJson(str, Enemy.class);
        }

        public String getName() {
            return name;
        }

        public void setName(String name) {
            this.name = name;
        }

        public int getDamage() {
            return damage;
        }

        public void setDamage(int damage) {
            this.damage = damage;
        }
    }
}
