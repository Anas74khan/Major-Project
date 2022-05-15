import {Card, CardBody, CardHeader, Row, Col, CardFooter, Button, NavLink} from "reactstrap";
import {Link} from "react-router-dom"
function Product(props){
    return(
        <>
            <Card>
                <CardBody>
                    <NavLink className="px-0" to="/admin/detail-page" tag={Link}>
                        <h4 className="link-tap" style={{textDecoration:"underline"}}>{props.title}</h4>
                    </NavLink>
                    <Row>
                        <Col>
                            <span>{parseFloat(props.rating).toFixed(1)+ " "}
                                {[...Array(5)].map((star, index)=>{
                                    if(index<props.rating){
                                        return(
                                            <i key={index} className="fa fa-star text-orange" aria-hidden="true"></i>
                                        );
                                    }
                                    else{
                                        return(
                                            <i key={index} className="far fa-star text-orange" aria-hidden="true"></i>
                                        );
                                    }; 
                                })}
                            </span>
                        </Col>
                        <Col xs="auto">
                            <p className="font-weight-bold" style={{fontSize:20}}>
                                {"$"+props.price}
                            </p>
                        </Col>
                    </Row>
                    <div className="text-center">
                        <img src={props.image} alt="error" className="img-fluid" style={{height:180}}/>
                    </div>
                </CardBody>
                <CardFooter className="">
                    <Row>
                        <Col>
                            <Button type="button" style={{width:"100%", backgroundColor:'#43a1f6', color:'white'}}>Add TO Cart</Button>
                        </Col>
                        <Col>
                            <Button type="button" style={{width:"100%", backgroundColor:'#43a1f6', color:'white'}}>Buy Now</Button>
                        </Col>
                    </Row>
                </CardFooter>
            </Card>
        </>
    )
}

export default Product;