import {
    Card,
    CardBody,
    Row,
    Col,
    CardTitle,
  } from "reactstrap";
  // core components
  
  function DashCard(props) {
    return (
        <Col md="6" xl="3">
            <Card className="card-stats">
                <CardBody className="px-3 py-2">
                    <Row className="p-2">
                        <CardTitle
                          tag="h5"
                          className="text-uppercase text-muted mb-0"
                        >
                          {props.title}
                        </CardTitle>
                    </Row>
                    <Row className="">
                        
                        <div className="text-center" style={{width: '30%'}}>
                            <div class={`icon icon-shape text-white rounded-circle shadow ${props.arrow? 'bg-gradient-success' : 'bg-gradient-danger'}`} style={{height:35, width:35}}>
                                <i class= {props.arrow? "fa fa-arrow-up" : "fa fa-arrow-down"} style={{fontSize:20,color:'white'}}></i>
                            </div>
                            <div>
                                <p className="text-sm my-1">
                                    <span className={`font-weight-bold ml-2 ${props.arrow ? 'text-success' : 'text-danger'}`}>
                                        {props.percent + "%"}
                                    </span>    
                                </p>
                            </div> 
                        </div>  
                        <div className="text-center" style={{width: '70%'}}>
                            <div>
                                <span className="h4 font-weight-bold mb-0">{props.value}</span>
                            </div>
                            <div>
                                <p className="text-sm mt-1">
                                    <span className="text-nowrap font-weight-bold ">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </Row>
                </CardBody>
            </Card>
        </Col>
    );
  }
  
  export default DashCard;