@extends("template.mainPage")

@section('webTitle', 'Arsenio: Shop')

@section('mainContent')

    <body class="shop-bg">
        @if(session()->has('itemDesc'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-warning alert-dismissable fade show item-desc-alert" role="alert">
                    {{ session('itemDesc') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="shop-area row mt-3 mb-3">
            @php
                $index = 1;
            @endphp
            @foreach ($items as $item)
            <div class="col-md-4 shop-items">

                <div class="detail-item-icon">
                    <a class="text-center icon-detail-item" href="/shop/{{$item->item_id}}/0/t">
                        <i class="fa fa-question" aria-hidden="true">
                        <br>
                        <p class="detail-item">Detail</p>
                        </i>
                    </a>
                </div>

                <img src="{{$item->image}}">

                {{-- <a type="button" class="tombol-beli btn btn-success" data-toggle="modal" data-target="#buyModal" > Beli </a> --}}
                <div class="info-item">
                    <h5 class="item-price">Harga: {{$item->single_price}}</h5>
                    <h5 class="item-owned">Dimiliki: {{$itemStudent[$index-1]->item_owned}}</h5>
                </div>
                <div class="shop-action">
                    <input id="amountOfItem{{$index}}" class="inputAmount" type="number" min="0" max="999">
                    {{-- <button onclick="decrement(amountOfItem{{$index}})" class="action-item"> - </button> --}}
                    {{-- <button onclick="increment(amountOfItem{{$index}})" class="action-item"> + </button> --}}
                    <button onclick="getAmount('{{$item->item_id}}', 'amountOfItem{{$index}}')" class="btn btn-success">Beli</button>
                </div>

                @php
                    $index++;
                @endphp
            </div>
            @endforeach

            {{-- <div id="buyModal" class="modal fade" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buyModalLabel">Beli {{$item->name}}</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('shop.update', $item->item_id)}}" method="post">
                        <input type="hidden" name="student_id" value="{{$student->student_id}}">
                            <div class="modal-body">
                                <p class="modalData">Dimiliki : {{$itemOwned}}</p>
                                    {{ csrf_field() }}
                                    <label>Jumlah :</label>
                                    <input name="amount" type="number" id="amount" placeholder="Jumlah">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Beli</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}

        </div>

        {{-- JavaScript --}}
        <script>
            function getAmount(item_id, element_id){
                let amount = document.getElementById(element_id).value;
                window.location.href = "/shop/"+item_id+"/"+amount+'/f';
            }

            // function increment(amount) {

            //    let itemCounter = document.getElementById(amount);
            //    for(int i = 0; i < itemCounter.length(); i++){
            //        itemCounter.stepUp();
            //    }
            // }
            // function decrement(amount) {
            //     let itemCounter = document.getElementById(amount);
            //    for(int i = 0; i < itemCounter.length(); i++){
            //        itemCounter.stepDown();
            //    }
            // }
         </script>

    </body>
@endsection
