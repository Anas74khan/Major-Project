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
  CardHeader,
} from "reactstrap";
import { api, userDetails } from "services/api";
import Preloader from "components/Preloader";

function UserNavbar({ theme, sidenavOpen, toggleSidenav }) {
  const user = userDetails();

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
                      <i className="fas fa-search"/>
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
                  <i className="ni ni-zoom-split-in"/>
                </NavLink>
              </NavItem>
              { user ? <LoggedIn /> : <NotLoggedIn /> }
            </Nav>
          </Collapse>
        </Container>
      </Navbar>

    </>
  );
}

function LoggedIn(props){
  const logout = () => {
    window.localStorage.removeItem('authToken');
    window.localStorage.removeItem('user');
    window.location.reload();
  }

  return(
    <>
      <UncontrolledDropdown nav>
        <DropdownToggle className="nav-link cursor-pointer" tag="a">
          <i className="ni ni-bell-55"/>
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
              tag="a"
              onClick={e => e.preventDefault()}
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
      {
        window.location.pathname !== "/cart" ?
        <NavItem>
          <NavLink to={{pathname: '/cart'}} tag={Link}>
            <i className="fas fa-cart-plus"/>
          </NavLink>
        </NavItem> :
        ''
      }
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
                My Account
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
          <DropdownItem onClick={logout}>
            <i className="ni ni-user-run" />
            <span>Logout</span>
          </DropdownItem>
        </DropdownMenu>
      </UncontrolledDropdown>
    </>
  )
}

function NotLoggedIn(props){
  const [modalLogin, setLoginModal] = useState(false);
  const [modalLogout, setLogoutModal] = useState(false);
  

  const toggleLoginModal = () => setLoginModal(!modalLogin);
  const toggleLogoutModal = () => setLogoutModal(!modalLogout);
  const flipModal = () =>{
    setLoginModal(!modalLogin);
    setLogoutModal(!modalLogout);
  };

  return(
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
      
      <Modal
        className="modal-dialog-centered"
        isOpen={modalLogin}
        backdrop="static"
      >
        <LoginForm flipModal={flipModal} toggleLoginModal={toggleLoginModal}/>
      </Modal>

      <Modal
        className="modal-dialog-centered"
        isOpen={modalLogout}
        backdrop="static"
      >
        <RegisterForm flipModal={flipModal} toggleLogoutModal={toggleLogoutModal}/>
      </Modal>
    </>
  );
}

function LoginForm(props){
  const [username, setUsename] = useState("");
  const [password, setPassword] = useState("");

  const [preloader, setPreloader] = useState(false)

  const login = e => {
    e.preventDefault();
    setPreloader(true);

    api("login", {
        method: "POST",
        body: JSON.stringify({
          username: username,
          password: password
        })
      },
      response => {
        if(response.success){
          window.localStorage.setItem('authToken', response.access_token);
          return window.location.reload();
        }

        setPreloader(false);
        alert(response.text);
      }
    )
  };

  return(
    <>
      <Card outline className="mb-0 pb-0">
        <CardHeader className="text-center position-relative" tag="h2">
          Login
          <span className="modal-toggle" onClick={props.toggleLoginModal}>X</span>
        </CardHeader>
        <CardBody>
          <Form role="form" onSubmit={login}>
            <Row>
              <Col sm="12">
                <FormGroup>
                  <InputGroup>
                    <InputGroupAddon addonType="prepend">
                      <InputGroupText>
                        <i className="ni ni-single-02" />
                      </InputGroupText>
                    </InputGroupAddon>

                    <Input
                      name="username"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Username"
                      value={username}
                      onChange={e => setUsename(e.target.value)}
                    />
                  </InputGroup>
                </FormGroup>
              </Col>
              
              <Col sm="12">
                <FormGroup>
                  <InputGroup>
                    <InputGroupAddon addonType="prepend">
                      <InputGroupText>
                        <i className="ni ni-lock-circle-open" />
                      </InputGroupText>
                    </InputGroupAddon>

                    <Input
                      name="password"
                      type="password"
                      required
                      validate="true"
                      placeholder="Enter Password"
                      value={password}
                      onChange={e => setPassword(e.target.value)}
                    />
                  </InputGroup>
                </FormGroup>
              </Col>

              <Col sm="12">
                <FormGroup>
                  <Button
                    type="submit"
                    color="primary"
                    block
                  >
                    Login
                  </Button>
                </FormGroup>
              </Col>
            </Row>

            <div className="text-center small">
              Don't have an account? <span onClick={props.flipModal} className="text-primary cursor-pointer">Sign up</span>
            </div>
          </Form>
        </CardBody>
      </Card>
      { preloader ? <Preloader /> : ''}
    </>
  );
}

function RegisterForm(props){
  const [username, setUsename] = useState("");
  const [password, setPassword] = useState("");
  const [email, setEmail] = useState("");
  const [name, setName] = useState("");

  const [preloader, setPreloader] = useState(false)

  const register = e => {
    e.preventDefault();
    setPreloader(true);

    api("register", {
        method: "POST",
        body: JSON.stringify({
          name: name,
          email: email,
          username: username,
          password: password
        })
      },
      response => {
        if(response.success){
          window.localStorage.setItem('authToken', response.access_token);
          return window.location.reload();
        }

        setPreloader(false);
        alert(response.text);
      }
    )
  };

  return(
    <>
      <Card outline className="mb-0 pb-0">
        <CardHeader className="text-center position-relative" tag="h2">
          Register
          <span className="modal-toggle" onClick={props.toggleLogoutModal}>X</span>
        </CardHeader>
        <CardBody>
          <Form role="form" onSubmit={register}>
            <Row>
              <Col sm="12">
                <FormGroup>
                  <InputGroup>
                    <InputGroupAddon addonType="prepend">
                      <InputGroupText>
                        <i className="ni ni-hat-3" />
                      </InputGroupText>
                    </InputGroupAddon>

                    <Input
                      name="name"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Name"
                      value={name}
                      onChange={e => setName(e.target.value)}
                    />
                  </InputGroup>
                </FormGroup>
              </Col>
              
              <Col sm="12">
                <FormGroup>
                  <InputGroup>
                    <InputGroupAddon addonType="prepend">
                      <InputGroupText>
                        <i className="ni ni-email-83" />
                      </InputGroupText>
                    </InputGroupAddon>

                    <Input
                      name="email"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Email"
                      value={email}
                      onChange={e => setEmail(e.target.value)}
                    />
                  </InputGroup>
                </FormGroup>
              </Col>
              
              <Col sm="12">
                <FormGroup>
                  <InputGroup>
                    <InputGroupAddon addonType="prepend">
                      <InputGroupText>
                        <i className="ni ni-single-02" />
                      </InputGroupText>
                    </InputGroupAddon>

                    <Input
                      name="username"
                      type="text"
                      required
                      validate="true"
                      placeholder="Enter Username"
                      value={username}
                      onChange={e => setUsename(e.target.value)}
                    />
                  </InputGroup>
                </FormGroup>
              </Col>
              
              <Col sm="12">
                <FormGroup>
                  <InputGroup>
                    <InputGroupAddon addonType="prepend">
                      <InputGroupText>
                        <i className="ni ni-lock-circle-open" />
                      </InputGroupText>
                    </InputGroupAddon>

                    <Input
                      name="password"
                      type="password"
                      required
                      validate="true"
                      placeholder="Enter Password"
                      value={password}
                      onChange={e => setPassword(e.target.value)}
                    />
                  </InputGroup>
                </FormGroup>
              </Col>

              <Col sm="12">
                <FormGroup>
                  <Button
                    type="submit"
                    color="primary"
                    block
                  >
                    Sign Up
                  </Button>
                </FormGroup>
              </Col>
            </Row>

            <div className="text-center small">
              Already have an account? <span onClick={props.flipModal} className="text-primary cursor-pointer">Log in</span>
            </div>
          </Form>
        </CardBody>
      </Card>
      { preloader ? <Preloader /> : ''}
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
