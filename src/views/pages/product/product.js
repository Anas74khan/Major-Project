import ProductContainer from 'components/Home/ProductContainer';
import Loader from 'components/Loader';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { Row, Col, Card, CardBody, Button } from 'reactstrap';
import { isLoggedIn } from 'services/api';
import { api } from 'services/api';

function Product(props){
  const productId = props.match.params.product;
  const [product, setProduct] = useState({});
  const [variety, setVariety] = useState(0);

  useEffect(() => {
    api('product/' + productId, {}, result => {
      if(!result.success) window.location.replace(window.location.protocol + '//' + window.location.host + '/home');

      setProduct(result.product);
    });
  }, []);

  if(!product.id)
    return (
      <Loader />
    );

  return (
    <>
      
      <Card style={{boxShadow: "unset", borderRadius: "0"}}>
        <CardBody className='product'>
          <Row>

            <Col lg="5" md="6" className='product-left-container'>
              <ProductImage images={product.varieties[variety].images}/>
              <ActionButton productId={product.id} varietyId={product.varieties[variety].id} inCart={product.varieties[variety].inCart} />
            </Col>

            <Col lg="7" md="6">

              <small className='font-weight-600'>{product.brand}</small>
              <h3>{product.name} | {product.varieties[variety].name}</h3>
              { product.varieties[variety].offerEnable ? <p className='text-success font-weight-600'>Special Offers</p> : ''}
              
              <div className='price-container mb-2'>
                <span className='selling-price'>{ product.varieties[variety].offerEnable ? `₹${product.varieties[variety].offerPrice}` : product.varieties[variety].sellingPrice }</span>
                <span className='not-price'>{ product.varieties[variety].offerEnable ? `₹${product.varieties[variety].sellingPrice}` : '' }</span>
                <span className='offer'>{ product.varieties[variety].offerEnable ? `${product.varieties[variety].offerPercentage}% off` : '' }</span>
              </div>

              <p>
                <span className='bg-success text-white py-1 px-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                  {product.rating} <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                </span>
                <span className='ml-2' style={{color:'#808080', fontSize:16, fontWeight:500}}>{product.ratingCount} reviews</span>
              </p>
              <div>
                <p className='font-weight-500' style={{fontSize:14}}><i className="fas fa-tag text-success mr-2"></i><span>Free Delivery</span> within 3 days</p>
              </div>
              
              <div>
                <h3>Product Description</h3>
                <div>
                  {product.description}
                </div>
                <div>
                  {product.varieties[variety].features !== null ? product.varieties[variety].features : ''}
                </div>
              </div>
              <hr className="my-3 bg-secondary shadow"/>

              <ReviewContainer reviews={product.reviews} />
              

            </Col>

          </Row>
        </CardBody>
      </Card>

      {/* <ProductContainer url="products/all/all/all/0/6" title="Similar Product" subtitle="You may like" /> */}
    </>
  )
}

function ProductImage(props){
  const images = props.images;

  const [active, setActive] = useState(0);

  const change = index => {
    if(active !== index) setActive(index);
  };

  return (
    <>
      <div className='product-image-container'>
        <div className='product-image' style={{backgroundImage: `url(${images[active]})`}}></div>
      </div>
              
      <div className='overflow-x mb-2 no-sc'>
        <div style={{width: `${(64 * images.length) + 2}px`}}>
          {
            images && images.map((image, index) => 
              <div className={`product-small-image-container${index === active ? ' active' : ''}`} key={index} onMouseEnter={() => change(index)}>
                <div
                  className={`small-product-image`}
                  style={{backgroundImage: `url(${image})`}}
                />
              </div>
            )
          }
        </div>
      </div>
    </>
  );
}

function ActionButton(props){
  const [inCart, setInCart] = useState(props.inCart);
  const isLogin = isLoggedIn();

  const addToCart = (cartPage = false) => {
    if(!isLogin) return alert("Please login!");

    api('cart', {
        method: "POST",
        body: JSON.stringify({
          varietyId: props.varietyId,
          productId: props.productId
        })
      },
      response => {
      if(!response.success) return alert(response.text);

      if(cartPage) window.location.href = window.location.protocol + '//' + window.location.host + '/cart';
      setInCart(true);
    });
  };

  return(
    <Row className='below-md-fixed'>
      <Col>
        {inCart ?
          <Button
            color='primary'
            type="button"
            className='btn-block'
            tag={Link}
            to={'/cart'}
          >
            Go to Cart
          </Button> :
          <Button
            color='primary'
            type="button"
            className='btn-block'
            onClick={() => addToCart()}
          >
            Add to Cart
          </Button>
        }
          
      </Col>
      <Col>
          <Button color="warning" type="button" className='btn-block' onClick={() => addToCart(true)}>Buy Now</Button>
      </Col>
    </Row>
  )
}

function ReviewContainer(props){
  const reviews = props.reviews;

  if(reviews && reviews.length === 0) return (<></>);

  const Review = props => {
    const review = props.review;

    return (
      <>
        <div className='mt-4'>
          <h4 className='text-dark font-weight-600'>
            <span className='bg-success text-white py-1 px-2 mr-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
              {review.rating} <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
            </span>
          </h4>
          <p>{review.description}</p>
          <p className='font-weight-500 mb-0' style={{fontSize:14}}><b className='mr-3 text-dark'>{review.name}</b>{review.date}</p>
        </div>
        <hr className="my-3 bg-secondary shadow" />
      </>
    );
  }

  return (
    <div>
      <h3>Ratings &amp; Reviews</h3>
      {
        reviews.map((review, index) => <Review review={review} key={index}/> )
      }
    </div>
  );
}

export default Product;