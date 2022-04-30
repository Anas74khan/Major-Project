@extends('auth')

@section('pageStyle')

    <style>

        .product-detail h5{
            line-height: 32px;
        }
        .product-detail p{
            font-size: 14px;
            margin-bottom: 0;
        }
        .product-detail p span{
            font-weight: 600;
        }
        .rating{
            padding: 20px;
            margin-right: 20px;
            text-align: center;
        }
        .rating .stars{
            font-size: 30px;
            font-weight: bold;
        }
        .product{
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        .product + .product{
            margin-top: 60px;
        }
        .product + .product::before{
            position: absolute;
            top: -30px;
            left: 0;
            content: '';
            width: 100%;
            height: 1px;
            background: #eee;
        }
        .product .product-image{
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 5px;
            margin-right: 20px;
        }
        .product .product-image .image{
            width: 100px;
            height: 100px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }
        .product .details{
            /* padding: 2px 10px; */
        }
        .product .details > div{
            margin-bottom: 5px;
        }
        .product .details .stock{
            margin-bottom: 0;
            padding-top: 5px;
        }
        .product .details .variety-name{
            font-size: 20px;
            font-weight: 600;
        }
        .product .details .variety-price .not-price{
            position: relative;
            color: #999;
            font-size: 13px;
        }
        .product .details .variety-price .not-price::after{
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            background-color: #999;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }
        .product .details .variety-price .price{
            font-size: 20px;
            font-weight: bold;
            margin-left: 5px;
            line-height: 14px;
        }
        .product .details .variety-price .offer-percent{
            font-size: 13px;
            margin-left: 5px;
            color: var(--green);
        }
        .product .details .tags span{
            font-weight: 600;
        }
        .product .bt-switch{
            position: relative;
        }
        .upload-product-image{
            height: 110px;
            width: 110px;
            border: 1px solid #EEE;
            padding: 5px;
            cursor: pointer;
        }
        .upload-product-image .image-container{
            height: 100px;
            width: 100px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }
        .image-upload-container{
            width: 110px;
            height: 110px;
            text-align: center;
        }
        .image-upload-container img{
            max-width: 100px;
            max-height: 100px;
        }

    </style>

@stop


@section('pageContent')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="product-detail">
                            <h5>{!! $product['name'] !!}</h5>
                            <p>Categories : <span>{!! join(", ",$product['categories']) !!}</span></p>
                            <p>Sub categories : <span>{!! join(", ",$product['subCategories']) !!}</span></p>
                            <p>Brand : <span>{!! $product['brand'] !!}</span></p>
                        </div>
                        <div class="rating">
                            <div class="stars">{{ $stars }}<i class="mdi mdi-star"></i></div>
                            <div class="ratings">{{ $ratings }} Ratings</div>
                            <button class="btn btn-success mt-2" onclick="showVarietyModal()">Add Variety</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-body">
                        @foreach($varieties as $variety)
                        
                            <div class="product">
                                <div class="d-flex">
                                    <div class="product-image">
                                        <div class="image" style="background-image:url('{!!$variety['images'][0] !!}')"></div>
                                    </div>
                                    <div class="details">
                                        <div class="variety-name">{!! $variety['name'] !!}</div>
                                        <div class="variety-price">
                                            <span class="not-price">{{ $variety['offerEnable'] ? '₹'.$variety['sellingPrice'] : '' }}</span>
                                            <span class="price">₹{{ $variety['offerEnable'] ? $variety['offerPrice'] : $variety['sellingPrice'] }}</span>
                                            <span class="offer-percent">{{ $variety['offerEnable'] ? $variety['offerPercentage'].'% off' : '' }}</span>
                                        </div>
                                        <div class="tags">
                                            Tags: <span>{!! $variety['tags'] !!}</span>
                                        </div>
                                        <div class="stock bt-switch">
                                            <input
                                                type="checkbox"
                                                class="switch productVisibility"
                                                {{ $variety['visibility'] ? 'checked' : '' }}
                                                data-on-color="primary"
                                                data-off-color="danger"
                                                data-on-text="Enable"
                                                data-off-text="Disable"
                                                value="1"
                                                data-variety_id="{{ $variety['id'] }}"
                                            />
                                            <input
                                                type="checkbox"
                                                class="switch productInStock"
                                                {{ $variety['inStock'] ? 'checked' : '' }}
                                                data-on-color="success"
                                                data-off-color="danger"
                                                data-on-text="In stock"
                                                data-off-text="Out of stock"
                                                value="1"
                                                data-variety_id="{{ $variety['id'] }}"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="description">
                                    {!! $variety['features'] !!}
                                </div> -->
                                <div class="btn-container">
                                    <button
                                        class="btn btn-orange rounded text-white"
                                        onclick="showVarietyModal('edit', {{ $variety['id'] }})"
                                        >
                                            Edit details <i class="mdi mdi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade variety-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" id="varityForm">

                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="productId" id="productId" value="{{ $product['id'] }}"/>
                        <input type="hidden" name="_method" id="methodType" value="put"/>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <label for="Images" class="col-2">Images</label>
                                    <div class="col-10 pl-0">
                                        <div class="image-upload-container">
                                            <input
                                                type="file"
                                                name="images[]"
                                                class="product-image"
                                            />
                                            <img />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <label for="description" class="col-2">Name</label>
                                    <input type="text" name="name" id="name" class="col-10 form-control" required validate />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <label for="description" class="col-2">Description</label>
                                    <textarea name="features" id="features" class="col-10 form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <label for="description" class="col-2">Price</label>
                                    <input type="text" name="sellingPrice" id="sellingPrice" class="form-control col-10" required validate onchange="updatePrice()" onkeyup="checkNumeric(this)" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-2">Offer</label>
                                    <div class="col-10 p-0">
                                        <div class="bt-switch">
                                            <input
                                                type="checkbox"
                                                name="offerEnable"
                                                id="offerEnable"
                                                data-on-color="success"
                                                data-off-color="danger"
                                                data-on-text="Available"
                                                data-off-text="Unavailable"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 offer_fields hide">
                            <div class="form-group">
                                <div class="row">
                                    <label for="offerPrice" class="col-4">Offer Price</label>
                                    <input type="text" name="offerPrice" id="offerPrice" class="form-control col-8" onchange="updatePrice(true)" onkeyup="checkNumeric(this)" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 offer_fields hide">
                            <div class="form-group">
                                <div class="row">
                                    <label for="offerPercentage" class="col-4">Offer Percent</label>
                                    <input type="text" name="offerPercentage" id="offerPercentage" class="form-control col-8" onchange="updatePrice()" onkeyup="checkNumeric(this,false)" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save-btn">Save changes</button>
                </div>
                
            </form>
        </div>
    </div>

    <form action="javascript:void(0)" id="putForm">
        <input type="hidden" name="_method" value="PUT" />
    </form>

@stop


@section('pageScript')

    <script>

        const varieties = JSON.parse(`{!! json_encode($varieties) !!}`);
        const pop = $(document).find('.variety-modal');
        
        $(function(){

            $(document).find('#offerEnable').on("switchChange.bootstrapSwitch",function(e){
                if($(this).is(':checked'))
                    pop.find('.offer_fields').removeClass('hide');
                else
                    pop.find('.offer_fields').addClass('hide');
            });

            $(document).on("submit","#varityForm",e => {
                e.preventDefault();
                const id = parseInt(pop.find('#id').val());

                if(id == 0 && !pop.find('.image-upload-container').find('input').val())
                    return alert("Please provide the image.");
                    
                loader.show();

                const url = '{{ url('variety') }}' + (id > 0 ? `/${id}` : '');
                
                let formdata = new FormData(document.getElementById('varityForm'));

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: (response, status, xhr) => {
                        if(response.success) return window.location.reload();
                        loader.hide();
                        swal({
                            title: response.error,
                            text: "",
                            type: "error",   
                        });
                    },
                    error: e => {alert('Some error occured! Try refreshing the page.'); console.log(e);}
                });
            });

            $(document).find('.productVisibility').on("switchChange.bootstrapSwitch",function(e){
                const url = `{!! url('visibility/variety') !!}/${ $(this).data('variety_id') }`;
                const val = $(this).is(':checked') ? 1 : '';
                
                loader.show();

                let formdata = new FormData(document.getElementById('putForm'));
                formdata.append('visibility', val);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: (response, status, xhr) => {
                        loader.hide();
                        swal({
                            title: response.text,
                            text: "",
                            type:  response.success ? "success" : "error",   
                        });
                    },
                    error: e => alert('Some error occured! Try refreshing the page.')
                });

            });

            $(document).find('.productInStock').on("switchChange.bootstrapSwitch",function(e){
                const url = `{!! url('stock/variety') !!}/${ $(this).data('variety_id') }`;
                const val = $(this).is(':checked') ? 1 : '';

                loader.show();

                let formdata = new FormData(document.getElementById('putForm'));
                formdata.append('inStock', val);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: (response, status, xhr) => {
                        loader.hide();
                        swal({
                            title: response.text,
                            text: "",
                            type:  response.success ? "success" : "error",   
                        });
                    },
                    error: e => alert('Some error occured! Try refreshing the page.')
                });
            });

        });
        
        const checkNumeric = (e,numeric = true) => {
            let value = $(e).val();
            let foundDot = true;
            if(!numeric)
                foundDot = false;
            let ans = ""
            for(let i = 0; i < value.length; i++){
                if(value.charCodeAt(i) >= 48 && value.charCodeAt(i) <= 57)
                    ans += value[i];
                else if(value[i] == "." && !foundDot) ans += value[i];
                else break;
            }
            $(e).val(ans);
        };

        const updatePrice = (offer = false) => {
            const sellingPrice = parseFloat(pop.find('#sellingPrice').val());
            let offerPrice = parseFloat(pop.find('#offerPrice').val());
            let offerPercentage = parseFloat(pop.find('#offerPercentage').val());
            if(offer)
                offerPercentage = Math.round(((sellingPrice - offerPrice) / sellingPrice) * 100);
            else
                offerPrice = Math.round((sellingPrice * 100) - (sellingPrice * offerPercentage)) / 100
            pop.find('#sellingPrice').val(sellingPrice)
            pop.find('#offerPrice').val(offerPrice)
            pop.find('#offerPercentage').val(offerPercentage)
        };
        
        function showVarietyModal(type = "add",id = 0){
            let variety = {
                'features' : '',
                'id' : 0,
                'name' : '',
                'offerEnable' : 0,
                'offerPercentage' : 0,
                'offerPrice' : 0,
                'sellingPrice' : '',
                'tags' : '',
                'images' : ['{!! asset('images/placeholder.png') !!}']
            };

            let title = "Add";
            pop.find('#methodType').val('POST');
            if(type === "edit"){
                title = "Edit";
                pop.find('#methodType').val('PUT');
            }
            title += " Variety";
            pop.find('.modal-title').html(title);

            for(let i = 0; i < varieties.length && type == 'edit'; i++){
                if(varieties[i].id == id){
                    variety = varieties[i];
                    break;
                }
            }

            title = "Save";
            if(type === "edit")
                title += " Changes";
            pop.find('.save-btn').html(title);

            pop.find('#id').val(variety.id);
            pop.find('#name').val(variety.name);
            pop.find('#features').val(variety.features);
            pop.find('#sellingPrice').val(variety.sellingPrice);
            pop.find('#offerPrice').val(variety.offerPrice);
            pop.find('#offerPercentage').val(variety.offerPercentage);

            // Temporary
            pop.find('.image-upload-container').find('input').val('');
            pop.find('.image-upload-container').find('img').attr('data-image',variety.images[0]);
            pop.find('.image-upload-container').find('img').attr('src',variety.images[0]);
            // Temporary end

            if(variety.offerEnable)
                pop.find('#offerEnable').prop('checked',true).trigger('change');
            else
                pop.find('#offerEnable').prop('checked',false).trigger('change');

            pop.find('#varietyId').val(id);
            pop.modal('show');
        }


    </script>

@stop