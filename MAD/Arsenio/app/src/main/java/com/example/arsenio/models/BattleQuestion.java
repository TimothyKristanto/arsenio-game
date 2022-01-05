package com.example.arsenio.models;

import com.google.gson.Gson;

public class BattleQuestion {


    private Question question;
    private int questionAmount;

    public static BattleQuestion objectFromData(String str) {

        return new Gson().fromJson(str, BattleQuestion.class);
    }

    public Question getQuestion() {
        return question;
    }

    public void setQuestion(Question question) {
        this.question = question;
    }

    public int getQuestionAmount() {
        return questionAmount;
    }

    public void setQuestionAmount(int questionAmount) {
        this.questionAmount = questionAmount;
    }

    public static class Question {
        private String question;
        private String answer_a;
        private String answer_b;
        private String answer_c;
        private String answer_d;
        private String correct_answer;

        public static Question objectFromData(String str) {

            return new Gson().fromJson(str, Question.class);
        }

        public String getQuestion() {
            return question;
        }

        public void setQuestion(String question) {
            this.question = question;
        }

        public String getAnswer_a() {
            return answer_a;
        }

        public void setAnswer_a(String answer_a) {
            this.answer_a = answer_a;
        }

        public String getAnswer_b() {
            return answer_b;
        }

        public void setAnswer_b(String answer_b) {
            this.answer_b = answer_b;
        }

        public String getAnswer_c() {
            return answer_c;
        }

        public void setAnswer_c(String answer_c) {
            this.answer_c = answer_c;
        }

        public String getAnswer_d() {
            return answer_d;
        }

        public void setAnswer_d(String answer_d) {
            this.answer_d = answer_d;
        }

        public String getCorrect_answer() {
            return correct_answer;
        }

        public void setCorrect_answer(String correct_answer) {
            this.correct_answer = correct_answer;
        }
    }
}
