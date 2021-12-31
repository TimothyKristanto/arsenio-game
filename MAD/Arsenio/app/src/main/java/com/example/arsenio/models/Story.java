package com.example.arsenio.models;

import com.google.gson.Gson;

import java.util.List;

public class Story {

    private List<StoryData> storyData;
    private List<Navbar> navbar;

    public static Story objectFromData(String str) {
        return new Gson().fromJson(str, Story.class);
    }

    public List<StoryData> getStoryData() {
        return storyData;
    }

    public void setStoryData(List<StoryData> storyData) {
        this.storyData = storyData;
    }

    public List<Navbar> getNavbar() {
        return navbar;
    }

    public void setNavbar(List<Navbar> navbar) {
        this.navbar = navbar;
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

    public static class Navbar {
        private int golds;

        public static Navbar objectFromData(String str) {

            return new Gson().fromJson(str, Navbar.class);
        }

        public int getGolds() {
            return golds;
        }

        public void setGolds(int golds) {
            this.golds = golds;
        }
    }
}
