import React from "react";

import Logo from "../../assests/svg/logo/my_taxboard_edged.svg";
import DashBoard from "../../assests/svg/dashboard_base/dashboard_black.svg";
import TaxLearn from "../../assests/svg/dashboard_base/tax_learn_black.svg";
import TaxPlanner from "../../assests/svg/dashboard_base/tax_planner_black.svg";

import individual from "../../assests/assets_design/img/home/individual.png";
import illustration from "../../assests/assets_design/img/home/Illustration.png";

import { Link } from "react-router-dom";

import {
    NavLink,
    Button,
    Modal,
    Row,
    Col,
    NavbarBrand,
    UncontrolledCollapse,
    Navbar, 
  } from "reactstrap";

class NavBar extends React.Component{
    state = {
        defaultModal: false
    };
    toggleModal = state => {
        this.setState({
            [state]: !this.state[state]
        });
    };
    render(){
        const navColor = this.props.color&& window.innerWidth>1024 ? 'white' : 'black';
        console.log(window.innerWidth > 1024);
        return(
            <Navbar
                className="navbar-horizontal navbar-main navbar-dark p-0"
                expand="lg"
                id="navbar-main"
            >
                
                <NavbarBrand to="/" tag={Link}>
                    <img
                    alt="..."
                    src={Logo}
                    style={{width:200, height:100, marginTop:10}}
                    />
                </NavbarBrand>
                <button
                    aria-controls="navbar-collapse"
                    aria-expanded={false}
                    aria-label="Toggle navigation"
                    className="navbar-toggler mt-auto mb-3"
                    data-target="#navbar-collapse"
                    data-toggle="collapse"
                    id="navbar-collapse"
                    type="button"
                >
                    <i class="fas fa-bars" style={{color:'black'}}></i>
                </button>
                <UncontrolledCollapse
                    className="navbar-custom-collapse"
                    navbar
                    toggler="#navbar-collapse"
                >
                    <div className="navbar-collapse-header mb-0">
                        <Row>
                            <Col className="collapse-brand" xs="6">
                                <Link to="/admin/dashboard">
                                    <img
                                    alt="..."
                                    src={Logo}
                                    />
                                </Link>
                            </Col>
                            <Col className="collapse-close my-auto" xs="6">
                                <button
                                    aria-controls="navbar-collapse"
                                    aria-expanded={false}
                                    aria-label="Toggle navigation"
                                    className="navbar-toggler"
                                    data-target="#navbar-collapse"
                                    data-toggle="collapse"
                                    id="navbar-collapse"
                                    type="button"
                                >
                                    <span />
                                    <span />
                                </button>
                            </Col>
                        </Row>
                    </div>
                    <ul className="navbar-nav navbar-nav-hover align-items-lg-center" style={{marginTop: window.innerWidth>1024 ? 44 : 0}}>
                        <li className="nav-item dropdown mr-0" style={{position:'static'}}>
                            <NavLink to="/" tag={Link}>
                                <span className="nav-link-inner--text text-res font-weight-600"><span style={{color:'black', fontSize:window.innerWidth > 1024 ? 18 : 16}}>Products <i className="ni ni-bold-down ml-2 text-res" id="products_icon" style={{fontSize:16, color:'black'}}></i></span></span>
                            </NavLink>
                            <div className="dropdown-menu"  style={{width: '80%'}}> 
                                <div className="row card-body justify-content-center" >
                                    <div className="col-md-3 ">
                                        <div className="column ">
                                            <div className="row justify-content-center">
                                                <a href="/" className="link-primary h5 font-weight-bold"><img src={DashBoard} width="20" height="20" alt="enterprise"/><span className="h5 text-center">&nbsp;&nbsp;Dashboard</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="col-md-3">
                                        <div className="column ">
                                            <div className="row justify-content-center">
                                                <a href="/" className="link-primary h5 font-weight-bold text-center"><img src={DashBoard} width="20" height="20" alt="enterprise"/><span className="h5 text-center">&nbsp;&nbsp;Absolute Complice</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="col-md-3 ">
                                        <div className="column">
                                            <div className="row justify-content-center">
                                                <a href="/" className="link-primary h6 font-weight-bold text-center"><img src={TaxLearn}  width="20" height="20" alt="enterprise"/><span className="h5 text-center">&nbsp;&nbsp;Knowledge Center</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="col-md-3">
                                        <div className="column">
                                            <div className="row justify-content-center">
                                            <a href="/" className="link-primary h6  text-center"><img src={TaxPlanner} width="20" height="20" alt="enterprise"/><span className="h5 text-center">&nbsp;&nbsp;Tax Planner</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </li>
                        <li className="nav-item">
                            <NavLink to="/auth/service" tag={Link}>
                                <span className="nav-link-inner--text text-res font-weight-600"><span style={{color:'black', fontSize:window.innerWidth > 1024 ? 18 : 16}}>Services</span></span>
                            </NavLink>
                        </li>
                    </ul>
                    <ul className="navbar-nav navbar-nav-hover align-items-lg-center ml-auto" style={{marginTop: window.innerWidth>1024 ? 46 : 0, }}>
                        <li className="nav-item">
                            <NavLink to="/auth/about" tag={Link}>
                                <span className="nav-link-inner--text text-res font-weight-600"><span style={{color:navColor, fontSize:window.innerWidth > 1024 ? 18 : 16}}>About</span></span>
                            </NavLink>
                        </li>
                        <li className="nav-item">
                            <NavLink to="/auth/contact" tag={Link}>
                                <span className="nav-link-inner--text text-res font-weight-600"><span style={{color:navColor, fontSize:window.innerWidth > 1024 ? 18 : 16}}>Contact</span></span>
                            </NavLink>
                        </li>
                        <li className="nav-item mx-auto" style={{marginTop: window.innerWidth>1024 ? 0 : 46}}>
                            <button type="button" onClick={() => this.toggleModal("defaultModal")} className="btn btn-white text-info font-weight-600 p-2 mr-2" data-toggle="modal" data-target=".bd-example-modal-lg " style={{fontSize:16}}> 
                                <span class="text-res">LOG IN</span> 
                            </button>
                            <Modal
                                className="modal-dialog-centered modal-lg rounded"
                                isOpen={this.state.defaultModal}
                                toggle={() => this.toggleModal("defaultModal")}
                            >
                                <div className="modal-header">
                                    <h3 class="" id="exampleModalScrollableTitle"><b>Hi! What would you like to log into?</b></h3>
                                    <button
                                        aria-label="Close"
                                        className="close"
                                        data-dismiss="modal"
                                        type="button"
                                        onClick={() => this.toggleModal("defaultModal")}
                                    >
                                        <span aria-hidden={true} className="font-weight-600 text-dark" style={{fontSize:30}}>×</span>
                                    </button>
                                </div>
                                <div className="modal-body">
                                    <div class="row px-4 justify-content-center">
                                        <div class="col-md-5 p-5 w-100 h-100 text-center mt-3" style={{backgroundColor: 'rgba(224, 37, 73, 0.2)', borderRadius:15}}>
                                            <img class="" src={individual} alt="" />
                                            <div class="text-left">
                                                <h6 class="mt-4"> <b> For you </b> </h6>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> File ITR</small><br/>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> Get expert assistance</small>
                                            </div>
                                            
                                            <Button 
                                                color="primary"
                                                class="btn btn-primary col-md-12"
                                                to="/auth/login"
                                                tag={Link}
                                                style={{marginTop:20}}
                                            >
                                                LOGIN
                                            </Button>
                                        </div>
                                        <div className="col-md-1"></div>
                                        <div class="col-md-5 p-5 w-100 h-100 text-center my-3" style={{backgroundColor: 'rgba(224, 37, 73, 0.2)', borderRadius:15}}>
                                            <img class="" src={illustration} alt="" />
                                            <div class="text-left">
                                                <h6 class="mt-5"> <b> For your business </b> </h6>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> File ITR &amp; GST</small><br/>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> Get expert assistance</small>
                                            </div>
                                            
                                            <Button 
                                                color="primary"
                                                class="btn btn-primary col-md-12"
                                                to="/auth/login"
                                                tag={Link}
                                                style={{marginTop:20}}
                                            >
                                                LOGIN
                                            </Button>
                                        </div>
                                    </div>
                                </div>
                            </Modal>
                            <button type="button" onClick={() => this.toggleModal("notificationModal")} className="btn btn-white text-black font-weight-600 p-2 ml-2" data-toggle="modal" data-target="#signuu_model" style={{fontSize:16}}>
                                <span class="text-res">GET STARTED</span> 
                            </button>
                            <Modal
                                className="modal-dialog-centered modal-lg"
                                isOpen={this.state.notificationModal}
                                toggle={() => this.toggleModal("notificationModal")}
                            >
                                <div className="modal-header">
                                    <h3 class="" id="exampleModalScrollableTitle"><b>Hi! What would you like to Register?</b></h3>
                                    <button
                                        aria-label="Close"
                                        className="close"
                                        data-dismiss="modal"
                                        type="button"
                                        onClick={() => this.toggleModal("notificationModal")}
                                    >
                                        <span aria-hidden={true} className="font-weight-600 text-dark" style={{fontSize:30}}>×</span>
                                    </button>
                                </div>
                                <div className="modal-body">
                                    <div class="row px-4 justify-content-center">
                                        <div class="col-md-5 p-5 w-100 h-100 text-center my-3" style={{backgroundColor: 'rgba(224, 37, 73, 0.2)', borderRadius:15}}>
                                            <img class="" src={individual} alt="" />
                                            <div class="text-left">
                                                <h6 class="mt-4"> <b> For you </b> </h6>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> File ITR</small><br/>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> Get expert assistance</small>
                                            </div>
                                            
                                            <Button 
                                                color="primary"
                                                class="btn btn-primary col-md-12 mt-5"
                                                to="/auth/register"
                                                tag={Link}
                                                style={{marginTop:20}}
                                            >
                                                SIGNUP
                                            </Button>
                                            
                                        </div>
                                        <div className="col-md-1"></div>
                                        <div class="col-md-5 p-5 w-100 h-100 text-center my-3" style={{backgroundColor: 'rgba(224, 37, 73, 0.2)', borderRadius:15}}>
                                            <img class="" src={illustration} alt="" />
                                            <div class="text-left">
                                                <h6 class="mt-5"> <b> For your business </b> </h6>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> File ITR &amp; GST</small><br/>
                                                <small><i class="fa fa-check-circle mr-2" aria-hidden="true"></i> Get expert assistance</small>
                                            </div>
                                            
                                            <a href="/">
                                                <Button 
                                                    color="primary"
                                                    class="btn btn-primary col-md-12 mt-5"
                                                    to="/auth/register"
                                                    tag={Link}
                                                    style={{marginTop:20}}
                                                >
                                                    SIGNUP
                                                </Button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </Modal>
                        </li>
                    </ul>
                </UncontrolledCollapse>
            </Navbar>
        );
    }
}

export default NavBar;