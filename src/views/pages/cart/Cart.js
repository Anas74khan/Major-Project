import React, {useState} from 'react'
import { Link } from 'react-router-dom'
import { Row, Col, Card, CardBody, Container, Button, Badge, Modal } from 'reactstrap'

function Cart() {
    const [modal, setModal] = useState(false);

    const toggleModal = () =>{
        setModal(!modal);
    }

    return (
        <>
            <Container className='my-5' fluid>
                <Row>
                    <Col lg='8' md='8'>
                        <Card>
                            <CardBody>
                                <Row>
                                    <Col>
                                        <p className='delivery-address-heading'>
                                            Deliver to : 
                                            <span className='ml-2 font-weight-600'> Abhishek Parmar, 466331 </span>
                                            <Badge
                                                color="secondary" className='ml-2'>
                                                Home
                                            </Badge>
                                        </p>
                                        <p className='delivery-address-detail'>1 satrana, block-nasrullaganj, dist.-sehore, M.P.</p>
                                    </Col>
                                    <Col sm='auto'>
                                        <Button color='secondary' type='button' outline className='btn-large'>Change</Button>
                                    </Col>
                                </Row>

                                <hr className='my-1 mb-3'/>

                                <Row>
                                    <Col lg='2' md='2' className='text-center'>
                                        <img 
                                            src='https://rukminim1.flixcart.com/image/224/224/kuof5ow0/stuffed-toy/x/y/p/4-ft-soft-pink-color-teddy-bear-for-gift-to-someone-special-as-3-original-imag7qzenarxxwtj.jpeg'
                                            alt='error'
                                            className='img-fluid'
                                        />
                                    </Col>
                                    <Col lg='6' md='6'>
                                        <div className='cart-product-title'>
                                            <Link to={{pathname: '/product'}}>Ziraat 4 ft Soft Pink Color Teddy Bear For Gift To Someone Special AS 3  - 122 cm</Link>
                                        </div>
                                        <div className='mb-2'>
                                            <span className='cart-selling-price'>₹200</span>
                                            <span className='cart-not-price'>₹300</span>
                                            <span className='cart-offer'>10% off</span>
                                        </div>
                                        <Row>
                                            <Col xs='auto'>
                                                <button className='custom-button remove-btn' onClick={toggleModal}>Remove</button>
                                            </Col>
                                            <div className='counter-control'>
                                                <span>+</span>
                                                <input className='input-custom' type='number'/>
                                                <span>-</span>
                                            </div>
                                        </Row>
                                    </Col>
                                    <Col lg='4' md='4'>
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
            <Modal
                className="modal-dialog-centered"
                isOpen={modal}
                toggle={() => toggleModal()}
            >
                <div className="modal-header">
                    <h5 className="modal-title" id="exampleModalLabel">
                        Remove Item
                    </h5>
                    <button
                        aria-label="Close"
                        className="close"
                        data-dismiss="modal"
                        type="button"
                        onClick={() => toggleModal()}
                    >
                        <span aria-hidden={true}>×</span>
                    </button>
                </div>
                <div className="modal-body">
                    <p className='font-weight-500 text-muted'>Are you sure you want to remove this item?</p>
                </div>
                <div className="modal-footer">
                    <Button
                    color="secondary"
                    data-dismiss="modal"
                    type="button"
                    outline
                    onClick={() => toggleModal()}
                    >
                        Cancel
                    </Button>
                    <Button color="primary" type="button">
                        Remove
                    </Button>
                </div>
            </Modal>
        </>
    )
}

export default Cart