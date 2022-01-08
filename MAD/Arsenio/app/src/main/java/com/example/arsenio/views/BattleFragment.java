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
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.BattlePlayerEnemy;
import com.example.arsenio.models.BattleQuestion;
import com.example.arsenio.viewmodels.BattleViewModel;
import com.example.arsenio.viewmodels.ShopViewModel;

import java.util.ArrayList;
import java.util.Random;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link BattleFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class BattleFragment extends Fragment {
    private Button btnPauseBattleFragment, btnAnswerABattleFragment, btnAnswerBBattleFragment, btnAnswerCBattleFragment, btnAnswerDBattleFragment, btnUseItemBattleFragment;
    private TextView txtTimerBattleFragment, txtPlayerHealthBattleFragment, txtEnemyHealthBattleFragment, txtQuestionBattleFragment, txtScoreBattleFragment;
    private ImageView imgBackgroundBattleFragment, imgEnemyBattleFragment, imgEnemyHeartBattleFragment;
    private View viewEnemyStatusBattleFragment;

    private CountDownTimer questionTimer;
    private Dialog pauseDialog, winDialog, loseDialog, correctDialog, wrongDialog, battleItemDialog;
    private BattleViewModel battleViewModel;
    private SharedPreferenceHelper sharedPreferenceHelper;
    private ArrayList<Integer> listQuestionIndex;
    private ShopViewModel shopViewModel;

    private long timer;
    private String modeBattle, answerA, answerB, answerC, answerD, correctAnswer;
    private int levelId, questionAmount, questionIndex, userHealth, enemyDamage, bandageAmount, jamuAmount, hourglassAmount;
    private static final String TAG = "BattleFragment";
    private long score, countScoreAnimation;

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
        imgEnemyHeartBattleFragment = view.findViewById(R.id.imgEnemyHeartBattleFragment);
        viewEnemyStatusBattleFragment = view.findViewById(R.id.viewEnemyStatusBattleFragment);
        txtScoreBattleFragment = view.findViewById(R.id.txtScoreBattleFragment);

        pauseDialog = new Dialog(requireActivity());
        winDialog = new Dialog(requireActivity());
        loseDialog = new Dialog(requireActivity());
        correctDialog = new Dialog(requireActivity());
        wrongDialog = new Dialog(requireActivity());
        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        battleViewModel = new ViewModelProvider(requireActivity()).get(BattleViewModel.class);
        battleViewModel.init(sharedPreferenceHelper.getAccessToken());
        listQuestionIndex = new ArrayList<>();
        battleItemDialog = new Dialog(requireActivity());
        shopViewModel = new ViewModelProvider(requireActivity()).get(ShopViewModel.class);
        shopViewModel.init(sharedPreferenceHelper.getAccessToken());

        modeBattle = getArguments().getString("mode");

        score = 0;

        shopViewModel.getItems();
        shopViewModel.getItemsResult().observe(requireActivity(), shop -> {
            if(shop != null){
                bandageAmount = shop.getItemStudent().get(0).getItem_owned();
                jamuAmount = shop.getItemStudent().get(1).getItem_owned();
                hourglassAmount = shop.getItemStudent().get(2).getItem_owned();
            }
        });
    }

    private void setUI(){
        levelId = getArguments().getInt("levelId", -1);
        questionAmount = getArguments().getInt("questionAmount", -1);

        initEnemy();
        initPlayer();

        if(modeBattle.equals("story")) {
            txtScoreBattleFragment.setVisibility(View.INVISIBLE);

            if (levelId > 20) {
                imgBackgroundBattleFragment.setImageResource(R.drawable.story_gua);
            } else if (levelId > 10) {
                imgBackgroundBattleFragment.setImageResource(R.drawable.story_hutan);
            }

            for (int i = 0; i < questionAmount; i++) {
                listQuestionIndex.add(i);
            }
        }else{
            imgBackgroundBattleFragment.setImageResource(R.drawable.bg_battle_abyss);

            txtScoreBattleFragment.setText("Score " + score);
            txtScoreBattleFragment.setVisibility(View.VISIBLE);
        }

        randomInt();
        getQuestion(questionIndex);
    }

    private void initEnemy(){
        if(modeBattle.equals("story")){
            txtEnemyHealthBattleFragment.setText("" + (questionAmount * 20));

            if(levelId == 25){
                imgEnemyBattleFragment.setImageResource(R.drawable.monster_penyihir);
            }else if(levelId < 25 && levelId > 20){
                imgEnemyBattleFragment.setImageResource(R.drawable.monster_golem);
            }else if(levelId == 15){
                imgEnemyBattleFragment.setImageResource(R.drawable.monster_iblis);
            }
        }else{
            imgEnemyBattleFragment.setImageResource(R.drawable.monster_abyss);

            imgEnemyHeartBattleFragment.setVisibility(View.INVISIBLE);
            txtEnemyHealthBattleFragment.setVisibility(View.INVISIBLE);
            viewEnemyStatusBattleFragment.setVisibility(View.INVISIBLE);
            txtScoreBattleFragment.setVisibility(View.VISIBLE);

            txtScoreBattleFragment.setText("Score 0");
        }

    }

    private void initPlayer(){
        battleViewModel.getBattle(levelId);
        battleViewModel.getBattleResult().observe(requireActivity(), battlePlayerEnemy -> {
            BattlePlayerEnemy.BattleStudentData student = battlePlayerEnemy.getBattleStudentData().get(0);
            userHealth = student.getHealth();
            txtPlayerHealthBattleFragment.setText("" + userHealth);

            BattlePlayerEnemy.Enemy enemy = battlePlayerEnemy.getEnemy();
            enemyDamage = enemy.getDamage();
        });
    }

    private void getQuestion(int questionIndex){
        if(modeBattle.equals("story")){
            battleViewModel.getBattleQuestion(levelId, listQuestionIndex.get(questionIndex));
            battleViewModel.getBattleQuestionResult().observe(requireActivity(), battle -> {
                if(battle != null){
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
        }else{
            battleViewModel.getAbyssBattleQuestion(questionIndex);
            battleViewModel.getAbyssBattleQuestionResult().observe(requireActivity(), battleQuestion -> {
                if(battleQuestion != null){
                    BattleQuestion.Question question = battleQuestion.getQuestion();

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
    }

    private void answerCorrect(){
        questionTimer.cancel();
        showCorrectAnswerDialog();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                if(modeBattle.equals("story")){
                    listQuestionIndex.remove(questionIndex);
                    txtEnemyHealthBattleFragment.setText("" + (listQuestionIndex.size() * 20));
                }else{
                    score += 250;
                    txtScoreBattleFragment.setText("Score " + score);
                }
            }
        }, modeBattle.equals("story") ? 6100 : 8100);
    }

    private void answerWrong(){
        questionTimer.cancel();
        showWrongAnswerDialog();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                userHealth -= enemyDamage;
                txtPlayerHealthBattleFragment.setText("" + userHealth);
            }
        }, modeBattle.equals("story") ? 6100 : 8100);
    }

    private void showWrongAnswerDialog(){
        wrongDialog.setContentView(R.layout.true_false_answer_dialog);
        wrongDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        wrongDialog.setCancelable(false);

        ImageView imgCorrectWrongTrueFalseDialog, imgCharacterTrueFalseDialog, imgHeartTrueFalseDialog;
        View viewTrueFalseDialog;
        TextView txtHealthReduceTrueFalseDialog, txtCorrectWrongTrueFalseDialog;

        imgCorrectWrongTrueFalseDialog = wrongDialog.findViewById(R.id.imgCorrectWrongTrueFalseDialog);
        imgCharacterTrueFalseDialog = wrongDialog.findViewById(R.id.imgCharacterTrueFalseDialog);
        imgHeartTrueFalseDialog = wrongDialog.findViewById(R.id.imgHeartTrueFalseDialog);
        viewTrueFalseDialog = wrongDialog.findViewById(R.id.viewTrueFalseDialog);
        txtHealthReduceTrueFalseDialog = wrongDialog.findViewById(R.id.txtHealthReduceTrueFalseDialog);
        txtCorrectWrongTrueFalseDialog = wrongDialog.findViewById(R.id.txtCorrectWrongTrueFalseDialog);

        imgCorrectWrongTrueFalseDialog.setImageResource(R.drawable.ic_baseline_wrong_24);
        txtCorrectWrongTrueFalseDialog.setText("JAWABAN SALAH");

        if(timer <= 0){
            txtCorrectWrongTrueFalseDialog.setText("WAKTU HABIS!");
        }

        txtCorrectWrongTrueFalseDialog.setTextColor(Color.parseColor("#FF0000"));
        txtHealthReduceTrueFalseDialog.setText("-" + enemyDamage);

        wrongDialog.show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                imgCorrectWrongTrueFalseDialog.setVisibility(View.INVISIBLE);
                txtCorrectWrongTrueFalseDialog.setVisibility(View.INVISIBLE);

                imgCharacterTrueFalseDialog.setVisibility(View.VISIBLE);
                imgHeartTrueFalseDialog.setVisibility(View.VISIBLE);
                viewTrueFalseDialog.setVisibility(View.VISIBLE);
                txtHealthReduceTrueFalseDialog.setVisibility(View.VISIBLE);

                imgHeartTrueFalseDialog.startAnimation(AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in));
                viewTrueFalseDialog.startAnimation(AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in));
                txtHealthReduceTrueFalseDialog.startAnimation(AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in));
            }
        }, 3000);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                wrongDialog.dismiss();
            }
        }, modeBattle.equals("story") ? 6000 : 8000);
    }

    private void showCorrectAnswerDialog(){
        correctDialog.setContentView(R.layout.true_false_answer_dialog);
        correctDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        correctDialog.setCancelable(false);

        ImageView imgCorrectWrongTrueFalseDialog, imgCharacterTrueFalseDialog, imgHeartTrueFalseDialog;
        View viewTrueFalseDialog;
        TextView txtHealthReduceTrueFalseDialog, txtCorrectWrongTrueFalseDialog, txtScoreTrueFalseDialog;

        imgCorrectWrongTrueFalseDialog = correctDialog.findViewById(R.id.imgCorrectWrongTrueFalseDialog);
        imgCharacterTrueFalseDialog = correctDialog.findViewById(R.id.imgCharacterTrueFalseDialog);
        imgHeartTrueFalseDialog = correctDialog.findViewById(R.id.imgHeartTrueFalseDialog);
        viewTrueFalseDialog = correctDialog.findViewById(R.id.viewTrueFalseDialog);
        txtHealthReduceTrueFalseDialog = correctDialog.findViewById(R.id.txtHealthReduceTrueFalseDialog);
        txtCorrectWrongTrueFalseDialog = correctDialog.findViewById(R.id.txtCorrectWrongTrueFalseDialog);
        txtScoreTrueFalseDialog = correctDialog.findViewById(R.id.txtScoreTrueFalseDialog);

        if(modeBattle.equals("story")) {
            txtHealthReduceTrueFalseDialog.setText("-20");
            if (levelId == 25) {
                imgCharacterTrueFalseDialog.setImageResource(R.drawable.monster_penyihir);
            } else if (levelId < 25 && levelId > 20) {
                imgCharacterTrueFalseDialog.setImageResource(R.drawable.monster_golem);
            } else if (levelId == 15) {
                imgCharacterTrueFalseDialog.setImageResource(R.drawable.monster_iblis);
            } else if (levelId < 15) {
                imgCharacterTrueFalseDialog.setImageResource(R.drawable.monster_skeleton);
            }
        }

        correctDialog.show();

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                imgCorrectWrongTrueFalseDialog.setVisibility(View.INVISIBLE);
                txtCorrectWrongTrueFalseDialog.setVisibility(View.INVISIBLE);

                if(modeBattle.equals("story")) {
                    imgCharacterTrueFalseDialog.setVisibility(View.VISIBLE);
                    imgHeartTrueFalseDialog.setVisibility(View.VISIBLE);
                    viewTrueFalseDialog.setVisibility(View.VISIBLE);
                    txtHealthReduceTrueFalseDialog.setVisibility(View.VISIBLE);

                    imgHeartTrueFalseDialog.startAnimation(AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in));
                    viewTrueFalseDialog.startAnimation(AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in));
                    txtHealthReduceTrueFalseDialog.startAnimation(AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in));
                }else{
                    txtScoreTrueFalseDialog.setVisibility(View.VISIBLE);
                    txtScoreTrueFalseDialog.setText("Score 0");

                    countScoreAnimation = score;

                    new Handler().postDelayed(new Runnable() {
                        @Override
                        public void run() {
                            txtScoreTrueFalseDialog.setText("Score " + countScoreAnimation);

                            if(countScoreAnimation < score + 250){
                                countScoreAnimation += 2;
                                new Handler().postDelayed(this, 1);
                            }
                        }
                    }, 1);
                }
            }
        }, 3000);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                correctDialog.dismiss();
            }
        }, modeBattle.equals("story") ? 6000 : 8000);
    }

    private void checkHealth(View view){
        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                if(modeBattle.equals("story")) {
                    if (userHealth > 0 && listQuestionIndex.size() > 0) {
                        randomInt();
                        getQuestion(questionIndex);

                        questionTimer.cancel();
                        setTimerCountdown(view);
                    } else {
                        checkWinner(view);
                    }
                }else{
                    if (userHealth > 0) {
                        randomInt();
                        getQuestion(questionIndex);

                        questionTimer.cancel();
                        setTimerCountdown(view);
                    } else {
                        checkWinner(view);
                    }
                }
            }
        }, modeBattle.equals("story") ? 6100 : 8100);
    }

    private void updateStudentItem(){
        battleViewModel.updateStudentBattleItem(bandageAmount, jamuAmount, hourglassAmount);
        battleViewModel.updateStudentBattleItemResult().observe(requireActivity(), s -> {
            if(s != null){
                Log.d(TAG, "updateStudentItem: " + s);
            }
        });
    }

    private void showItemDialog(View battleView){
        battleItemDialog.setContentView(R.layout.battle_item_dialog);
        battleItemDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        ImageView imgBandageBattleItemDialog, imgJamuBattleItemDialog, imgHourglassBattleItemDialog;
        TextView txtCloseBattleItemDialog, txtBandageAmountBattleItemDialog, txtJamuAmountBattleItemDialog, txtHourglassAmountBattleItemDialog;

        imgBandageBattleItemDialog = battleItemDialog.findViewById(R.id.imgBandageBattleItemDialog);
        imgJamuBattleItemDialog = battleItemDialog.findViewById(R.id.imgJamuBattleItemDialog);
        imgHourglassBattleItemDialog = battleItemDialog.findViewById(R.id.imgHourglassBattleItemDialog);
        txtCloseBattleItemDialog = battleItemDialog.findViewById(R.id.txtCloseBattleItemDialog);
        txtBandageAmountBattleItemDialog = battleItemDialog.findViewById(R.id.txtBandageAmountBattleItemDialog);
        txtJamuAmountBattleItemDialog = battleItemDialog.findViewById(R.id.txtJamuAmountBattleItemDialog);
        txtHourglassAmountBattleItemDialog = battleItemDialog.findViewById(R.id.txtHourglassAmountBattleItemDialog);

        txtBandageAmountBattleItemDialog.setText("" + bandageAmount);
        txtJamuAmountBattleItemDialog.setText("" + jamuAmount);
        txtHourglassAmountBattleItemDialog.setText("" + hourglassAmount);

        imgBandageBattleItemDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(bandageAmount > 0){
                    bandageAmount--;
                    txtBandageAmountBattleItemDialog.setText("" + bandageAmount);

                    battleViewModel.getBattle(levelId);
                    battleViewModel.getBattleResult().observe(requireActivity(), battlePlayerEnemy -> {
                        if(battlePlayerEnemy != null){
                            userHealth += 10;
                            int maxUserHealth = battlePlayerEnemy.getBattleStudentData().get(0).getHealth();

                            if(userHealth > maxUserHealth){
                                userHealth = maxUserHealth;
                            }

                            txtPlayerHealthBattleFragment.setText("" + userHealth);
                        }
                    });

                    updateStudentItem();
                }
            }
        });

        imgJamuBattleItemDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(jamuAmount > 0){
                    jamuAmount--;
                    txtJamuAmountBattleItemDialog.setText("" + jamuAmount);

                    battleViewModel.getBattle(levelId);
                    battleViewModel.getBattleResult().observe(requireActivity(), battlePlayerEnemy -> {
                        if(battlePlayerEnemy != null){
                            int maxUserHealth = battlePlayerEnemy.getBattleStudentData().get(0).getHealth();

                            userHealth = maxUserHealth;

                            txtPlayerHealthBattleFragment.setText("" + userHealth);
                        }
                    });

                    updateStudentItem();
                }
            }
        });

        imgHourglassBattleItemDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(hourglassAmount > 0){
                    hourglassAmount--;
                    txtHourglassAmountBattleItemDialog.setText("" + hourglassAmount);

                    questionTimer.cancel();
                    timer += 10;

                    if(timer > 25){
                        timer = 25;
                    }

                    questionTimer = new CountDownTimer(timer * 1000, 1000) {
                        @Override
                        public void onTick(long l) {
                            timer = l / 1000;
                            txtTimerBattleFragment.setText("" + timer);
                        }

                        @Override
                        public void onFinish() {
                            answerWrong();
                            checkHealth(view);
                        }
                    }.start();

                    updateStudentItem();
                }
            }
        });

        battleItemDialog.show();

        txtCloseBattleItemDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                battleItemDialog.dismiss();
            }
        });
    }

    private void setListener(){
        btnUseItemBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                TODO: buat item dialog
                showItemDialog(view);
            }
        });

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
                    answerCorrect();
                }else{
                    answerWrong();
                }

                checkHealth(view);
            }
        });

        btnAnswerBBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerB.equals(correctAnswer)){
                    answerCorrect();
                }else{
                    answerWrong();
                }

                checkHealth(view);
            }
        });

        btnAnswerCBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerC.equals(correctAnswer)){
                    answerCorrect();
                }else{
                    answerWrong();
                }

                checkHealth(view);
            }
        });

        btnAnswerDBattleFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(answerD.equals(correctAnswer)){
                    answerCorrect();
                }else{
                    answerWrong();
                }

                checkHealth(view);
            }
        });
    }

    private void checkWinner(View view){
        questionTimer.cancel();

        if (userHealth <= 0) {
            txtPlayerHealthBattleFragment.setText("0");
            showLoseDialog(view);
        } else if (modeBattle.equals("story") && listQuestionIndex.size() <= 0) {
            showWinDialog(view);
        }

    }

    private void showLoseDialog(View battleView){
        loseDialog.setContentView(R.layout.battle_win_lose_dialog);
        loseDialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        TextView txtTitleWinLoseDialog, txtGoldWinLoseDialog, txtExpWinLoseDialog, txtExitWinLoseDialog, txtScoreWinLoseDialog, txtBattleScoreWinLoseDialog;
        Button btnReplayWinLoseDialog;
        ImageView imgCharacterWinLoseDialog;

        txtExitWinLoseDialog = loseDialog.findViewById(R.id.txtExitWinLoseDialog);
        txtGoldWinLoseDialog = loseDialog.findViewById(R.id.txtGoldWinLoseDialog);
        txtExpWinLoseDialog = loseDialog.findViewById(R.id.txtExpWinLoseDialog);
        txtTitleWinLoseDialog = loseDialog.findViewById(R.id.txtTitleWinLoseDailog);
        btnReplayWinLoseDialog = loseDialog.findViewById(R.id.btnReplayWinLoseDialog);
        imgCharacterWinLoseDialog = loseDialog.findViewById(R.id.imgCharacterWinLoseDialog);
        txtScoreWinLoseDialog = loseDialog.findViewById(R.id.txtScoreWinLoseDialog);
        txtBattleScoreWinLoseDialog = loseDialog.findViewById(R.id.txtBattleScoreWinLoseDialog);

        txtExitWinLoseDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loseDialog.dismiss();

                if(modeBattle.equals("story")){
                    Bundle bundle = new Bundle();
                    bundle.putInt("storyId", levelId / 10);
                    Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_to_storyActivity, bundle);
                }else{
                    Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_to_abyssActivity);
                }
            }
        });

        imgCharacterWinLoseDialog.setImageResource(R.drawable.downed_character);

        if(modeBattle.equals("story")) {
            txtTitleWinLoseDialog.setText("Anda Kalah");
            txtGoldWinLoseDialog.setText("+0");
            txtExpWinLoseDialog.setText("+0");

            btnReplayWinLoseDialog.setVisibility(View.VISIBLE);

            btnReplayWinLoseDialog.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    loseDialog.dismiss();

                    Bundle bundle = new Bundle();
                    bundle.putInt("levelId", levelId);
                    bundle.putInt("questionAmount", questionAmount);
                    bundle.putString("mode", modeBattle);
                    Navigation.findNavController(battleView).navigate(R.id.action_battleFragment_self, bundle);
                }
            });
        }else{
            txtTitleWinLoseDialog.setText("Permainan Berakhir");
            txtBattleScoreWinLoseDialog.setText("" + score);

            battleViewModel.updateAbyssBattleStudentData(score);
            battleViewModel.updateAbyssBattleStudentDataResult().observe(requireActivity(), battleReward -> {
                if(battleReward != null){
                    txtGoldWinLoseDialog.setText("+" + battleReward.getGold_rewards());
                    txtExpWinLoseDialog.setText("+" + battleReward.getExp_rewards());
                }
            });

            txtScoreWinLoseDialog.setVisibility(View.VISIBLE);
            txtBattleScoreWinLoseDialog.setVisibility(View.VISIBLE);
        }

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

        // get rewards and set rewards here
        battleViewModel.updateStudentBattleData(levelId);
        battleViewModel.updateStudentBattleDataResult().observe(requireActivity(), battleReward -> {
            if(battleReward != null){
                txtGoldWinLoseDialog.setText("+" + battleReward.getGold_rewards());
                txtExpWinLoseDialog.setText("+" + battleReward.getExp_rewards());
            }
        });

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
                        answerWrong();
                        checkHealth(battleView);
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
                answerWrong();
                checkHealth(view);
            }
        }.start();
    }

    private void randomInt(){
        if(modeBattle.equals("story")){
            questionIndex = new Random().nextInt(listQuestionIndex.size());
        }else{
            questionIndex = new Random().nextInt(questionAmount);
        }
    }


}