package com.example.arsenio.views;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;
import androidx.navigation.Navigation;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.bumptech.glide.Glide;
import com.example.arsenio.R;
import com.example.arsenio.adapters.HomeFragmentRVAdapter;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.viewmodels.HomeViewModel;
import com.example.arsenio.viewmodels.StoryViewModel;

import java.io.File;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link StoryFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class StoryFragment extends Fragment {
    private ImageView btnHomeStoryFragment;
    private ImageView imgBackgroundStoryFragment;

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
    }

    private void initView(View view){
        btnHomeStoryFragment = view.findViewById(R.id.btnHomeStoryFragment);
        imgBackgroundStoryFragment = view.findViewById(R.id.imgBackgroundStoryFragment);

        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        storyViewModel = new ViewModelProvider(requireActivity()).get(StoryViewModel.class);
        storyViewModel.init(sharedPreferenceHelper.getAccessToken());
        int id = getArguments().getInt("level_id", -1);
        storyViewModel.getStory(String.valueOf(id));
        storyViewModel.getStoryResult().observe(requireActivity(), story -> {
            if (story != null ){
                Glide.with(requireContext())
                        .load(new File("/drawable/story_hutan.png"))
                        .into(imgBackgroundStoryFragment);
            }
        });
    }

    private void setListener(){
        btnHomeStoryFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_storyActivity_to_homeActivity);
            }
        });
    }


}