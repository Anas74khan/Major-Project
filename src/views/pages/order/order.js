import Loader from 'components/Loader';
import React, { useEffect, useState } from 'react';
import { Badge, Button, Card, CardBody, Col, Container, Row } from 'reactstrap';
import { api } from 'services/api';

export default function Order(props) {
    const orderNo = props.match.params.orderNo;
    const [response, setResponse] = useState({});

    useEffect(() => {
        api('order/' + orderNo, {}, res => {
            if(!res.success){
                if(res.code = 203) return window.location.replace(window.location.protocol + '//' + window.location.host + '/home');
                return alert("Some error occured! Try refreshing the page.");
            }

            setResponse(res);
        });
    }, []);

    const cancleOrder = () => {
        api('order/' + orderNo,{method: 'delete'}, res => {
            if(!res.success) return alert("Some error occured! Try again later.");
            window.location.reload();
        });
    };

    if(!response.success)
        return ( <Loader /> );

    return (
        <Container className='my-4'>
            <Row>
                <Col md="8">
                    <Card>
                        <CardBody>
                            <Row>
                                <Col sm='6' className='text-center'>
                                    <img 
                                        src={response.order.image}
                                        alt='error'
                                        className='img-fluid'
                                        style={{maxHeight: '90%',maxWidth: '90%'}}
                                    />
                                </Col>
                                <Col sm='6' style={{position: 'relative'}}>
                                    <div className='cart-product-title text-dark'>
                                        <div>{response.order.productName}</div>
                                    </div>
                                    <div className='mb-3'>
                                        <span className='cart-selling-price'>₹{response.order.offerEnable ? response.order.offerPrice : response.order.sellingPrice}</span>
                                        <span className='cart-not-price'>{response.order.offerEnable ? `₹` + response.order.sellingPrice : ''}</span>
                                        <span className='cart-offer'>{response.order.offerEnable ? `${((response.order.sellingPrice - response.order.offerPrice) / response.order.sellingPrice) * 100}% off` : ''}</span>
                                    </div>
                                    <div className='card-delivery font-weight-600'>{response.order.status} on {response.order.actionDate}</div>

                                    <div className='border-1-gray px-3 py-4 mt-5'>
                                        <p className='delivery-address-heading' style={{postion: 'relative'}}>
                                            Deliver to : <br />
                                            <span className='ml-2 font-weight-600'> {response.order.name} </span>
                                            <Badge
                                                color="secondary"
                                                style={{positon: 'absolute', top: '0', right: '0', marginLeft: '30px'}}>
                                                {response.order.type}
                                            </Badge>
                                        </p>
                                        <p className='delivery-address-detail mb-0'>Mobile number - {response.order.mobileNo}, <br />{response.order.address1},<br /> {response.order.city} - {response.order.pincode},<br /> {response.order.state}</p>
                                    </div>
                                </Col>
                            </Row>
                        </CardBody>
                    </Card>
                </Col>
                <Col md="4">
                    <Card className='sticky-0'>
                        <div className='price-detail-heading'>PRICE DETAILS</div>
                        <CardBody>
                            <div className='table-contents'>
                                <div className='table-content'>
                                    Price({response.order.quantity}) <span>₹{response.order.quantity * response.order.sellingPrice}</span>
                                </div>
                                <div className='table-content green'>
                                    Discount <span>-₹{response.order.offerEnable ? response.order.quantity * (response.order.sellingPrice - response.order.offerPrice) : 0}</span>
                                </div>
                                <div className='table-content green'>
                                    Delivery Charges <span>FREE</span>
                                </div>
                            </div>
                            <div className='mt-3'>
                                <div className='table-content total mb-4'>
                                    Total Amount <span>₹{response.order.quantity * (response.order.offerEnable ? response.order.offerPrice :response.order.sellingPrice)}</span>
                                </div>
                                {
                                    response.order.statusId === 1 ? <Button block outline color='danger' onClick={cancleOrder}>Cancel</Button> : ''
                                }
                            </div>
                        </CardBody>
                    </Card>
                </Col>
            </Row>
        </Container>
    )
}
