import React from 'react';
import { Container } from 'reactstrap';
import { Link } from 'react-router-dom';


const ProductCard = props => {

    const product = !props.dummy ? props.product : {};

    return (
        <Link to={{pathname: `/product/${product.id}`}} className='product-card'>
            <div className='product-image' style={{backgroundImage: product.image ? `url("${product.image}")` : ''}}></div>
            <div className='product-description'>
                <div className='product-name'>{product.name ? product.name : ''}</div>
                <small className='product-rating'>{product.rating && product.rating > 0 ? `${product.rating} star` : 'No review yet'}</small>
                {product.sellingPrice ?
                        <div className='product-price'>
                            <span className='product-selling-price'> ₹{product.offerEnable ? product.offerPrice : product.sellingPrice} </span>
                            <span className='product-not-price'>{product.offerEnable ? `₹${product.sellingPrice}` : ''}</span>
                            <span className='product-offer'> {product.offerEnable ? `${product.offerPercentage}% off` : ''}</span>
                        </div>
                : ''}
            </div>
        </Link>
    )
};

export default function ProductContainer(props) {
    const products = props.products;
    const title = props.title;
    const subtitle = props.subtitle;
    
    return (
        <Container fluid>
            <div className='card mt-3 mb-0'>
                <div className='card-header'>
                    <div className="card-title">{title}</div>
                    { subtitle ? <div className='card-subtitle'>{subtitle}</div> : '' }
                </div>
                <div className='card-body overflow-x p-0 mb-4 mx-4'>
                    <div className='products-container' style={{width: products.length === 0 ? '230px' : `${products.length * 190}px`}}>
                        {
                            products.length === 0 ? <ProductCard dummy={true} /> :
                                products.map(product => <ProductCard key={product.id} product={product} /> )
                        }
                    </div>
                </div>
            </div>
        </Container>
    )
}
