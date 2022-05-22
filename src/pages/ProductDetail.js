import React, { useEffect, useState } from 'react';
import api from '../services/api';

export default function ProductDetail(props) {
    
    const [product,setProduct] = useState({finding: true});
    const url = props.url ? props.url : 'product/2';
    const varietyId = props.varietyId ? props.varietyId : 2;

    useEffect(() => {
        api(url,{},result => {
            if(result.success){
                for(let i = 0; i < result.product.varieties.length; i++){
                    if(result.product.varieties[i].id === varietyId){
                        result.product['varietyId'] = result.product.varieties[i].id;
                        result.product['sellingPrice'] = result.product.varieties[i].sellingPrice;
                        result.product['offerEnable'] = result.product.varieties[i].offerEnable;
                        result.product['offerPrice'] = result.product.varieties[i].offerPrice;
                        result.product['offerPercentage'] = result.product.varieties[i].offerPercentage;
                        result.product['images'] = result.product.varieties[i].images;
                        result.product['features'] = result.product.varieties[i].features;
                        result.product['inStock'] = result.product.varieties[i].inStock;
                        result.product['name'] += ' | ' + result.product.varieties[i].name;
                        break;
                    }
                }
                setProduct(result.product);
            }
            else{
                setProduct({finding: false});
                console.warn(result.text);
            }
        });
    },[]);

    if(product.finding) return (<></>);
    else if(!product.finding && !product.id) return (<>Invalid page</>); //Invalid page
    return (
        <div className='product-details'>
            <div className='left-container'>
                <ProductImage images={product.images} />
                <ProductAction productId={product.id} varietyId={product.varietyId} />
            </div>
            <div className='right-container'>
                <div className='product-name'>{product.name ? product.name : ''}</div>
                <div className='product-brand'>{product.brand ? product.brand : ''}</div>
                <div className='product-brand'>{product.rating ? `${product.rating} stars` : ''}</div>

                <div className='product-price'>
                    {   product.sellingPrice ?
                            <>
                                <span className='selling-price'>₹{product.offerEnable ? product.offerPrice : product.sellingPrice} </span>
                                <span className='not-price'>{product.offerEnable ? `₹${product.sellingPrice}` : ''}</span>
                                <span className='product-offer'> {product.offerEnable ? `${product.offerPercentage}% off` : ''}</span>
                            </>
                        : ''
                    }
                </div>

                <div className='divider'></div>

                <div className='title'>Product Specification</div>
                <div className='product-specification'>
                    <div className='about'>{product.description ? product.description : ''}</div>
                    <div className='features'>{product.features ? product.features : ''}</div>
                </div>

                <div className='divider'></div>
            </div>
        </div>
    )
}

function ProductImage(props){
    const images = props.images ? props.images : [];

    const [active,setActive] = useState(0);

    const changeActive = i => {
        if(active !== i && i < images.length)
            setActive(i);
    };

    return (
        <div className='image-parent'>
            <div className='different-images'>
                {
                    images.map((image,index) =>
                        <div className={`different-image-container${index === active ? ' active' : '' }`} onClick={() => changeActive(index)} key={index}>
                            <div className='image' style={{backgroundImage: image ? `url("${image}")` : ''}}></div>
                        </div>
                    )
                }
            </div>
            <div className='image-container'>
                <div className='main-image' style={{backgroundImage: images ? `url("${images[active]}")` : ''}}></div>
            </div>
        </div>
    )
}

function ProductAction(props){
    
    const [cart,setCart] = useState(props.cart);

    const cartAction = () => {
        const url = 'cart';
        if(cart) return; //route to cart page

        const formData = new FormData();
        formData.append('productId',props.productId);
        formData.append('varietyId',props.varietyId);

        api(url,{method : 'POST',body: formData},result => {
            if(result.success || result.code === '113') setCart(true);
            else console.warn(result.text);
        });

    }

    return (
        <div className='actions'>
            <button className='action cart' onClick={cartAction}>{cart ? 'go' : 'add'} to cart</button>
            <button className='action buy'>Buy now</button>
        </div>
    );
}