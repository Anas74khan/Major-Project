import React from 'react'
import { Row, Col, Card, CardBody, Button } from 'reactstrap'

function ItemDetails() {
  return (
    <>
      <Card className='mt-5' style={{marginLeft:"5%", marginRight:"5%"}}>
        <CardBody>
          <Row>
            <Col md="4" className='text-center mb-3'>
              <div>
                <img 
                  src={"https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/z/3/z/9-ha6056-kraasa-grey-original-imag7cnwczdu57hg.jpeg"} 
                  alt="cart" 
                  height={350}
                  className="my-5"
                />
                <Row>
                    <Col>
                        <Button type="button" style={{width:"100%", backgroundColor:'#43a1f6', color:'white'}}>Add TO Cart</Button>
                    </Col>
                    <Col>
                        <Button type="button" style={{width:"100%", backgroundColor:'#43a1f6', color:'white'}}>Buy Now</Button>
                    </Col>
                </Row>
              </div>
            </Col>
            <Col md="8">
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
                <h4>Coupons for you</h4>
                <p className='font-weight-500' style={{fontSize:14}}><i class="fas fa-tag text-success mr-2"></i><b className='font-weight-600' style={{fontSize:14}}>Special Price </b>Get extra 20% off upto ₹50 on 1 item(s)</p>
              </div>
              <div>
                <h4>Available Offers</h4>
                <p className='font-weight-500' style={{fontSize:14}}><i class="fas fa-tag text-success mr-2"></i><b className='font-weight-600' style={{fontSize:14}}>Special Price </b>Get at flat ₹299</p>
                <p className='font-weight-500' style={{fontSize:14}}><i class="fas fa-tag text-success mr-2"></i><b className='font-weight-600' style={{fontSize:14}}>Combo Offer </b>Buy 2 items save 5%;Buy 3 or more save 10%</p>
                <p className='font-weight-500' style={{fontSize:14}}><i class="fas fa-tag text-success mr-2"></i><b className='font-weight-600' style={{fontSize:14}}>Bank Offer </b>5% Cashback on Flipkart Axis Bank Card</p>
                <p className='font-weight-500' style={{fontSize:14}}><i class="fas fa-tag text-success mr-2"></i><b className='font-weight-600' style={{fontSize:14}}>Partner Offer </b>Sign up for Flipkart Pay Later and get Flipkart Gift Card worth ₹100*</p>
              </div>
              <div>
                <h3>Product Details</h3>
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
              <hr className="my-3 text-primary bg-primary shadow" />
              <div>
                <h3>Ratings & Reviews</h3>
                <div className='mt-4'>
                  <h4 className='text-dark font-weight-600'>
                    <span className='bg-success text-white py-1 px-2 mr-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                      4.5 <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                    </span>
                    Very good product one of my favorite purchase 😍❤️
                  </h4>
                  <img 
                    src="https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/u/v/q/9-ha6056-kraasa-grey-original-imag7cnwpjuyanmk.jpeg" 
                    alt="error" 
                    height={50} 
                    width={50}
                    className="my-2"
                  />
                  <p className='font-weight-500 mb-0' style={{fontSize:14}}><b className='mr-3 text-dark'>Abhishek Parmar</b>Jun, 2022</p>
                  <p className='font-weight-500' style={{fontSize:14}}><i className='fas fa-check-circle'></i> Certified Buyer, Makronia Buzurg</p>
                </div>
                <hr className="my-3 text-primary bg-primary shadow" />
                <div className='mt-4'>
                  <h4 className='text-dark font-weight-600'>
                    <span className='bg-success text-white py-1 px-2 mr-2 font-weight-bold' style={{borderRadius:20, fontSize:14}}>
                      4.5 <i className="fa fa-star text-white" aria-hidden="true" style={{fontSize:13}}></i>
                    </span>
                    Very good product one of my favorite purchase 😍❤️
                  </h4>
                  <img 
                    src="https://rukminim1.flixcart.com/image/832/832/ku5ufm80/sandal/k/f/f/9-ha6056-kraasa-grey-original-imag7cnw9geapayy.jpeg" 
                    alt="error" 
                    height={50} 
                    width={50}
                    className="my-2"
                  />
                  <p className='font-weight-500 mb-0' style={{fontSize:14}}><b className='mr-3 text-dark'>Anas Khan</b>July, 2022</p>
                  <p className='font-weight-500' style={{fontSize:14}}><i className='fas fa-check-circle'></i> Certified Buyer, Makronia Buzurg</p>
                </div>
                <hr className="my-3 text-primary bg-primary shadow" />
              </div>
            </Col>
          </Row>
        </CardBody>
      </Card>
    </>
  )
}

export default ItemDetails