import ProductContainer from 'components/Home/ProductContainer';
import Loader from 'components/Loader';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { Row, Col, Card, CardBody, Button } from 'reactstrap';
import api from 'services/api';

function Product(props){
  const productId = props.match.params.product;
  const [product, setProduct] = useState({});
  const [variety, setVariety] = useState(0);

  useEffect(() => {
    api('product/' + productId, {}, result => {
      if(!result.success) window.location.replace("home");

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
              <ActionButton productId={product.id} varietyId={product.varieties[variety].id} />
            </Col>

            <Col lg="7" md="6">

              <small className='font-weight-600'>{product.brand}</small>
              <h3>{product.name} | {product.varieties[variety].name}</h3>
              { product.varieties[variety].offerEnable ? <p className='text-success font-weight-600'>Special Offers</p> : ''}
              
              <div className='price-container mb-2'>
                <span className='selling-price'>{ product.varieties[variety].offerEnable ? `₹${product.varieties[variety].sellingPrice}` : product.varieties[variety].offerPrice }</span>
                <span className='not-price'>{ product.varieties[variety].offerEnable ? `₹${product.varieties[variety].sellingPrice}` : '' }</span>
                <span className='offer'>{ product.varieties[variety].offerEnable ? `${product.varieties[variety].offerPercentage}% off` : '' }</span>
              </div>

              <p>
                <span className='bg-success text-white py-1 px-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                  3.5 <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                </span>
                <span className='ml-2' style={{color:'#808080', fontSize:16, fontWeight:500}}>370 ratings and 32 reviews</span>
              </p>
              <div>
                <p className='font-weight-500' style={{fontSize:14}}><i className="fas fa-tag text-success mr-2"></i><span>Free Delivery</span> within 3 days</p>
              </div>
              
              <div>
                <h3>Product Description</h3>
                <Row>
                  <Col md="4" xs="6">
                    <p className='font-weight-600' style={{fontSize:14}}>Upper Pattern</p>
                  </Col>
                  <Col>
                    <p className='text-dark font-weight-600' style={{fontSize:14}}>Solid</p>
                  </Col>
                </Row>
                <Row>
                  <Col md="4" xs="6">
                    <p className='font-weight-600' style={{fontSize:14}}>Type of item</p>
                  </Col>
                  <Col>
                    <p className='text-dark font-weight-600' style={{fontSize:14}}>Sandal</p>
                  </Col>
                </Row>
                <Row>
                  <Col md="4" xs="6">
                    <p className='font-weight-600' style={{fontSize:14}}>Color</p>
                  </Col>
                  <Col>
                    <p className='text-dark font-weight-600' style={{fontSize:14}}>Orange</p>
                  </Col>
                </Row>
                <Row>
                  <Col md="4" xs="6">
                    <p className='font-weight-600' style={{fontSize:14}}>Generic Name</p>
                  </Col>
                  <Col>
                    <p className='text-dark font-weight-600' style={{fontSize:14}}>Sandal</p>
                  </Col>
                </Row>
                <Row>
                  <Col md="4" xs="6">
                    <p className='font-weight-600' style={{fontSize:14}}>Country of Origin</p>
                  </Col>
                  <Col>
                    <p className='text-dark font-weight-600' style={{fontSize:14}}>India</p>
                  </Col>
                </Row>
              </div>
              <hr className="my-3 bg-secondary shadow"/>
              <div>
                <h3>Ratings & Reviews</h3>
                <div className='mt-4'>
                  <h4 className='text-dark font-weight-600'>
                    <span className='bg-success text-white py-1 px-2 mr-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                      4.5 <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                    </span>
                    Very good product one of my favorite purchase 😍❤️
                  </h4>
                  <p>Some rating description</p>
                  <p className='font-weight-500 mb-0' style={{fontSize:14}}><b className='mr-3 text-dark'>Abhishek Parmar</b>Jun, 2022</p>
                </div>
                <hr className="my-3 text-primary bg-primary shadow" />
                <div className='mt-4'>
                  <h4 className='text-dark font-weight-600'>
                    <span className='bg-success text-white py-1 px-2 mr-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                      4.5 <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                    </span>
                    Very good product one of my favorite purchase 😍❤️
                  </h4>
                  <p>Some rating description</p>
                  <p className='font-weight-500 mb-0' style={{fontSize:14}}><b className='mr-3 text-dark'>Anas Khan</b>July, 2022</p>
                </div>
                <hr className="my-3 text-primary bg-primary shadow" />
              </div>
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
      <div className='product-image' style={{backgroundImage: `url(${images[active]})`}}></div>
              
      <div className='overflow-x mb-2 no-sc'>
        <div style={{width: `${(78 * images.length) + 2}px`}}>
          {
            images && images.map((image, index) => 
              <div
                className={`small-product-image${index === active ? ' active' : ''}`}
                key={index}
                style={{backgroundImage: `url(${image})`}}
                onMouseEnter={() => change(index)}
              />
            )
          }
        </div>
      </div>
    </>
  );
}

function ActionButton(props){
  const [inCart, setInCart] = useState(props.inCart);

  const addToCart = () => {
    console.log(true);
  };

  return(
    <Row className='below-md-fixed'>
      <Col>
          <Button color='primary' type="button" className='btn-block' onClick={addToCart}>Add to Cart</Button>
      </Col>
      <Col>
          <Button color="warning" type="button" className='btn-block'>Buy Now</Button>
      </Col>
    </Row>
  )
}

export default Product;