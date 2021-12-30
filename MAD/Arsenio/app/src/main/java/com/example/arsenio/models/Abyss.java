package com.example.arsenio.models;

import java.util.List;

public class Abyss {

    private List<Student> student;
    private List<StudentLeaderboard> student_leaderboard;

    public List<Student> getStudent() {
        return student;
    }

    public void setStudent(List<Student> student) {
        this.student = student;
    }

    public List<StudentLeaderboard> getStudent_leaderboard() {
        return student_leaderboard;
    }

    public void setStudent_leaderboard(List<StudentLeaderboard> student_leaderboard) {
        this.student_leaderboard = student_leaderboard;
    }

    public static class Student {
        private int student_id;
        private int golds;
        private int total_exp;
        private int abyss_point;
        private int exp_id;
        private int user_id;
        private int story_level_progress;
        private int level_up_exp;
        private String username;

        public int getStudent_id() {
            return student_id;
        }

        public void setStudent_id(int student_id) {
            this.student_id = student_id;
        }

        public int getGolds() {
            return golds;
        }

        public void setGolds(int golds) {
            this.golds = golds;
        }

        public int getTotal_exp() {
            return total_exp;
        }

        public void setTotal_exp(int total_exp) {
            this.total_exp = total_exp;
        }

        public int getAbyss_point() {
            return abyss_point;
        }

        public void setAbyss_point(int abyss_point) {
            this.abyss_point = abyss_point;
        }

        public int getExp_id() {
            return exp_id;
        }

        public void setExp_id(int exp_id) {
            this.exp_id = exp_id;
        }

        public int getUser_id() {
            return user_id;
        }

        public void setUser_id(int user_id) {
            this.user_id = user_id;
        }

        public int getStory_level_progress() {
            return story_level_progress;
        }

        public void setStory_level_progress(int story_level_progress) {
            this.story_level_progress = story_level_progress;
        }

        public int getLevel_up_exp() {
            return level_up_exp;
        }

        public void setLevel_up_exp(int level_up_exp) {
            this.level_up_exp = level_up_exp;
        }

        public String getUsername() {
            return username;
        }

        public void setUsername(String username) {
            this.username = username;
        }
    }

    public static class StudentLeaderboard {
        private int student_id;
        private int golds;
        private int total_exp;
        private int abyss_point;
        private int exp_id;
        private int user_id;
        private int story_level_progress;
        private int level_up_exp;
        private String username;

        public int getStudent_id() {
            return student_id;
        }

        public void setStudent_id(int student_id) {
            this.student_id = student_id;
        }

        public int getGolds() {
            return golds;
        }

        public void setGolds(int golds) {
            this.golds = golds;
        }

        public int getTotal_exp() {
            return total_exp;
        }

        public void setTotal_exp(int total_exp) {
            this.total_exp = total_exp;
        }

        public int getAbyss_point() {
            return abyss_point;
        }

        public void setAbyss_point(int abyss_point) {
            this.abyss_point = abyss_point;
        }

        public int getExp_id() {
            return exp_id;
        }

        public void setExp_id(int exp_id) {
            this.exp_id = exp_id;
        }

        public int getUser_id() {
            return user_id;
        }

        public void setUser_id(int user_id) {
            this.user_id = user_id;
        }

        public int getStory_level_progress() {
            return story_level_progress;
        }

        public void setStory_level_progress(int story_level_progress) {
            this.story_level_progress = story_level_progress;
        }

        public int getLevel_up_exp() {
            return level_up_exp;
        }

        public void setLevel_up_exp(int level_up_exp) {
            this.level_up_exp = level_up_exp;
        }

        public String getUsername() {
            return username;
        }

        public void setUsername(String username) {
            this.username = username;
        }
    }
}
