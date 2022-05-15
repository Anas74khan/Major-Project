import React from 'react';

export default function ProductCard(props) {

    const product = !props.dummy ? props.product : {};

    return (
        <div className='product-card'>
            <div className='product-image' style={{backgroundImage: product.image ? `url("${product.image}")` : ''}}></div>
            <div className='product-description'>
                <div className='product-name'>{product.name ? product.name : ''}</div>
                <div className='product-rating'>{product.rating && product.rating > 0 ? `${product.rating} star` : 'No review yet'}</div>
                {product.sellingPrice ?
                        <div className='product-price'>
                            <span className='product-selling-price'> ₹{product.offerEnable ? product.offerPrice : product.sellingPrice} </span>
                            <span className='product-not-price'>{product.offerEnable ? `₹${product.sellingPrice}` : ''}</span>
                            <span className='product-offer'> {product.offerEnable ? `${product.offerPercentage}% off` : ''}</span>
                        </div>
                : ''}
            </div>
        </div>
    )
}
