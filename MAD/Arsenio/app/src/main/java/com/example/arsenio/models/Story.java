package com.example.arsenio.models;

import com.google.gson.Gson;

import java.util.List;

public class Story {

    private List<StoryData> storyData;
    private List<StoryStudentData> storyStudentData;

    public static Story objectFromData(String str) {

        return new Gson().fromJson(str, Story.class);
    }

    public List<StoryData> getStoryData() {
        return storyData;
    }

    public void setStoryData(List<StoryData> storyData) {
        this.storyData = storyData;
    }

    public List<StoryStudentData> getStoryStudentData() {
        return storyStudentData;
    }

    public void setStoryStudentData(List<StoryStudentData> storyStudentData) {
        this.storyStudentData = storyStudentData;
    }

    public static class StoryData {
        private String title;
        private String story_desc;
        private String image;

        public static StoryData objectFromData(String str) {

            return new Gson().fromJson(str, StoryData.class);
        }

        public String getTitle() {
            return title;
        }

        public void setTitle(String title) {
            this.title = title;
        }

        public String getStory_desc() {
            return story_desc;
        }

        public void setStory_desc(String story_desc) {
            this.story_desc = story_desc;
        }

        public String getImage() {
            return image;
        }

        public void setImage(String image) {
            this.image = image;
        }
    }

    public static class StoryStudentData {
        private int golds;
        private int story_level_progress;

        public static StoryStudentData objectFromData(String str) {

            return new Gson().fromJson(str, StoryStudentData.class);
        }

        public int getGolds() {
            return golds;
        }

        public void setGolds(int golds) {
            this.golds = golds;
        }

        public int getStory_level_progress() {
            return story_level_progress;
        }

        public void setStory_level_progress(int story_level_progress) {
            this.story_level_progress = story_level_progress;
        }
    }
}
