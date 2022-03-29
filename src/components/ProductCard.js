import React, { useEffect, useState } from 'react';
import Product from './Product';
import api from '../services/api';

export default function ProductCard(props) {
    const url = props.url;
    const title = props.title;
    const subtitle = props.subtitle;

    const [products,setProducts] = useState([]);
    useEffect(() => {
        api(url,{},result => {
            if(result.success)
                setProducts(result.products);
            else
                console.warn("Products could not be fetched. Error: " + result.text);
        });
    },[]);
    
    return (
        <section className='card'>
            <div className='card-header'>
                <div className="card-title">{title}</div>
                { subtitle ? <div className='card-subtitle'>{subtitle}</div> : '' }
            </div>
            <div className='card-body'>
                <div className='products-container' style={{width: products.length == 0 ? '190px' : `${products.length * 190}px`}}>
                    {
                        products.length == 0 ? <Product dummy={true} /> :
                            products.map(product => <Product key={product.id} product={product} /> )
                    }
                </div>
            </div>
        </section>
    )
}
