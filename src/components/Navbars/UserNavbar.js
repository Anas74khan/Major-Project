import React, {useState} from "react";
import { Link } from "react-router-dom";
import classnames from "classnames";
// nodejs library to set properties for components
import PropTypes from "prop-types";
// reactstrap components
import {
  Collapse,
  DropdownMenu,
  DropdownItem,
  UncontrolledDropdown,
  DropdownToggle,
  FormGroup,
  Form,
  Input,
  InputGroupAddon,
  InputGroupText,
  InputGroup,
  ListGroupItem,
  ListGroup,
  Media,
  Navbar,
  NavItem,
  NavLink,
  Nav,
  Container,
  Row,
  Col,
  Modal,
  Card,
  CardBody,
  Button,
} from "reactstrap";

function UserNavbar({ theme, sidenavOpen, toggleSidenav }) {
  const [userLogin, setUserLogin] = useState(localStorage.getItem("login"));
  const [modalLogin, setLoginModal] = useState(false);
  const [modalLogout, setLogoutModal] = useState(false);
  

  const toggleLoginModal = () =>{
      setLoginModal(!modalLogin);
  }
  
  const toggleLogoutModal = () =>{
    setLogoutModal(!modalLogout);
  }

  const flipModal = () =>{
    setLoginModal(!modalLogin)
    setLogoutModal(!modalLogout)
  }

  const onLogin = () =>{
    localStorage.setItem("login", "true");
    setUserLogin("true")
    setLoginModal(!modalLogin)
  }

  const onLogout = () =>{
    localStorage.setItem("login", "false");
    setUserLogin("false")
  }
  // function that on mobile devices makes the search open
  const openSearch = () => {
    document.body.classList.add("g-navbar-search-showing");
    setTimeout(function () {
      document.body.classList.remove("g-navbar-search-showing");
      document.body.classList.add("g-navbar-search-show");
    }, 150);
    setTimeout(function () {
      document.body.classList.add("g-navbar-search-shown");
    }, 300);
  };
  // function that on mobile devices makes the search close
  const closeSearch = () => {
    document.body.classList.remove("g-navbar-search-shown");
    setTimeout(function () {
      document.body.classList.remove("g-navbar-search-show");
      document.body.classList.add("g-navbar-search-hiding");
    }, 150);
    setTimeout(function () {
      document.body.classList.remove("g-navbar-search-hiding");
      document.body.classList.add("g-navbar-search-hidden");
    }, 300);
    setTimeout(function () {
      document.body.classList.remove("g-navbar-search-hidden");
    }, 500);
  };

  const onLoginSuccess = () =>{
    return(
      <UncontrolledDropdown nav>
        <DropdownToggle className="nav-link pr-0 cursor-pointer" color="" tag="a">
          <Media className="align-items-center">
            <span className="avatar avatar-sm rounded-circle">
              <img
                alt="..."
                src={require("assets/img/theme/team-4.jpg").default}
              />
            </span>
            <Media className="ml-2 d-none d-lg-block">
              <span className="mb-0 text-sm font-weight-bold">
                John Snow
              </span>
            </Media>
          </Media>
        </DropdownToggle>
        <DropdownMenu className="dropdown-menu-arrow" right>
          <DropdownItem className="noti-title" header tag="div">
            <h6 className="text-overflow m-0">Welcome!</h6>
          </DropdownItem>
          <DropdownItem to="/admin/user-profile" tag={Link}>
            <i className="ni ni-single-02" />
            <span>Profile</span>
          </DropdownItem>
          <DropdownItem to="/admin/user-profile" tag={Link}>
            <i className="ni ni-settings-gear-65" />
            <span>My Order</span>
          </DropdownItem>
          <DropdownItem divider />
          <DropdownItem onClick={() => onLogout()}>
            <i className="ni ni-user-run" />
            <span>Logout</span>
          </DropdownItem>
        </DropdownMenu>
      </UncontrolledDropdown>
    )
  }

  return (
    <>
      <Navbar
        className="navbar-top navbar-expand border-bottom navbar-dark"
        style={{backgroundColor:'#43a1f6'}}
        sticky="top"
      >
        <Container fluid>
          <Collapse navbar isOpen={true}>

            <Nav className="align-items-center mr-md-auto" navbar>
              <NavItem className="d-xl-none">
                <div
                  className={classnames(
                    "pr-3 sidenav-toggler",
                    { active: sidenavOpen },
                    { "sidenav-toggler-dark": theme === "dark" }
                  )}
                  onClick={toggleSidenav}
                >
                  <div className="sidenav-toggler-inner">
                    <i className="sidenav-toggler-line" />
                    <i className="sidenav-toggler-line" />
                    <i className="sidenav-toggler-line" />
                  </div>
                </div>
              </NavItem>
              <NavItem>
                <div className="logo">Shopper</div>
              </NavItem>
            </Nav>

            <Form
              className={classnames(
                "navbar-search form-inline mr-sm-3",
                { "navbar-search-light": theme === "dark" },
                { "navbar-search-dark": theme === "light" }
              )}
            >
              <FormGroup className="mb-0">
                <InputGroup className="input-group-alternative input-group-merge">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="fas fa-search" style={{fontSize:20}}/>
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input placeholder="Search" type="text" />
                </InputGroup>
              </FormGroup>
              <button
                aria-label="Close"
                className="close"
                type="button"
                onClick={closeSearch}
              >
                <span aria-hidden={true}>×</span>
              </button>
            </Form>


            <Nav className="align-items-center ml-auto" navbar>
              <NavItem className="d-sm-none">
                <NavLink onClick={openSearch}>
                  <i className="ni ni-zoom-split-in" style={{fontSize:20}}/>
                </NavLink>
              </NavItem>
              <UncontrolledDropdown nav>
                <DropdownToggle className="nav-link cursor-pointer" tag="a">
                  <i className="ni ni-bell-55" style={{fontSize:20}}/>
                </DropdownToggle>
                <DropdownMenu
                  className="dropdown-menu-xl py-0 overflow-hidden"
                  right
                >
                  <div className="px-3 py-3">
                    <h6 className="text-sm text-muted m-0">
                      You have <strong className="text-info">13</strong>{" "}
                      notifications.
                    </h6>
                  </div>

                  <ListGroup flush>
                    <ListGroupItem
                      className="list-group-item-action"
                      href="#pablo"
                      onClick={(e) => e.preventDefault()}
                      tag="a"
                    >
                      <Row className="align-items-center">
                        <Col className="col-auto">
                          <img
                            alt="..."
                            className="avatar rounded-circle"
                            src={require("assets/img/theme/team-1.jpg").default}
                          />
                        </Col>
                        <div className="col ml--2">
                          <div className="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 className="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div className="text-right text-muted">
                              <small>2 hrs ago</small>
                            </div>
                          </div>
                          <p className="text-sm mb-0">
                            Let's meet at Starbucks at 11:30. Wdyt?
                          </p>
                        </div>
                      </Row>
                    </ListGroupItem>
                    <ListGroupItem
                      className="list-group-item-action"
                      href="#pablo"
                      onClick={(e) => e.preventDefault()}
                      tag="a"
                    >
                      <Row className="align-items-center">
                        <Col className="col-auto">
                          <img
                            alt="..."
                            className="avatar rounded-circle"
                            src={require("assets/img/theme/team-2.jpg").default}
                          />
                        </Col>
                        <div className="col ml--2">
                          <div className="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 className="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div className="text-right text-muted">
                              <small>3 hrs ago</small>
                            </div>
                          </div>
                          <p className="text-sm mb-0">
                            A new issue has been reported for Argon.
                          </p>
                        </div>
                      </Row>
                    </ListGroupItem>
                    <ListGroupItem
                      className="list-group-item-action"
                      href="#pablo"
                      onClick={(e) => e.preventDefault()}
                      tag="a"
                    >
                      <Row className="align-items-center">
                        <Col className="col-auto">
                          <img
                            alt="..."
                            className="avatar rounded-circle"
                            src={require("assets/img/theme/team-3.jpg").default}
                          />
                        </Col>
                        <div className="col ml--2">
                          <div className="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 className="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div className="text-right text-muted">
                              <small>5 hrs ago</small>
                            </div>
                          </div>
                          <p className="text-sm mb-0">
                            Your posts have been liked a lot.
                          </p>
                        </div>
                      </Row>
                    </ListGroupItem>
                    <ListGroupItem
                      className="list-group-item-action"
                      href="#pablo"
                      onClick={(e) => e.preventDefault()}
                      tag="a"
                    >
                      <Row className="align-items-center">
                        <Col className="col-auto">
                          <img
                            alt="..."
                            className="avatar rounded-circle"
                            src={require("assets/img/theme/team-4.jpg").default}
                          />
                        </Col>
                        <div className="col ml--2">
                          <div className="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 className="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div className="text-right text-muted">
                              <small>2 hrs ago</small>
                            </div>
                          </div>
                          <p className="text-sm mb-0">
                            Let's meet at Starbucks at 11:30. Wdyt?
                          </p>
                        </div>
                      </Row>
                    </ListGroupItem>
                    <ListGroupItem
                      className="list-group-item-action"
                      href="#pablo"
                      onClick={(e) => e.preventDefault()}
                      tag="a"
                    >
                      <Row className="align-items-center">
                        <Col className="col-auto">
                          <img
                            alt="..."
                            className="avatar rounded-circle"
                            src={require("assets/img/theme/team-5.jpg").default}
                          />
                        </Col>
                        <div className="col ml--2">
                          <div className="d-flex justify-content-between align-items-center">
                            <div>
                              <h4 className="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div className="text-right text-muted">
                              <small>3 hrs ago</small>
                            </div>
                          </div>
                          <p className="text-sm mb-0">
                            A new issue has been reported for Argon.
                          </p>
                        </div>
                      </Row>
                    </ListGroupItem>
                  </ListGroup>

                  <DropdownItem
                    className="text-center text-info font-weight-bold py-3"
                    href="#pablo"
                    onClick={(e) => e.preventDefault()}
                  >
                    View all
                  </DropdownItem>
                </DropdownMenu>
              </UncontrolledDropdown>
              <NavItem>
                <NavLink to={{pathname: '/cart'}} tag={Link}>
                  <i className="fas fa-cart-plus" style={{fontSize:20}}/>
                </NavLink>
              </NavItem>
              {
                userLogin === "true" ? onLoginSuccess()
                :
                <>
                  <NavItem>
                    <NavLink onClick={toggleLoginModal} className="cursor-pointer">
                      <span className="nav-link-inner--text">Login</span>
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink onClick={toggleLogoutModal} className="cursor-pointer">
                      <span className="nav-link-inner--text">Register</span>
                    </NavLink>
                  </NavItem>
                </>
              }
            </Nav>
          </Collapse>
        </Container>
      </Navbar>
      <Modal
          className="modal-dialog-centered"
          isOpen={modalLogin}
          toggle={() => toggleLoginModal()}
      >
        <Card className="shadowless mb-0 nav-bg">
          <CardBody >
            <div className="text-center text-white mb-6">
              <span>Sign in with credentials</span>
            </div>
            <Form role="form" className="px-3">
              <FormGroup className="mb-3">
                <InputGroup className="input-group-alternative">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="ni ni-email-83" />
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input
                    placeholder="Email"
                    type="email"
                    autoComplete="new-email"
                  />
                </InputGroup>
              </FormGroup>
              <FormGroup>
                <InputGroup className="input-group-alternative">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="ni ni-lock-circle-open" />
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input
                    placeholder="Password"
                    type="password"
                    autoComplete="new-password"
                  />
                </InputGroup>
              </FormGroup>
              <div className="text-center">
                <Button to="/admin/dashboard" tag={Link} className="my-4" color="white" type="button" outline onClick={onLogin}>
                  Log In
                </Button>
              </div>
            </Form>
            <Row className="mt-3">
              <Col xs="6">
                <a
                  className="text-light"
                  href="#pablo"
                  onClick={(e) => e.preventDefault()}
                >
                  <small>Forgot password?</small>
                </a>
              </Col>
              <Col className="text-right" xs="6">
                <a
                  className="text-light"
                  href="#pablo"
                  onClick={flipModal}
                >
                  <small>Create new account</small>
                </a>
              </Col>
            </Row>
          </CardBody>
        </Card>
      </Modal>
      <Modal
          className="modal-dialog-centered"
          isOpen={modalLogout}
          toggle={() => toggleLogoutModal()}
      >
        <Card className="shadowless mb-0 nav-bg">
          <CardBody >
            <div className="text-center text-white mb-6">
              <span>Sign up with credentials</span>
            </div>
            <Form role="form" className="px-3">
              <FormGroup>
                <InputGroup className="input-group-alternative mb-3">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="ni ni-hat-3" />
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input placeholder="Name" type="text" />
                </InputGroup>
              </FormGroup>
              <FormGroup>
                <InputGroup className="input-group-alternative mb-3">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="ni ni-email-83" />
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input
                    placeholder="Email"
                    type="email"
                    autoComplete="new-email"
                  />
                </InputGroup>
              </FormGroup>
              <FormGroup>
                <InputGroup className="input-group-alternative">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="ni ni-lock-circle-open" />
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input
                    placeholder="Password"
                    type="password"
                    autoComplete="new-password"
                  />
                </InputGroup>
              </FormGroup>
              <FormGroup>
                <InputGroup className="input-group-alternative">
                  <InputGroupAddon addonType="prepend">
                    <InputGroupText>
                      <i className="ni ni-lock-circle-open" />
                    </InputGroupText>
                  </InputGroupAddon>
                  <Input
                    placeholder="Confirm Password"
                    type="password"
                    autoComplete="new-password"
                  />
                </InputGroup>
              </FormGroup>
              <div className="text-center">
                <Button className="mt-4" color="white" outline type="button">
                  Create account
                </Button>
              </div>
            </Form>
            <Row className="mt-3">
              <Col className="text-center">
                <a
                  className="text-light"
                  href="#pablo"
                  onClick={flipModal}
                >
                  <small>Already have account ?</small>
                </a>
              </Col>
            </Row>
          </CardBody>
        </Card>
      </Modal>
    </>
  );
}

UserNavbar.defaultProps = {
  toggleSidenav: () => {},
  sidenavOpen: false,
  theme: "dark",
};
UserNavbar.propTypes = {
  toggleSidenav: PropTypes.func,
  sidenavOpen: PropTypes.bool,
  theme: PropTypes.oneOf(["dark", "light"]),
};

export default UserNavbar;
