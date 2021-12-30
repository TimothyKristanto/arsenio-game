package com.example.arsenio.adapters;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.navigation.NavDirections;
import androidx.navigation.Navigation;
import androidx.recyclerview.widget.RecyclerView;

import com.example.arsenio.R;
import com.example.arsenio.models.Home;

import java.util.List;

public class HomeFragmentRVAdapter extends RecyclerView.Adapter<HomeFragmentRVAdapter.ViewHolder> {
    private int storyLevelProgress;
    private Context context;

    public HomeFragmentRVAdapter(int storyLevelProgress, Context context) {
        this.storyLevelProgress = storyLevelProgress;
        this.context = context;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.rv_home_viewholder, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        if(position == 0){
            holder.imgBgHomeFragmentViewholder.setImageResource(R.drawable.chapter1);

            holder.imgBgHomeFragmentViewholder.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Bundle bundle = new Bundle();
                    bundle.putInt("story_id", 1);
                    bundle.putInt("storyLevelProgress", storyLevelProgress);
                    Navigation.findNavController(view).navigate(R.id.action_homeActivity_to_storyActivity, bundle);
                }
            });
        }

        if(position == 1 && position <= (storyLevelProgress / 10) - 1){
            holder.imgBgHomeFragmentViewholder.setImageResource(R.drawable.chapter2);

            holder.imgBgHomeFragmentViewholder.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Bundle bundle = new Bundle();
                    bundle.putInt("story_id", 2);
                    bundle.putInt("storyLevelProgress", storyLevelProgress);
                    Navigation.findNavController(view).navigate(R.id.action_homeActivity_to_storyActivity, bundle);
                }
            });
        }else if(position == 1 && position > (storyLevelProgress / 10) - 1){
            holder.imgBgHomeFragmentViewholder.setImageResource(R.drawable.chapter2_locked);
        }
    }

    @Override
    public int getItemCount() {
        return 2;
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        private ImageView imgBgHomeFragmentViewholder;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);

            imgBgHomeFragmentViewholder = itemView.findViewById(R.id.imgBgHomeFragmentViewholder);
        }
    }
}
