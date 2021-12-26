package com.example.arsenio.views;

import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;
import androidx.navigation.Navigation;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.arsenio.R;
import com.example.arsenio.adapters.HomeFragmentRVAdapter;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.Home;
import com.example.arsenio.viewmodels.AuthViewModel;
import com.example.arsenio.viewmodels.HomeViewModel;

import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link HomeFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class HomeFragment extends Fragment {
    private ImageView imgLogoutHomeFragment, imgShopHomeFragment, imgAbyssHomeFragment;
    private TextView txtGoldHomeFragment, txtUsernameHomeFragment, txtStoryProgressHomeFragment, txtAbyssScoreHomeFragment, txtLevelHomeFragment;
    private RecyclerView rvHomeFragment;

    private SharedPreferenceHelper sharedPreferenceHelper;
    private HomeViewModel homeViewModel;
    private HomeFragmentRVAdapter adapter;

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    public HomeFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment HomeActivity.
     */
    // TODO: Rename and change types and number of parameters
    public static HomeFragment newInstance(String param1, String param2) {
        HomeFragment fragment = new HomeFragment();
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
        return inflater.inflate(R.layout.fragment_home, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        initView(view);
        setListener();
        setUI();
    }

    private void setUI(){
        homeViewModel.getHome();
        homeViewModel.getHomeResult().observe(requireActivity(), home -> {
            if(home != null){
                Home.Student student = home.getStudent().get(0);

                txtLevelHomeFragment.setText("Level " + student.getExp_id() + " (" + student.getTotal_exp() + "/" + student.getLevel_up_exp() + ")");
                txtAbyssScoreHomeFragment.setText("Abyss score: " + student.getAbyss_point());
                txtGoldHomeFragment.setText(String.valueOf(student.getGolds()));
                txtUsernameHomeFragment.setText(student.getUsername());
                txtStoryProgressHomeFragment.setText("Story: Chapter " + student.getStory_level_progress() / 10);

                adapter = new HomeFragmentRVAdapter(student.getStory_level_progress(), requireActivity());
                LinearLayoutManager layoutManager = new LinearLayoutManager(requireActivity(), LinearLayoutManager.HORIZONTAL, false);
                rvHomeFragment.setLayoutManager(layoutManager);
                rvHomeFragment.setAdapter(adapter);
            }
        });
    }

    private void initView(View view){
        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        homeViewModel = new ViewModelProvider(requireActivity()).get(HomeViewModel.class);
        homeViewModel.init(sharedPreferenceHelper.getAccessToken());

        imgLogoutHomeFragment = view.findViewById(R.id.imgLogoutHomeFragment);
        imgShopHomeFragment = view.findViewById(R.id.imgShopHomeFragment);
        imgAbyssHomeFragment = view.findViewById(R.id.imgAbyssHomeFragment);
        txtGoldHomeFragment = view.findViewById(R.id.txtGoldHomeFragment);
        txtUsernameHomeFragment = view.findViewById(R.id.txtUsernameHomeFragment);
        txtStoryProgressHomeFragment = view.findViewById(R.id.txtStoryProgressHomeFragment);
        txtAbyssScoreHomeFragment = view.findViewById(R.id.txtAbyssScoreHomeFragment);
        txtLevelHomeFragment = view.findViewById(R.id.txtLevelHomeFragment);
        rvHomeFragment = view.findViewById(R.id.rvHomeFragment);
    }

    private void setListener(){
        imgLogoutHomeFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                homeViewModel.logout().observe(requireActivity(), s -> {
                    if(s != null){
                        sharedPreferenceHelper.clearPref();
                        Intent intent = new Intent(requireActivity(), LoginActivity.class);
                        intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                        startActivity(intent);
                        requireActivity().finish();
                    }
                });
            }
        });

        imgAbyssHomeFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_homeActivity_to_abyssActivity);
            }
        });

        imgShopHomeFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_homeActivity_to_shopActivity);
            }
        });
    }


}