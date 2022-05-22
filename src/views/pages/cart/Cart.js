import React, {useState} from 'react'
import { Link } from 'react-router-dom'
import { Row, Col, Card, CardBody, Container, Button, Badge } from 'reactstrap';

function CartConatiner() {

    const [cart, setCart] = useState([]);
    const updateQuantity = (index, quantity) => {
        // update cart['products']['index']['quantity']
        // update cart['total']
    };
    const removeCart = (index) => {
        // Remove cart['products']['index']
        // update cart['cart']
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
                                        <button type='button' outline className='custom-button change-address-btn'>Change</button>
                                    </Col>
                                </Row>

                                <Cart updateQuantity={(index, quantity) => updateQuantity(index, quantity)} remove={(index) => removeCart(index)} />

                            </CardBody>
                        </Card>
                    </Col>
                    <Col lg='4' md='4' className='position-relative'>
                        <Card className='sticky-0'>
                            <div className='price-detail-heading'>PRICE DETAILS</div>
                            <CardBody>
                                <div className='table-contents'>
                                    <div className='table-content'>
                                        Price(2) <span>₹3,498</span>
                                    </div>
                                    <div className='table-content green'>
                                        Discount <span>-₹2,931</span>
                                    </div>
                                    <div className='table-content green'>
                                        Delivery Charges <span>FREE</span>
                                    </div>
                                </div>
                                <div className='mt-3'>
                                    <div className='table-content total mb-3'>
                                        Total Amount <span>₹668</span>
                                    </div>
                                    <Button color='warning' className='btn-block'>Place Order</Button>
                                </div>
                            </CardBody>
                        </Card>
                    </Col>
                </Row>
            </Container>
        </>
    )
}

function Cart(props){
    
    const [count, setCount] = useState(1);

    const clamp = value => {
        value = value > 0 ? value : 1;
        value = value > 99 ? 99 : value;
        setCount(value);
    };


    return(
        <>
            <hr className='mt-1 mb-3'/>
            <Row className='py-2'>
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
                    <div className='mb-3'>
                        <span className='cart-selling-price'>₹200</span>
                        <span className='cart-not-price'>₹300</span>
                        <span className='cart-offer'>10% off</span>
                    </div>
                    <div className='d-flex align-items-center'>
                        <div className='counter-control'>
                            <span onClick={() => clamp(count - 1)}>-</span>
                            <input className='input-custom' type='text' disabled value={count} onChange={e => clamp(e.target.value)}/>
                            <span onClick={() => clamp(count + 1)}>+</span>
                        </div>
                        <button className='custom-button remove-btn ml-4'>Remove</button>
                    </div>
                </Col>
                <Col lg='4' md='4'>
                    <span className='card-delivery'>Delivery by Sat May 28 | <span className='text-success'>Free</span></span>
                </Col>
            </Row>
        </>
    )
}

export default CartConatiner;