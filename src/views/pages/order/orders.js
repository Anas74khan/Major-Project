import Loader from 'components/Loader';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { Card, CardBody, Col, Container, Row } from 'reactstrap';
import { api } from 'services/api';

export default function Orders() {
    const [response, setResponse] = useState({});

    useEffect(() => {
        api('orders',{},res => {
            if(!res.success) return alert("Some error occured! Try refreshing the page.");

            setResponse(res);
        });
    }, []);


    const Order = props => {
        const order = props.order;

        return (
            <>
                <Card outline tag={Link} to={'order/' + order.orderNo}>
                    <CardBody>
                        <Row>
                        <Col sm='2' className='text-center'>
                            <img 
                                src={order.image}
                                alt='error'
                                className='img-fluid'
                                style={{maxHeight: '100px',maxWidth: '100px'}}
                            />
                        </Col>
                        <Col sm='6'>
                            <div className='cart-product-title text-dark'>
                                <div>{order.productName}</div>
                            </div>
                            <div className='mb-3'>
                                <span className='cart-selling-price'>₹{order.offerEnable ? order.offerPrice : order.sellingPrice}</span>
                                <span className='cart-not-price'>{order.offerEnable ? `₹` + order.sellingPrice : ''}</span>
                                <span className='cart-offer'>{order.offerEnable ? `${((order.sellingPrice - order.offerPrice) / order.sellingPrice) * 100}% off` : ''}</span>
                            </div>
                        </Col>
                        <Col sm='4'>
                            <span className='card-delivery font-weight-600'>{order.status} on {order.actionDate}</span>
                        </Col>
                        </Row>
                    </CardBody>
                </Card>
            </>
        );
    };

    if(!response.success)
        return(
            <Loader />
        );

    if(response.orders.length === 0)
        return (
            <div style={{display: 'flex', justifyContent:'center', alignItems: 'center', width: '100%', height: '70vh'}}>
                You have not ordered anything yet.
            </div>
        );

    return (
        <Container className='my-4'>
            {
                response.orders.map((order, index) => <Order order={order} key={index} />)
            }
        </Container>
    )
}
