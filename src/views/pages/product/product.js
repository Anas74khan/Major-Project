import ProductContainer from 'components/Home/ProductContainer'
import React from 'react'
import { Link } from 'react-router-dom'
import { Row, Col, Card, CardBody, Button, Container } from 'reactstrap'

function Product(props){
  return (
    <>
      
      <Card style={{boxShadow: "unset", borderRadius: "0"}}>
        <CardBody className='product'>
          <Row>

            <Col lg="5" md="6" className='product-left-container'>
              <ProductImage />

              <Row className='below-md-fixed'>
                  <Col>
                      <Button color='primary' type="button" className='w-100' to="/cart" tag={Link}>Add to Cart</Button>
                  </Col>
                  <Col>
                      <Button color="warning" type="button" className='w-100'>Buy Now</Button>
                  </Col>
              </Row>
            </Col>

            <Col lg="7" md="6">
              <small className='font-weight-600'>Brand</small>
              <h3>The Lean Startup: How Constant Innovation Creates Radically Successful Businesses Paperback</h3>
              <p className='text-success font-weight-600'>Special Offers</p>
              <h1>
                ₹ 296 
                <span 
                  className='font-weight-400 mx-2' 
                  style={{textDecoration: 'line-through', color:'#808080', fontSize:18}}
                >
                  ₹396
                </span>
                <span className='text-success font-weight-400' style={{fontSize:18}}>20% off</span>
              </h1>
              <p>
                <span className='bg-success text-white py-1 px-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                  3.5 <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                </span>
                <span className='ml-2' style={{color:'#808080', fontSize:16, fontWeight:500}}>370 ratings and 32 reviews</span>
              </p>
              <div>
                <p className='font-weight-500' style={{fontSize:14}}><i class="fas fa-tag text-success mr-2"></i><span>Free Delivery</span> within 3 days</p>
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

      <ProductContainer url="products/all/all/all/0/6" title="Similar Product" subtitle="You may like" />
    </>
  )
}

function ProductImage(props){

  return (
    <>
      <div className='product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
              
      <div className='overflow-x mb-2 no-sc'>
        <div style={{width: `${(78 * 9) + 2}px`}}>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
          <div className='small-product-image active' style={{backgroundImage: "url(https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg)"}}></div>
        </div>
      </div>
    </>
  );
}

export default Product;