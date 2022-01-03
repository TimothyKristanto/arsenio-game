package com.example.arsenio.views;

import android.app.Dialog;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProvider;
import androidx.navigation.Navigation;

import android.os.CountDownTimer;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.BattlePlayerEnemy;
import com.example.arsenio.models.BattleQuestion;
import com.example.arsenio.viewmodels.BattleViewModel;

import java.util.ArrayList;
import java.util.Random;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link BattleFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class BattleFragment extends Fragment {
    private Button btnPauseBattleFragment, btnAnswerABattleFragment, btnAnswerBBattleFragment, btnAnswerCBattleFragment, btnAnswerDBattleFragment, btnUseItemBattleFragment;
    private TextView txtTimerBattleFragment, txtPlayerHealthBattleFragment, txtEnemyHealthBattleFragment, txtQuestionBattleFragment;
    private ImageView imgBackgroundBattleFragment, imgEnemyBattleFragment;

    private CountDownTimer questionTimer;
    private Dialog pauseDialog, winDialog, loseDialog;
    private BattleViewModel battleViewModel;
    private SharedPreferenceHelper sharedPreferenceHelper;
    private ArrayList<Integer> listQuestionIndex;

    private long timer;
    private String modeBattle, answerA, answerB, answerC, answerD, correctAnswer;
    private int levelId, questionAmount, questionIndex, userHealth, enemyDamage;
    private static final String TAG = "BattleFragment";

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    public BattleFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment BattleFragment.
     */
    // TODO: Rename and change types and number of parameters
    public static BattleFragment newInstance(String param1, String param2) {
        BattleFragment fragment = new BattleFragment();
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
        return inflater.inflate(R.layout.fragment_battle, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        initView(view);
        setUI();
        setTimerCountdown(view);
        setListener();
    }

    private void initView(View view){
        btnPauseBattleFragment = view.findViewById(R.id.btnPauseBattleFragment);
        txtTimerBattleFragment = view.findViewById(R.id.txtTimerBattleFragment);
        imgBackgroundBattleFragment = view.findViewById(R.id.imgBackgroundBattleFragment);
        txtQuestionBattleFragment = view.findViewById(R.id.txtQuestionBattleFragment);
        txtPlayerHealthBattleFragment = view.findViewById(R.id.txtPlayerHealthBattleFragment);
        txtEnemyHealthBattleFragment = view.findViewById(R.id.txtEnemyHealthBattleFragment);
        btnUseItemBattleFragment = view.findViewById(R.id.btnUseItemBattleFragment);
        btnAnswerDBattleFragment = view.findViewById(R.id.btnAnswerDBattleFragment);
        btnAnswerCBattleFragment = view.findViewById(R.id.btnAnswerCBattleFragment);
        btnAnswerBBattleFragment = view.findViewById(R.id.btnAnswerBBattleFragment);
        btnAnswerABattleFragment = view.findViewById(R.id.btnAnswerABattleFragment);
        imgEnemyBattleFragment = view.findViewById(R.id.imgEnemyBattleFragment);

        pauseDialog = new Dialog(requireActivity());
        winDialog = new Dialog(requireActivity());
        loseDialog = new Dialog(requireActivity());
        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        battleViewModel = new ViewModelProvider(requireActivity()).get(BattleViewModel.class);
        battleViewModel.init(sharedPreferenceHelper.getAccessToken());
        listQuestionIndex = new ArrayList<>();

        modeBattle = getArguments().getString("mode");
    }

    private void setUI(){
        levelId = getArguments().getInt("levelId", -1);
        questionAmount = getArguments().getInt("questionAmount", -1);

        initEnemy();
        initPlayer();

        if(levelId > 20){
            imgBackgroundBattleFragment.setImageResource(R.drawable.story_gua);
        }else if(levelId > 10){
            imgBackgroundBattleFragment.setImageResource(R.drawable.story_hutan);
        }

        for(int i = 0; i < questionAmount; i++){
            listQuestionIndex.add(i);
        }

        questionIndex = new Random().nextInt(listQuestionIndex.size());
        getQuestion(questionIndex);
    }

    private void initEnemy(){
        txtEnemyHealthBattleFragment.setText("" + (questionAmount * 20));

        if(levelId == 25){
            imgEnemyBattleFragment.setImageResource(R.drawable.monster_penyihir);
        }else if(levelId < 25 && levelId > 20){
            imgEnemyBattleFragment.setImageResource(R.drawable.monster_serigala);
        }else if(levelId == 15){
            imgEnemyBattleFragment.setImageResource(R.drawable.monster_iblis);
        }
    }

    private void initPlayer(){
        battleViewModel.getBattle(levelId);
        battleViewModel.getBattleResult().observe(requireActivity(), battlePlayerEnemy -> {
            BattlePlayerEnemy.BattleStudentData student = battlePlayerEnemy.getBattleStudentData().get(0);
            BattlePlayerEnemy.Enemy enemy = battlePlayerEnemy.getEnemy().get(0);

            enemyDamage = enemy.getDamage();
            userHealth = student.getHealth();
            txtPlayerHealthBattleFragment.setText("" + userHealth);
        });
    }

    private void getQuestion(int questionIndex){
        battleViewModel.getBattleQuestion(levelId, listQuestionIndex.get(questionIndex));
        battleViewModel.getBattleQuestionResult().observe(requireActivity(), battle -> {
            if(battle != null){
                // set texts
                BattleQuestion.Question question = battle.getQuestion();

                answerA = question.getAnswer_a();
                answerB = question.getAnswer_b();
                answerC = question.getAnswer_c();
                answerD = question.getAnswer_d();
                correctAnswer = question.getCorrect_answer();

                txtQuestionBattleFragment.setText(question.getQuestion());
                btnAnswerABattleFragment.setText("A. " + answerA);
                btnAnswerBBattleFragment.setText("B. " + answerB);
                btnAnswerCBattleFragment.setText("C. " + answerC);
                btnAnswerDBattleFragment.setText("D. " + answerD);
            }
        });
    }

    private void setListener(){
        btnPauseBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                questionTimer.cancel();
                showPauseDialog(view);
            }
        });

        btnAnswerABattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerA.equals(correctAnswer)){
                    listQuestionIndex.remove(questionIndex);
                    txtEnemyHealthBattleFragment.setText("" + (listQuestionIndex.size() * 20));
                }else{
                    userHealth -= enemyDamage;
                    txtPlayerHealthBattleFragment.setText("" + userHealth);
                }

                if(userHealth > 0 && listQuestionIndex.size() > 0){
                    questionIndex = new Random().nextInt(listQuestionIndex.size());
                    getQuestion(questionIndex);

                    questionTimer.cancel();
                    setTimerCountdown(view);
                }else{
                    checkWinner(view);
                }
            }
        });

        btnAnswerBBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerB.equals(correctAnswer)){
                    listQuestionIndex.remove(questionIndex);
                    txtEnemyHealthBattleFragment.setText("" + (listQuestionIndex.size() * 20));
                }else{
                    userHealth -= enemyDamage;
                    txtPlayerHealthBattleFragment.setText("" + userHealth);
                }

                if(userHealth > 0 && listQuestionIndex.size() > 0){
                    questionIndex = new Random().nextInt(listQuestionIndex.size());
                    getQuestion(questionIndex);

                    questionTimer.cancel();
                    setTimerCountdown(view);
                }else{
                    checkWinner(view);
                }
            }
        });

        btnAnswerCBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerC.equals(correctAnswer)){
                    listQuestionIndex.remove(questionIndex);
                    txtEnemyHealthBattleFragment.setText("" + (listQuestionIndex.size() * 20));
                }else{
                    userHealth -= enemyDamage;
                    txtPlayerHealthBattleFragment.setText("" + userHealth);
                }

                if(userHealth > 0 && listQuestionIndex.size() > 0){
                    questionIndex = new Random().nextInt(listQuestionIndex.size());
                    getQuestion(questionIndex);

                    questionTimer.cancel();
                    setTimerCountdown(view);
                }else{
                    checkWinner(view);
                }
            }
        });

        btnAnswerDBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerD.equals(correctAnswer)){
                    listQuestionIndex.remove(questionIndex);
                    txtEnemyHealthBattleFragment.setText("" + (listQuestionIndex.size() * 20));
                }else{
                    userHealth -= enemyDamage;
                    txtPlayerHealthBattleFragment.setText("" + userHealth);
                }

                if(userHealth > 0 && listQuestionIndex.size() > 0){
                    questionIndex = new Random().nextInt(listQuestionIndex.size());
                    getQuestion(questionIndex);

                    questionTimer.cancel();
                    setTimerCountdown(view);
                }else{
                    checkWinner(view);
                }
            }
        });
    }

    private void checkWinner(View view){
        questionTimer.cancel();

        if(userHealth <= 0){
            txtPlayerHealthBattleFragment.setText("0");
            showLoseDialog(view);
        }else if(listQuestionIndex.size() <= 0){
            showWinDialog(view);
        }
    }

    private void showLoseDialog(View battleView){
        loseDialog.setContentView(R.layout.battle_win_lose_dialog);
        loseDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        TextView txtTitleWinLoseDailog, txtGoldWinLoseDialog, txtExpWinLoseDialog, txtExitWinLoseDialog;
        Button btnReplayWinLoseDialog;
        ImageView imgCharacterWinLoseDialog;

        txtExitWinLoseDialog = loseDialog.findViewById(R.id.txtExitWinLoseDialog);
        txtGoldWinLoseDialog = loseDialog.findViewById(R.id.txtGoldWinLoseDialog);
        txtExpWinLoseDialog = loseDialog.findViewById(R.id.txtExpWinLoseDialog);
        txtTitleWinLoseDailog = loseDialog.findViewById(R.id.txtTitleWinLoseDailog);
        btnReplayWinLoseDialog = loseDialog.findViewById(R.id.btnReplayWinLoseDialog);
        imgCharacterWinLoseDialog = loseDialog.findViewById(R.id.imgCharacterWinLoseDialog);

        txtTitleWinLoseDailog.setText("Anda Kalah");
        txtGoldWinLoseDialog.setText("x0");
        txtExpWinLoseDialog.setText("x0");
        imgCharacterWinLoseDialog.setImageResource(R.drawable.downed_character);

        txtExitWinLoseDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loseDialog.dismiss();

                Bundle bundle = new Bundle();
                bundle.putInt("storyId", levelId / 10);
                Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_to_storyActivity, bundle);
            }
        });

        btnReplayWinLoseDialog.setVisibility(View.VISIBLE);

        btnReplayWinLoseDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loseDialog.dismiss();

                Bundle bundle = new Bundle();
                bundle.putInt("levelId", levelId);
                bundle.putInt("questionAmount", questionAmount);
                Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_self, bundle);
            }
        });

        loseDialog.show();
    }

    private void showWinDialog(View battleView){
        winDialog.setContentView(R.layout.battle_win_lose_dialog);
        winDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        TextView txtTitleWinLoseDailog, txtGoldWinLoseDialog, txtExpWinLoseDialog, txtExitWinLoseDialog;
        ImageView imgCharacterWinLoseDialog;

        txtExitWinLoseDialog = winDialog.findViewById(R.id.txtExitWinLoseDialog);
        txtGoldWinLoseDialog = winDialog.findViewById(R.id.txtGoldWinLoseDialog);
        txtExpWinLoseDialog = winDialog.findViewById(R.id.txtExpWinLoseDialog);
        txtTitleWinLoseDailog = winDialog.findViewById(R.id.txtTitleWinLoseDailog);
        imgCharacterWinLoseDialog = winDialog.findViewById(R.id.imgCharacterWinLoseDialog);

        txtTitleWinLoseDailog.setText("Anda Menang");
        imgCharacterWinLoseDialog.setImageResource(R.drawable.battle_character);

        txtExitWinLoseDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                winDialog.dismiss();

                Bundle bundle = new Bundle();
                bundle.putInt("storyId", levelId / 10);
                Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_to_storyActivity, bundle);
            }
        });

        winDialog.show();
    }

    private void showPauseDialog(View battleView) {
        pauseDialog.setContentView(R.layout.battle_pause_dialog);
        pauseDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        Button btnGiveUpBattlePauseDialog;
        TextView txtClosePauseDialog;

        btnGiveUpBattlePauseDialog = pauseDialog.findViewById(R.id.btnGiveUpBattlePauseDialog);
        txtClosePauseDialog = pauseDialog.findViewById(R.id.txtClosePauseDialog);

        btnGiveUpBattlePauseDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                switch (modeBattle){
                    case "story":
                        Bundle bundle = new Bundle();
                        bundle.putInt("storyId", levelId / 10);
                        Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_to_storyActivity, bundle);
                        break;
                    case "abyss":
                        Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_to_abyssActivity);
                        break;
                }

                pauseDialog.dismiss();
            }
        });

        txtClosePauseDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                pauseDialog.dismiss();
                questionTimer = new CountDownTimer(timer * 1000, 1000) {
                    @Override
                    public void onTick(long l) {
                        timer = l / 1000;
                        txtTimerBattleFragment.setText("" + (timer < 10 ? "0" + timer : timer));
                    }

                    @Override
                    public void onFinish() {
                        userHealth -= enemyDamage;
                        txtPlayerHealthBattleFragment.setText("" + userHealth);

                        if(userHealth > 0 && listQuestionIndex.size() > 0){
                            questionIndex = new Random().nextInt(listQuestionIndex.size());
                            getQuestion(questionIndex);

                            questionTimer.cancel();
                            setTimerCountdown(battleView);
                        }else {
                            checkWinner(battleView);
                        }
                    }
                }.start();
            }
        });

        pauseDialog.show();
    }

    private void setTimerCountdown(View view){
        questionTimer = new CountDownTimer(26000, 1000){

            @Override
            public void onTick(long l) {
                timer = l / 1000;
                txtTimerBattleFragment.setText("" + (timer < 10 ? "0" + timer : timer));
            }

            @Override
            public void onFinish() {
                userHealth -= enemyDamage;
                txtPlayerHealthBattleFragment.setText("" + userHealth);

                if(userHealth > 0 && listQuestionIndex.size() > 0){
                    questionIndex = new Random().nextInt(listQuestionIndex.size());
                    getQuestion(questionIndex);

                    questionTimer.cancel();
                    setTimerCountdown(view);
                }else{
                    checkWinner(view);
                }
            }
        }.start();
    }


}