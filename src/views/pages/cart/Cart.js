import { formatDate } from '@fullcalendar/core';
import Loader from 'components/Loader';
import Preloader from 'components/Preloader';
import { func } from 'prop-types';
import React, {useEffect, useState} from 'react'
import { Link } from 'react-router-dom'
import { Row, Col, Card, CardBody, Container, Button, Badge, FormGroup, CardHeader, Form, Input, Modal } from 'reactstrap';
import { api } from 'services/api';

function CartConatiner() {

    const [cart, setCart] = useState({});
    useEffect(() => {
        api('cart',{}, response => {
            if(!response.success) return alert("Some error occured! try refreshing the page.");
            setCart(response);
        });
    }, []);
    const updateQuantity = (index, quantity) => {
        api('cart',{
            method: 'post',
            body: JSON.stringify({
                    '_method': 'put',
                    'id': cart.carts[index].id,
                    'quantity': quantity
                })
            },
            response => {
                if(!response.success) return alert("Unable to update quantity! Try again later.");

                let temp = JSON.parse(JSON.stringify(cart));
                temp.carts[index].quantity = quantity;
                setCart(temp);
            }
        )
    };
    const removeCart = index => {
        api('cart/' + cart.carts[index].id,{
                method: 'delete'
            },
            response => {
                if(!response.success) return alert("Unable to remove product! Try again later.");

                let temp = JSON.parse(JSON.stringify(cart));
                temp.carts.filter((value, i) => i !== index);
                setCart(temp);
            }
        )
    }
    function changeAddress(address){
        let temp = JSON.parse(JSON.stringify(cart));
        let found = false;
        for(let i = 0; i < temp.addresses.length; i++){
            if(temp.addresses[i].id === address.id){
                temp.addresses[i] = address;
                found = true;
            }
            else temp.addresses[i].inUse = 0;
        }
        if(!found)
            temp.addresses.push(address);
        setCart(temp);
    };

    if(!cart.success)
        return (
            <Loader />
        );
    
    if(cart.carts.length === 0)
        return (
            <div style={{height: "60vh", width: "100%", display: 'flex', justifyContent: 'center', alignItems: 'center'}}>
                No product in cart.
            </div>
        );

    return (
        <>
            <Container className='my-5' fluid>
                <Row>
                    <Col lg='8' md='8'>
                        <Card>
                            <CardBody>
                                <AddressContainer addresses={cart.addresses} changeAddress={changeAddress}/>

                                {
                                    cart.carts.map((cart, index) => 
                                        <Cart
                                            updateQuantity={updateQuantity}
                                            cart={cart}
                                            key={index}
                                            remove={removeCart}
                                            index={index}
                                        />
                                    )
                                }

                            </CardBody>
                        </Card>
                    </Col>
                    <Col lg='4' md='4' className='position-relative'>
                        <PriceDetails carts={cart.carts} addresses={cart.addresses} />
                    </Col>
                </Row>
            </Container>
        </>
    )
}

function Cart(props){
    
    const cart = props.cart;
    const [count, setCount] = useState(cart.quantity);

    let today = new Date();

    const clamp = value => {
        value = value > 0 ? value : 1;
        value = value > 99 ? 99 : value;
        setCount(value);
        props.updateQuantity(props.index,value);
    };

    const dateFormat = d => {
        let day = d.getDate();
        if(day < 10) day = "0" + day;

        let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        let month = months[d.getMonth() - 1];

        return day + " " + month + " " + d.getFullYear();
    }


    return(
        <>
            <hr className='mt-1 mb-3'/>
            <Row className='py-2'>
                <Col sm='2' className='text-center'>
                    <img 
                        src={cart.image}
                        alt='error'
                        className='img-fluid'
                        style={{maxHeight: '100px',maxWidth: '100px'}}
                    />
                </Col>
                <Col sm='6'>
                    <div className='cart-product-title'>
                        <Link to={{pathname: `/product/${cart.productId}`}}>{cart.productName} | {cart.varietyName}</Link>
                    </div>
                    <div className='mb-3'>
                        <span className='cart-selling-price'>₹{cart.offerEnable ? cart.offerPrice : cart.sellingPrice}</span>
                        <span className='cart-not-price'>{cart.offerEnable ? `₹` + cart.sellingPrice : ''}</span>
                        <span className='cart-offer'>{cart.offerEnable ? `${cart.offerPercentage}% off` : ''}</span>
                    </div>
                    <div className='d-flex align-items-center'>
                        <div className='counter-control'>
                            <span onClick={() => clamp(count - 1)}>-</span>
                            <input className='input-custom' type='text' disabled value={count} onChange={e => clamp(e.target.value)}/>
                            <span onClick={() => clamp(count + 1)}>+</span>
                        </div>
                        <button className='custom-button remove-btn ml-4' onClick={() => props.remove(props.index)}>Remove</button>
                    </div>
                </Col>
                <Col sm='4'>
                    <span className='card-delivery'>Delivery by - <span className='font-weight-600'> {dateFormat(today)}</span> | <span className='text-success'>Free</span></span>
                </Col>
            </Row>
        </>
    )
}

function PriceDetails(props){
    let total = 0;
    let amount = 0;
    let offer = 0;
    let quantity = 0;
    for(let i = 0; i < props.carts.length; i++){
        const cart = props.carts[i];
        quantity += cart.quantity;
        if(cart.offerEnable){
            amount += (cart.offerPrice * cart.quantity);
            offer += ((cart.sellingPrice - cart.offerPrice) * cart.quantity);
        }
        else amount += (cart.sellingPrice * cart.quantity);
        total += (cart.sellingPrice * cart.quantity);
    }

    const placeOrder = () => {
        if(props.addresses.length === 0) return alert("Add address first.");

        let body = {};
        for(let i = 0; i < props.addresses.length; i++){
            if(props.addresses[i].inUse === 1){
                body = {...props.addresses[i]};
                break;
            }
        }

        api('order/cart',{method: 'POST', body: JSON.stringify(body)}, response => {
            if(!response.success) return alert('Some error occured! try refreshing the page.');

            let to = 'orders';
            if(response.orders.length === 1) to = '/order/' + response.orders[0].orderNo;
            window.location.href = window.location.protocol + '//' + window.location.host + to;
        });
    }

    return (
        <Card className='sticky-0'>
            <div className='price-detail-heading'>PRICE DETAILS</div>
            <CardBody>
                <div className='table-contents'>
                    <div className='table-content'>
                        Price({quantity}) <span>₹{total}</span>
                    </div>
                    <div className='table-content green'>
                        Discount <span>-₹{offer}</span>
                    </div>
                    <div className='table-content green'>
                        Delivery Charges <span>FREE</span>
                    </div>
                </div>
                <div className='mt-3'>
                    <div className='table-content total mb-3'>
                        Total Amount <span>₹{amount}</span>
                    </div>
                    <Button color='warning' className='btn-block' onClick={placeOrder}>Place Order</Button>
                </div>
            </CardBody>
        </Card>
    );
}

function AddressContainer(props){
    const addresses = props.addresses;
    const [active, setActive] = useState({});
    const [modalAddress, setModalAddress] = useState(false);
    const toggleAddressModal = () => setModalAddress(!modalAddress);

    useEffect(() => {
        for(let i = 0; i < addresses.length; i++){
            if(addresses[i].inUse){
                setActive(addresses[i]);
                break;
            }
        }
    }, []);

    const changeAddress = address => {
        setActive(address);
        toggleAddressModal();
        props.changeAddress(address);
    };

    return (
        <Row>
            <Col>
                {
                    addresses.length > 0 ?
                        <>
                            <p className='delivery-address-heading'>
                                Deliver to : 
                                <span className='ml-2 font-weight-600'> {active.name}, {active.pincode} </span>
                                <Badge
                                    color="secondary" className='ml-2'>
                                    {active.type}
                                </Badge>
                            </p>
                            <p className='delivery-address-detail'>{active.address1}, {active.city}, {active.state}</p>
                        </>:
                        <p className='delivery-address-detail font-weight-400'> No address added.</p>
                }
            </Col>
            <Col sm='auto'>
                <button
                    type='button'
                    className='custom-button change-address-btn'
                    onClick={toggleAddressModal}
                >{addresses.length > 0 ? 'Change' : 'Add'}</button>
            </Col>
            <Modal
                className="modal-dialog-centered"
                isOpen={modalAddress}
                backdrop="static"
            >
                <AddressForm changeAddress={changeAddress} address={active} toggleModal={toggleAddressModal}/>
            </Modal>
        </Row>
    );
}

function AddressForm(props){
    const address = props.address;
    const [name, setName] = useState(address.name ? address.name : '');
    const [mobile, setMobile] = useState(address.mobileNo ? address.mobileNo : '');
    const [pincode, setPincode] = useState(address.pincode ? address.pincode : '');
    const [city, setCity] = useState(address.city ? address.city : '');
    const [state, setState] = useState(address.state ? address.state : '');
    const [type, setType] = useState(address.type ? address.type : 'Home');
    const [address1, setAddress1] = useState(address.address1 ? address.address1 : '');
    const [preloader, setPreloader] = useState(false);

    const saveAddress = e => {
        e.preventDefault();
        setPreloader(true);

        let body = {
            id: address.id,
            name: name,
            mobileNo: mobile,
            pincode: pincode,
            city: city,
            state: state,
            type: type,
            address1: address1
        };
        if(address.id) body['_method'] = "PUT";
        api('address', {
                method: 'POST',
                body: JSON.stringify(body)
            },
            response => {
                if(!response.success) return alert("Some error occured! try refreshing the page.");
                setPreloader(false);
                
                props.changeAddress(response.address);
            }
        )
    };

    return (
        <>
      <Card outline className="mb-0 pb-0">
        <CardHeader className="text-center position-relative" tag="h2">
          Address
          <span className="modal-toggle" onClick={props.toggleModal}>X</span>
        </CardHeader>
        <CardBody>
          <Form role="form" onSubmit={saveAddress}>
            <Row>
              <Col sm="6">
                <FormGroup>
                    <Input
                      name="name"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Name"
                      value={name}
                      onChange={e => setName(e.target.value)}
                    />
                </FormGroup>
              </Col>
              
              <Col sm="6">
                <FormGroup>
                    <Input
                      name="mobileNo"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Mobile Number"
                      value={mobile}
                      onChange={e => setMobile(e.target.value)}
                    />
                </FormGroup>
              </Col>
              
              <Col sm="12">
                <FormGroup>
                    <Input
                      name="address1"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Address"
                      value={address1}
                      onChange={e => setAddress1(e.target.value)}
                    />
                </FormGroup>
              </Col>

              <Col sm="6">
                  <FormGroup>
                        <select
                            name="type"
                            value={type}
                            className="form-control"
                            onChange={e => setType(e.target.value)}
                        >
                            <option value="Home" >Home</option>
                            <option value="Office" >Office</option>
                        </select>
                  </FormGroup>
              </Col>
              
              <Col sm="6">
                <FormGroup>
                    <Input
                      name="pincode"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Pincode"
                      value={pincode}
                      onChange={e => setPincode(e.target.value)}
                    />
                </FormGroup>
              </Col>
              
              <Col sm="6">
                <FormGroup>
                    <Input
                      name="city"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter City"
                      value={city}
                      onChange={e => setCity(e.target.value)}
                    />
                </FormGroup>
              </Col>
              
              <Col sm="6">
                <FormGroup>
                    <Input
                      name="state"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter State"
                      value={state}
                      onChange={e => setState(e.target.value)}
                    />
                </FormGroup>
              </Col>

              <Col sm="12">
                <FormGroup>
                  <Button
                    type="submit"
                    color="primary"
                    block
                  >
                    Save
                  </Button>
                </FormGroup>
              </Col>
            </Row>

          </Form>
        </CardBody>
      </Card>
      { preloader ? <Preloader /> : ''}
    </>
    );
}

export default CartConatiner;