package com.example.arsenio.views;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;
import androidx.navigation.Navigation;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.arsenio.R;
import com.example.arsenio.adapters.HomeFragmentRVAdapter;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.Abyss;
import com.example.arsenio.models.Home;
import com.example.arsenio.viewmodels.AbyssViewModel;
import com.example.arsenio.viewmodels.BattleViewModel;
import com.example.arsenio.viewmodels.HomeViewModel;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link AbyssFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class AbyssFragment extends Fragment {
    private ImageView btnHomeAbyssFragment,abyss_button;
    private TextView abyss_lb1,abyss_lb2,abyss_lb3,abyss_lb4,abyss_lb5,txtGoldAbyssFragment;

    private SharedPreferenceHelper sharedPreferenceHelper;
    private BattleViewModel battleViewModel;
    private AbyssViewModel abyssViewModel;

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    public AbyssFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment AbyssActivity.
     */
    // TODO: Rename and change types and number of parameters
    public static AbyssFragment newInstance(String param1, String param2) {
        AbyssFragment fragment = new AbyssFragment();
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
        return inflater.inflate(R.layout.fragment_abyss, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        initView(view);
        setListener();
        setData();
    }

    private void setData(){
        abyssViewModel.getAbyss();
        abyssViewModel.getAbyssResult().observe(requireActivity(), abyss -> {
            if(abyss != null){
                int golds = abyss.getStudent().get(0).getGolds();
                txtGoldAbyssFragment.setText(String.valueOf(golds));

                int jumlah = abyss.getStudent_leaderboard().size();
                if(jumlah>=1){
                    Abyss.StudentLeaderboard student1 = abyss.getStudent_leaderboard().get(0);
                    abyss_lb1.setText("1. " + student1.getUsername() + " (" + student1.getAbyss_point() + "pt)");
                }
                if(jumlah>=2){
                    Abyss.StudentLeaderboard student2 = abyss.getStudent_leaderboard().get(1);
                    abyss_lb2.setText("2. " + student2.getUsername() + " (" + student2.getAbyss_point() + "pt)");
                }
                if(jumlah>=3){
                    Abyss.StudentLeaderboard student3 = abyss.getStudent_leaderboard().get(2);
                    abyss_lb3.setText("3. " + student3.getUsername() + " (" + student3.getAbyss_point() + "pt)");
                }
                if(jumlah>=4){
                    Abyss.StudentLeaderboard student4 = abyss.getStudent_leaderboard().get(3);
                    abyss_lb4.setText("4. " + student4.getUsername() + " (" + student4.getAbyss_point() + "pt)");
                }
                if(jumlah>=5){
                    Abyss.StudentLeaderboard student5 = abyss.getStudent_leaderboard().get(4);
                    abyss_lb5.setText("5. " + student5.getUsername() + " (" + student5.getAbyss_point() + "pt)");
                }
            }
        });
    }

    private void initView(View view){
        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        abyssViewModel = new ViewModelProvider(requireActivity()).get(AbyssViewModel.class);
        abyssViewModel.init(sharedPreferenceHelper.getAccessToken());
        battleViewModel = new ViewModelProvider(requireActivity()).get(BattleViewModel.class);
        battleViewModel.init(sharedPreferenceHelper.getAccessToken());

        btnHomeAbyssFragment = view.findViewById(R.id.btnHomeAbyssFragment);
        abyss_button = view.findViewById(R.id.abyss_button);
        abyss_lb1 = view.findViewById(R.id.abyss_lb1);
        abyss_lb2 = view.findViewById(R.id.abyss_lb2);
        abyss_lb3 = view.findViewById(R.id.abyss_lb3);
        abyss_lb4 = view.findViewById(R.id.abyss_lb4);
        abyss_lb5 = view.findViewById(R.id.abyss_lb5);
        txtGoldAbyssFragment =  view.findViewById(R.id.txtGoldAbyssFragment);
    }

    private void setListener(){
        btnHomeAbyssFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Navigation.findNavController(view).navigate(R.id.action_abyssActivity_to_homeActivity);
            }
        });

        abyss_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                battleViewModel.getAbyssBattleQuestion(0);
                battleViewModel.getAbyssBattleQuestionResult().observe(requireActivity(), battleQuestion -> {
                    Bundle bundle = new Bundle();
                    bundle.putString("mode", "abyss");
                    bundle.putInt("levelId", 0);
                    bundle.putInt("questionAmount", battleQuestion.getQuestionAmount());
                    Navigation.findNavController(view).navigate(R.id.action_abyssActivity_to_battleFragment, bundle);
                });
            }
        });
    }
}