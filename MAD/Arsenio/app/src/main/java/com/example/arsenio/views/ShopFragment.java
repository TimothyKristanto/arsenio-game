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

import android.os.Handler;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.arsenio.R;
import com.example.arsenio.helper.SharedPreferenceHelper;
import com.example.arsenio.models.Shop;
import com.example.arsenio.viewmodels.ShopViewModel;

import java.util.List;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ShopFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class ShopFragment extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    public ShopFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment ShopActivity.
     */
    // TODO: Rename and change types and number of parameters
    public static ShopFragment newInstance(String param1, String param2) {
        ShopFragment fragment = new ShopFragment();
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
        return inflater.inflate(R.layout.fragment_shop, container, false);
    }

    //  View
    private Button btnDetailBandage, btnDetailHourglass, btnDetailJamu,
        buyButtonBandage, buyButtonHourglass, buyButtonJamu;

    private TextView txtArsenioShopFragment,
            txtBandagePrice, txtHourglassPrice, txtJamuPrice,
            txtGoldShopFragment,
            txtAmountBandage, txtAmountHourglass, txtAmountJamu;

    private EditText inputAmountBandage, inputAmountHourglass, inputAmountJamu;

    private ImageView logoArsenioShopFragment, imgHomeShopFragment,
            minusAmountBandage, plusAmountBandage,
            minusAmountHourglass, plusAmountHourglass,
            minusAmountJamu, plusAmountJamu,
            refreshViewBtn;

    //  Variables
    private SharedPreferenceHelper sharedPreferenceHelper;
    private ShopViewModel shopViewModel;

    // Data
    private List<Shop.ItemStudent> itemStudents;
    private List<Shop.Item> items;
    private int amountBandage, amountHourglass, amountJamu,
            bandagePrice, hourglassPrice, jamuPrice,
            totalBandage, totalHourglass, totalJamu,
            goldOwned, golds;

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        loadingRefresh(0);
        initView(view);

        onClickListener();

    }


    private void onClickListener() {
        // Dialog Detail
        btnDetailBandage.setOnClickListener(v -> openDetailDialog(0));

        btnDetailHourglass.setOnClickListener(v -> openDetailDialog(2));

        btnDetailJamu.setOnClickListener(v -> openDetailDialog(1));

        // Plus Minus Amount
            //Bandage
        plusAmountBandage.setOnClickListener(v -> {
            amountBandage = Integer.parseInt(inputAmountBandage.getText().toString());
            amountBandage++;
            txtBandagePrice.setText(String.valueOf(bandagePrice*amountBandage));
            inputAmountBandage.setText(String.valueOf(amountBandage));

        });
        minusAmountBandage.setOnClickListener(v -> {
            amountBandage = Integer.parseInt(inputAmountBandage.getText().toString());
            if(amountBandage <= 1){
                txtBandagePrice.setText(String.valueOf(bandagePrice));
            }else if(amountBandage > 1){
                amountBandage--;
                txtBandagePrice.setText(String.valueOf(bandagePrice*amountBandage));
            }

            inputAmountBandage.setText(String.valueOf(amountBandage));
        });

            //Hourglass
        plusAmountHourglass.setOnClickListener(v -> {
            amountHourglass = Integer.parseInt(inputAmountHourglass.getText().toString());
            amountHourglass++;
            txtHourglassPrice.setText(String.valueOf(amountHourglass*hourglassPrice));
            inputAmountHourglass.setText(String.valueOf(amountHourglass));
        });
        minusAmountHourglass.setOnClickListener(v -> {
            amountHourglass = Integer.parseInt(inputAmountHourglass.getText().toString());
            if(amountHourglass <= 1){
                txtHourglassPrice.setText(String.valueOf(hourglassPrice));
            }else if(amountHourglass > 1){
                amountHourglass--;
                txtHourglassPrice.setText(String.valueOf(amountHourglass*hourglassPrice));
            }

            inputAmountHourglass.setText(String.valueOf(amountHourglass));
        });

            //Jamu
        plusAmountJamu.setOnClickListener(v -> {
            amountJamu = Integer.parseInt(inputAmountJamu.getText().toString());
            amountJamu++;
            txtJamuPrice.setText(String.valueOf(amountJamu*jamuPrice));
            inputAmountJamu.setText(String.valueOf(amountJamu));
        });
        minusAmountJamu.setOnClickListener(v -> {
            amountJamu = Integer.parseInt(inputAmountJamu.getText().toString());
            if(amountJamu <= 1){
                txtJamuPrice.setText(String.valueOf(jamuPrice));
            }else if(amountJamu > 1){
                amountJamu--;
                txtJamuPrice.setText(String.valueOf(amountJamu*jamuPrice));
            }

            inputAmountJamu.setText(String.valueOf(amountJamu));
        });

        // Buy Button
            //Bandage
        buyButtonBandage.setOnClickListener(v -> {
            amountBandage = Integer.parseInt(inputAmountBandage.getText().toString());
            if(amountBandage == 0){
                Toast.makeText(requireActivity(), "Pembelian tidak berhasil, jumlah harus lebih dari nol", Toast.LENGTH_SHORT).show();
            }else{
                shopViewModel.getItemsResult().observe(requireActivity(), shop -> {
                    goldOwned = shop.getShopStudentData().get(0).getGolds();
                    totalBandage = shop.getItemStudent().get(0).getItem_owned();
                });
                int totalPrice = bandagePrice*amountBandage;
                if( goldOwned >= totalPrice){
                    goldOwned = goldOwned - totalPrice;
                    totalBandage = totalBandage + amountBandage;
                    shopViewModel.updateItemStudent(1, totalBandage, goldOwned);
                    loadingRefresh(1);
                    Toast.makeText(requireActivity(), "Anda telah membeli PERBAN sejumlah "+amountBandage, Toast.LENGTH_SHORT).show();
                }else {
                    Toast.makeText(requireActivity(), "Pembelian tidak berhasil, GOLD tidak cukup", Toast.LENGTH_SHORT).show();
                }
                inputAmountBandage.setText(""+0);
            }
        });

            //Hourglass
        buyButtonHourglass.setOnClickListener(v -> {
            amountHourglass = Integer.parseInt(inputAmountHourglass.getText().toString());
            if(amountHourglass == 0){
                Toast.makeText(requireActivity(), "Pembelian tidak berhasil, jumlah harus lebih dari nol", Toast.LENGTH_SHORT).show();
            }else{
                shopViewModel.getItemsResult().observe(requireActivity(), shop -> {
                    goldOwned = shop.getShopStudentData().get(0).getGolds();
                    totalHourglass = shop.getItemStudent().get(2).getItem_owned();
                });
                int totalPrice = hourglassPrice*amountHourglass;
                if( goldOwned >= totalPrice){
                    goldOwned = goldOwned - totalPrice;
                    totalHourglass = totalHourglass + amountHourglass;
                    shopViewModel.updateItemStudent(3, totalHourglass, goldOwned);
                    loadingRefresh(1);
                    Toast.makeText(requireActivity(), "Anda telah membeli JAM PASIR sejumlah "+amountHourglass, Toast.LENGTH_SHORT).show();
                }else {
                    Toast.makeText(requireActivity(), "Pembelian tidak berhasil, GOLD tidak cukup", Toast.LENGTH_SHORT).show();
                }
                inputAmountHourglass.setText(""+0);
            }
        });

            //Jamu
        buyButtonJamu.setOnClickListener(v -> {
            amountJamu = Integer.parseInt(inputAmountJamu.getText().toString());
            if(amountJamu == 0){
                Toast.makeText(requireActivity(), "Pembelian tidak berhasil, jumlah harus lebih dari nol", Toast.LENGTH_SHORT).show();
            }else{
                shopViewModel.getItemsResult().observe(requireActivity(), shop -> {
                    goldOwned = shop.getShopStudentData().get(0).getGolds();
                    totalJamu = shop.getItemStudent().get(1).getItem_owned();
                });
                int totalPrice = jamuPrice*amountJamu;
                if( goldOwned >= totalPrice){
                    goldOwned = goldOwned - totalPrice;
                    totalJamu = totalJamu + amountJamu;
                    shopViewModel.updateItemStudent(2, totalJamu, goldOwned);
                    loadingRefresh(1);
                    Toast.makeText(requireActivity(), "Anda telah membeli JAMU sejumlah "+amountJamu, Toast.LENGTH_SHORT).show();
                }else {
                    Toast.makeText(requireActivity(), "Pembelian tidak berhasil, GOLD tidak cukup", Toast.LENGTH_SHORT).show();
                }
                inputAmountJamu.setText(""+0);

            }
        });



        //Navbar
        logoArsenioShopFragment.setOnClickListener(v -> {
            Navigation.findNavController(v).navigate(R.id.action_shopActivity_to_homeActivity);
        });
        imgHomeShopFragment.setOnClickListener(v -> {
            Navigation.findNavController(v).navigate(R.id.action_shopActivity_to_homeActivity);
        });
        txtArsenioShopFragment.setOnClickListener(v -> {
            Navigation.findNavController(v).navigate(R.id.action_shopActivity_to_homeActivity);
        });

        //Refresh
        refreshViewBtn.setOnClickListener(v -> {
            loadingRefresh(1);
        });
    }


    private void resetView(View view) {
        shopViewModel.getItems();
        shopViewModel.getItemsResult().observe(requireActivity(), shop -> {
            golds = shop.getShopStudentData().get(0).getGolds();
            txtGoldShopFragment.setText(String.valueOf(golds));

            items = shop.getItem();
            itemStudents = shop.getItemStudent();
            // Bandages
                //Amount
            txtAmountBandage = view.findViewById(R.id.txtAmountBandage);
            String bandageOwned = String.valueOf(itemStudents.get(0).getItem_owned());
            txtAmountBandage.setText(bandageOwned);
                //Price
            txtBandagePrice = view.findViewById(R.id.txtBandagePrice);
            bandagePrice = items.get(0).getSingle_price();
            txtBandagePrice.setText(String.valueOf(bandagePrice));

            // Hourglass
                //Amount
            txtAmountHourglass = view.findViewById(R.id.txtAmountHourglass);
            String hourglassOwned = String.valueOf(itemStudents.get(2).getItem_owned());
            txtAmountHourglass.setText(hourglassOwned);
                //Price
            txtHourglassPrice = view.findViewById(R.id.txtHourglassPrice);
            hourglassPrice = items.get(2).getSingle_price();
            txtHourglassPrice.setText(String.valueOf(hourglassPrice));

            // Jamu
                //Amount
            txtAmountJamu = view.findViewById(R.id.txtAmountJamu);
            String jamuOwned = String.valueOf(itemStudents.get(1).getItem_owned());
            txtAmountJamu.setText(jamuOwned);
                //Price
            txtJamuPrice = view.findViewById(R.id.txtJamuPrice);
            jamuPrice = items.get(1).getSingle_price();
            txtJamuPrice.setText(String.valueOf(jamuPrice));
        });

    }


    private void initView(View view) {
        //Database - View Model Set Up
        sharedPreferenceHelper = SharedPreferenceHelper.getInstance(requireActivity());
        shopViewModel = new ViewModelProvider(requireActivity()).get(ShopViewModel.class);
        shopViewModel.init(sharedPreferenceHelper.getAccessToken());

        //Dialog Detail
        btnDetailBandage = view.findViewById(R.id.btnDetailBandage);
        btnDetailHourglass = view.findViewById(R.id.btnDetailHourglass);
        btnDetailJamu = view.findViewById(R.id.btnDetailJamu);

        //Navbar
        logoArsenioShopFragment = view.findViewById(R.id.logoArsenioShopFragment);
        imgHomeShopFragment = view.findViewById(R.id.imgHomeShopFragment);
        txtArsenioShopFragment = view.findViewById(R.id.txtArsenioShopFragment);
        txtGoldShopFragment = view.findViewById(R.id.txtGoldShopFragment);

        //Get Data and Init View <--//
        resetView(view);

        //Plus Minus
        minusAmountBandage = view.findViewById(R.id.minusAmountBandage);
        plusAmountBandage = view.findViewById(R.id.plusAmountBandage);
        minusAmountHourglass = view.findViewById(R.id.minusAmountJamPasir);
        plusAmountHourglass = view.findViewById(R.id.plusAmountJamPasir);
        minusAmountJamu = view.findViewById(R.id.minusAmountJamu);
        plusAmountJamu = view.findViewById(R.id.plusAmountJamu);

        //Buy Button
        buyButtonBandage = view.findViewById(R.id.buyButtonBandage);
        buyButtonHourglass = view.findViewById(R.id.buyButtonHourglass);
        buyButtonJamu = view.findViewById(R.id.buyButtonJamu);

        //Amount
        inputAmountBandage = view.findViewById(R.id.inputAmountBandage);
        inputAmountHourglass = view.findViewById(R.id.inputAmountHourglass);
        inputAmountJamu = view.findViewById(R.id.inputAmountJamu);

        //Refresh
        refreshViewBtn = view.findViewById(R.id.refreshViewBtn);
    }

    // Dialog Session
    Dialog dialogDetail;
    TextView detailItemName, detailItemDetail, detailItemSinglePrice, detailItemOwned;

    private void openDetailDialog(int id) {
        dialogDetail = new Dialog(requireContext());
        dialogDetail.setContentView(R.layout.detail_item_layout_dialog);
        dialogDetail.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        detailItemName = dialogDetail.findViewById(R.id.detailItemName);
        detailItemDetail = dialogDetail.findViewById(R.id.detailItemDetail);
        detailItemSinglePrice = dialogDetail.findViewById(R.id.detailItemSinglePrice);
        detailItemOwned = dialogDetail.findViewById(R.id.detailItemOwned);

        String name = items.get(id).getName();
        detailItemName.setText(name);
        String detail = items.get(id).getDescription();
        detailItemDetail.setText(detail);
        String itemOwned = String.valueOf(itemStudents.get(id).getItem_owned());
        detailItemOwned.setText(itemOwned);
        String price = String.valueOf(items.get(id).getSingle_price());
        detailItemSinglePrice.setText(price);

        dialogDetail.show();
    }

    private void loadingRefresh(int param){
        dialogDetail = new Dialog(requireContext());
        dialogDetail.setContentView(R.layout.loading_shop);
        dialogDetail.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        if(param == 1){
            resetView(getView());
        }
        dialogDetail.show();
        Handler handler = new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                dialogDetail.dismiss();
            }
        }, 3000);
    }
}