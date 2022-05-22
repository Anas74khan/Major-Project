import React from 'react'
import { Row, Col, Card, CardBody, Container, Button, Badge } from 'reactstrap'

function Cart() {
  return (
    <Container className='mt-5'>
        <Row>
            <Col lg='8' md='8'>
                <Card>
                    <CardBody>
                        <Row>
                            <Col>
                                <p className='text-dark font-weight-500 mb-0'>
                                    Deliver to : 
                                    <span className='text-dark font-weight-bold'> Abhishek Parmar, 466331 
                                        <Badge
                                            color="primary"
                                            href="#pablo"
                                            onClick={e => e.preventDefault()}
                                        >
                                            Primary
                                        </Badge>
                                    </span>
                                </p>
                                <p className='font-weight-500'>1 satrana, block-nasrullaganj, dist.-sehore, M.P.</p>
                            </Col>
                            <Col sm='auto'>
                                <Button color='primary' type='button' outline>Change</Button>
                            </Col>
                        </Row>
                        <hr className='my-1 mb-3'/>
                        <Row>
                            <Col lg='3' md='3' className='text-center'>
                                <img 
                                    src='https://rukminim1.flixcart.com/image/224/224/kuof5ow0/stuffed-toy/x/y/p/4-ft-soft-pink-color-teddy-bear-for-gift-to-someone-special-as-3-original-imag7qzenarxxwtj.jpeg'
                                    alt='error'
                                    className='img-fluid'
                                />
                            </Col>
                            <Col lg='6' md='6'>
                                <span className='card-title'>Ziraat 4 ft Soft Pink Color Teddy Bear For Gift To Someone Special AS 3  - 122 cm</span>
                                <div>
                                    <h2>
                                        ₹ 296 
                                        <span 
                                        className='font-weight-400 mx-2' 
                                        style={{textDecoration: 'line-through', color:'#808080', fontSize:15}}
                                        >
                                        ₹396
                                        </span>
                                        <span className='text-success font-weight-600' style={{fontSize:15}}>20% off</span>
                                    </h2>
                                </div>
                                <Row>
                                    <Col xs='auto'>
                                        <Button color='danger' type='button' >Remove</Button>
                                    </Col>
                                    <div>
                                        <Button className='px-2 py-1 mr-0 btn-round' color="primary" type='button' outline>+</Button>
                                        <input className='input-custom' type='text' placeholder='1'/>
                                        <Button className='px-2 py-1 btn-round' color="primary" type='button' outline>-</Button>
                                    </div>
                                </Row>
                            </Col>
                            <Col lg='3' md='3'>
                                <span className='card-delivery'>Delivery by Sat May 28 | <span className='text-success'>Free</span></span>
                            </Col>
                        </Row>
                    </CardBody>
                </Card>
            </Col>
            <Col lg='4' md='4'>
                <Card>
                    <CardBody>
                        <h3 className='text-muted mb-4'>PRICE DETAILS</h3>
                        <Row>
                            <Col>
                                <p className='text-dark font-weight-500'>Price (2 items)</p>
                            </Col>
                            <Col xs="auto">
                                <p className='text-dark font-weight-500'>₹3,498</p>
                            </Col>
                        </Row>
                        <Row>
                            <Col>
                                <p className='text-dark font-weight-500'>Discount</p>
                            </Col>
                            <Col xs="auto">
                                <p className='text-success font-weight-500'>− ₹2,931</p>
                            </Col>
                        </Row>
                        <Row>
                            <Col>
                                <p className='text-dark font-weight-500'>Delivery Charges</p>
                            </Col>
                            <Col xs="auto">
                                <p className='text-dark font-weight-500'>₹51</p>
                            </Col>
                        </Row>
                        <hr className='my-2'/>
                        <Row>
                            <Col>
                                <h3 className='text-dark font-weight-600'>Total Amount</h3>
                            </Col>
                            <Col xs="auto">
                                <h3 className='text-dark font-weight-600'>₹618</h3>
                            </Col>
                        </Row>
                        <hr className='my-2'/>
                        <Row>
                            <Col>
                                <Button color='primary' type='button' className='btn-block'>Place Order</Button>
                            </Col>
                        </Row>
                    </CardBody>
                </Card>
            </Col>
        </Row>
    </Container>
  )
}

export default Cart