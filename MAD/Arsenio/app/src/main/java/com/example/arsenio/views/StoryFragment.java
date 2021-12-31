package com.example.arsenio.views;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;
import androidx.navigation.Navigation;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.example.arsenio.R;
import com.example.arsenio.adapters.HomeFragmentRVAdapter;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.Story;
import com.example.arsenio.viewmodels.HomeViewModel;
import com.example.arsenio.viewmodels.StoryViewModel;

import java.io.File;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link StoryFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class StoryFragment extends Fragment {
    private static final String TAG = "StoryFragment";

    private ImageView btnHomeStoryFragment, imgBackgroundStoryFragment, imgAbyssStoryFragment, imgShopStoryFragment;
    private TextView txtGoldStoryFragment;
    private Button btnLevel1StoryFragment, btnLevel2StoryFragment, btnLevel3StoryFragment, btnLevel4StoryFragment, btnLevel5StoryFragment;

    private SharedPreferenceHelper sharedPreferenceHelper;
    private StoryViewModel storyViewModel;

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    public StoryFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment StoryActivity.
     */
    // TODO: Rename and change types and number of parameters
    public static StoryFragment newInstance(String param1, String param2) {
        StoryFragment fragment = new StoryFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_story, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        initView(view);
        setListener();
        setUI();
    }

    private void initView(View view){
        btnHomeStoryFragment = view.findViewById(R.id.btnHomeStoryFragment);
        imgBackgroundStoryFragment = view.findViewById(R.id.imgBackgroundStoryFragment);
        txtGoldStoryFragment = view.findViewById(R.id.txtGoldStoryFragment);
        btnLevel1StoryFragment = view.findViewById(R.id.btnLevel1StoryFragment);
        btnLevel2StoryFragment = view.findViewById(R.id.btnLevel2StoryFragment);
        btnLevel3StoryFragment = view.findViewById(R.id.btnLevel3StoryFragment);
        btnLevel4StoryFragment = view.findViewById(R.id.btnLevel4StoryFragment);
        btnLevel5StoryFragment = view.findViewById(R.id.btnLevel5StoryFragment);
        imgAbyssStoryFragment = view.findViewById(R.id.imgAbyssStoryFragment);
        imgShopStoryFragment = view.findViewById(R.id.imgShopStoryFragment);

        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        storyViewModel = new ViewModelProvider(requireActivity()).get(StoryViewModel.class);
        storyViewModel.init(sharedPreferenceHelper.getAccessToken());
    }

    private void setUI(){
        int storyId = getArguments().getInt("story_id", -1);

        storyViewModel.getStory(storyId);
        storyViewModel.getStoryResult().observe(requireActivity(), story -> {
            Story.Navbar navbar = story.getNavbar().get(0);
            Story.StoryData storyData = story.getStoryData().get(0);

            txtGoldStoryFragment.setText("" + navbar.getGolds());
        });

        int storyLevelProgress = getArguments().getInt("storyLevelProgress", -1);

        if(storyId == 1){
            imgBackgroundStoryFragment.setImageResource(R.drawable.story_hutan);
        }else{
            imgBackgroundStoryFragment.setImageResource(R.drawable.story_gua);
        }

        if(storyLevelProgress > 20){
            if(storyId == 2){
                showEnabledLevels(storyLevelProgress);
            }else{
                enable5Level();
            }
        }else if(storyLevelProgress > 10){
            showEnabledLevels(storyLevelProgress);
        }
    }

    private void showEnabledLevels(int storyLevelProgress){
        switch (storyLevelProgress % 10){
            case 2:
                enable2Level();
                break;
            case 3:
                enable3Level();
                break;
            case 4:
                enable4Level();
                break;
            case 5:
                enable5Level();
                break;
        }
    }

    private void enable2Level(){
        btnLevel1StoryFragment.setEnabled(true);
        btnLevel1StoryFragment.setAlpha(1f);
        btnLevel2StoryFragment.setEnabled(true);
        btnLevel2StoryFragment.setAlpha(1f);
    }

    private void enable3Level(){
        enable2Level();
        btnLevel3StoryFragment.setEnabled(true);
        btnLevel3StoryFragment.setAlpha(1f);
    }

    private void enable4Level(){
        enable3Level();
        btnLevel4StoryFragment.setEnabled(true);
        btnLevel4StoryFragment.setAlpha(1f);
    }

    private void enable5Level(){
        enable4Level();
        btnLevel5StoryFragment.setEnabled(true);
        btnLevel5StoryFragment.setAlpha(1f);
    }

    private void setListener(){
        btnHomeStoryFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_storyActivity_to_homeActivity);
            }
        });

        imgShopStoryFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_storyActivity_to_shopActivity);
            }
        });

        imgAbyssStoryFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_storyActivity_to_abyssActivity);
            }
        });
    }


}