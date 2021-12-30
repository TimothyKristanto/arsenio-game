package com.example.arsenio.models;

import com.google.gson.Gson;

import java.util.List;

public class Story {

    private List<Story> story;

    public static Story objectFromData(String str) {

        return new Gson().fromJson(str, Story.class);
    }

    public List<Story> getStory() {
        return story;
    }

    public void setStory(List<Story> story) {
        this.story = story;
    }

    public static class StoryData {
        private String title;
        private String story_desc;
        private String image;

        public static Story objectFromData(String str) {

            return new Gson().fromJson(str, Story.class);
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
}
