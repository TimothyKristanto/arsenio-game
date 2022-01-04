package com.example.arsenio.models;

import com.google.gson.Gson;

import java.util.List;

public class Shop {

    private List<Item> item;
    private List<ItemStudent> itemStudent;
    private List<Navbar> navbar;

    public static Shop objectFromData(String str) {

        return new Gson().fromJson(str, Shop.class);
    }

    public List<Item> getItem() {
        return item;
    }

    public void setItem(List<Item> item) {
        this.item = item;
    }

    public List<ItemStudent> getItemStudent() {
        return itemStudent;
    }

    public void setItemStudent(List<ItemStudent> itemStudent) {
        this.itemStudent = itemStudent;
    }

    public List<Navbar> getNavbar() {
        return navbar;
    }

    public void setNavbar(List<Navbar> navbar) {
        this.navbar = navbar;
    }

    public static class Item {
        private int item_id;
        private String name;
        private String image;
        private int amount;
        private int single_price;
        private String description;

        public static Item objectFromData(String str) {

            return new Gson().fromJson(str, Item.class);
        }

        public int getItem_id() {
            return item_id;
        }

        public void setItem_id(int item_id) {
            this.item_id = item_id;
        }

        public String getName() {
            return name;
        }

        public void setName(String name) {
            this.name = name;
        }

        public String getImage() {
            return image;
        }

        public void setImage(String image) {
            this.image = image;
        }

        public int getAmount() {
            return amount;
        }

        public void setAmount(int amount) {
            this.amount = amount;
        }

        public int getSingle_price() {
            return single_price;
        }

        public void setSingle_price(int single_price) {
            this.single_price = single_price;
        }

        public String getDescription() {
            return description;
        }

        public void setDescription(String description) {
            this.description = description;
        }
    }

    public static class ItemStudent {
        private int item_id;
        private int item_owned;

        public static ItemStudent objectFromData(String str) {

            return new Gson().fromJson(str, ItemStudent.class);
        }

        public int getItem_id() {
            return item_id;
        }

        public void setItem_id(int item_id) {
            this.item_id = item_id;
        }

        public int getItem_owned() {
            return item_owned;
        }

        public void setItem_owned(int item_owned) {
            this.item_owned = item_owned;
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
