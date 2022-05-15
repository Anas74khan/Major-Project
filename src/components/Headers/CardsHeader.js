import PropTypes from "prop-types";
import { Link } from "react-router-dom";
// reactstrap components
import {
  Breadcrumb,
  BreadcrumbItem,
  Badge,
  Card,
  CardBody,
  CardTitle,
  Container,
  Row,
  Col,
  Nav,
  NavLink,
} from "reactstrap";
import DashCard from "components/Dashboard/DashboardCard";
import Select from "react-select";

const options = [
  { value: 'chocolate', label: 'Chocolate' },
  { value: 'strawberry', label: 'Strawberry' },
  { value: 'vanilla', label: 'Vanilla' }
]

function CardsHeader({ name, parentName }) {
  return (
    <>
      <div className="header pb-7">
        <Container fluid>
          <div className="header-body">
            <Row className="align-items-center py-3">
              <Col lg="9" xs="7">
                <h6 className="h3 text-dark d-inline-block mb-0">{name}</h6>{" "}
                <Breadcrumb
                  className="d-none d-md-inline-block ml-md-4"
                  listClassName="breadcrumb-links breadcrumb-dark"
                >
                  <BreadcrumbItem>
                    <a href="#pablo" onClick={(e) => e.preventDefault()}>
                      <i className="fas fa-home text-dark" />
                    </a>
                  </BreadcrumbItem>
                  <p className="text-dark px-1">/</p>
                  <BreadcrumbItem>
                    <a href="#pablo" onClick={(e) => e.preventDefault()} className="text-dark">
                      {parentName}
                    </a>
                  </BreadcrumbItem>
                  <p className="text-dark px-1">/</p>
                  <BreadcrumbItem aria-current="page" className="active text-dark">
                    {name}
                  </BreadcrumbItem>
                </Breadcrumb>
              </Col>
              <Col lg="3" xs="5" className="">
                <Badge color="info" className="badge-lg float-right" style={{fontSize:14, color: 'white', backgroundColor: '#43a1f6'}}>Super User</Badge>
              </Col>
            </Row>
            
            <Card className="mb-4">
              <CardBody>
                <Row>
                  <Col md="4">
                    <Row className="middle" >
                      <div className="" style={{width: '25%'}}>
                        <span className="d-none d-md-block h5 mb-0">NAME :</span>
                        <span className="d-md-none h5">NAME</span>
                      </div>
                      <div style={{width: '75%'}}>
                        <span style={{fontSize:20, color:'black'}}>AYUSH TIWARI</span>
                      </div>
                    </Row>
                  </Col>
                  <Col md="1" className="pt-3"></Col>
                  <Col md="3">
                    <Row className="middle" >
                      <div className="" style={{width: '25%'}}>
                      <span className="d-none d-md-block h5 mb-0">PAN :</span>
                        <span className="d-md-none h5">PAN</span>
                      </div>
                      <div style={{width: '60%'}}>
                        <Select 
                          options={options}  
                          styles={{
                            control: (provided, state) => ({
                              ...provided,
                              boxShadow: "none",
                              border: "1px solid black",
                            }),
                            option: (provided, state) => ({
                              ...provided,
                              backgroundColor: state.isFocused && "#43a1f6",
                              color: state.isFocused && "white"
                            })
                          }}
                        />  
                      </div>
                      <div className="middle" style={{width:'15%'}}>
                        <NavLink to="/auth/add" tag={Link}>
                          <i class="fas fa-user-plus" style={{fontSize:20}}></i>
                        </NavLink>
                      </div>
                    </Row>
                  </Col>
                  <Col md="1" className="pt-3"></Col>
                  <Col md="3">
                  <Row className="middle" >
                      <div className="" style={{width: '25%'}}>
                        <span className="d-none d-md-block h5 mb-0">AY :</span>
                        <span className="d-md-none h5">AY</span>
                      </div>
                      <div style={{width: '60%'}}>
                        <Select 
                          options={options}  
                          styles={{
                            control: (provided, state) => ({
                              ...provided,
                              boxShadow: "none",
                              border: "1px solid black",
                            }),
                            option: (provided, state) => ({
                              ...provided,
                              backgroundColor: state.isFocused && "#43a1f6",
                              color: state.isFocused && "white"
                            })
                          }}
                        />  
                      </div>
                      <div className="middle" style={{width:'15%'}}>
                        <NavLink to="/admin/addfile" tag={Link}>
                          <i class="ni ni-fat-add" style={{fontSize:30}}></i>
                        </NavLink>
                      </div>
                    </Row>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          
            <Row>
              <DashCard title={"TAx PAYABLE"} value={"9,773"} percent={100} arrow={true}/>
              <DashCard title={"TDS"} value={"14,000"} percent={5.07} arrow={true}/>
              <DashCard title={"DEDUCTION"} value={"5,275"} percent={8.98} arrow={false}/>
              <DashCard title={"TCS"} value={"3,498"} percent={5.68} arrow={true}/>

              {/* <Col md="6" xl="3">
                <Card className="card-stats">
                  <CardBody>
                    <Row>
                      <div className="col">
                        <CardTitle
                          tag="h5"
                          className="text-uppercase text-muted mb-0"
                        >
                          New users
                        </CardTitle>
                        <span className="h2 font-weight-bold mb-0">2,356</span>
                      </div>
                      <Col className="col-auto">
                        <div className="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                          <i className="fa fa-arrow-up" />
                        </div>
                      </Col>
                    </Row>
                    <p className="mt-3 mb-0 text-sm">
                      <span className="text-success mr-2">
                        <i className="fa fa-arrow-up" /> 3.48%
                      </span>{" "}
                      <span className="text-nowrap">Since last month</span>
                    </p>
                  </CardBody>
                </Card>
              </Col>
              <Col md="6" xl="3">
                <Card className="card-stats">
                  <CardBody>
                    <Row>
                      <div className="col">
                        <CardTitle
                          tag="h5"
                          className="text-uppercase text-muted mb-0"
                        >
                          Sales
                        </CardTitle>
                        <span className="h2 font-weight-bold mb-0">924</span>
                      </div>
                      <Col className="col-auto">
                        <div className="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i className="fa fa-arrow-down" />
                        </div>
                      </Col>
                    </Row>
                    <p className="mt-3 mb-0 text-sm">
                      <span className="text-success mr-2">
                        <i className="fa fa-arrow-up" /> 3.48%
                      </span>{" "}
                      <span className="text-nowrap">Since last month</span>
                    </p>
                  </CardBody>
                </Card>
              </Col>
              <Col md="6" xl="3">
                <Card className="card-stats">
                  <CardBody>
                    <Row>
                      <div className="col">
                        <CardTitle
                          tag="h5"
                          className="text-uppercase text-muted mb-0"
                        >
                          Performance
                        </CardTitle>
                        <span className="h2 font-weight-bold mb-0">49,65%</span>
                      </div>
                      <Col className="col-auto">
                        <div className="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                          <i className="ni ni-chart-bar-32" />
                        </div>
                      </Col>
                    </Row>
                    <p className="mt-3 mb-0 text-sm">
                      <span className="text-success mr-2">
                        <i className="fa fa-arrow-up" /> 3.48%
                      </span>{" "}
                      <span className="text-nowrap">Since last month</span>
                    </p>
                  </CardBody>
                </Card>
              </Col> */}
            </Row>
          </div>
        </Container>
      </div>
    </>
  );
}

CardsHeader.propTypes = {
  name: PropTypes.string,
  parentName: PropTypes.string,
};

export default CardsHeader;
