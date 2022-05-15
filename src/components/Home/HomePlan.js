import React from "react";
import { Button } from "reactstrap";
import { Link } from "react-router-dom";


class HomePlan extends React.Component{
    render(){
        // console.log(this.props.title)
        const title = this.props.title;
        const price = this.props.price;
        
        return(
            <div class="card card-pricing text-center zoom" style={{ backgroundColor: 'white', backgroundSize: 'cover', borderRadius:10}}>
                <div class="mt-3">
                    <span class="text-dark" style={{fontSize: 20}}>{title}</span>
                </div>
                <div class="card-body">
                    <span class="display-4 text-dark">₹ {price}/-</span>
                    <ul class="list-unstyled my-4">
                        <li>
                            <div class="d-flex align-items-center">
                                <div>
                                <div class="icon icon-xs icon-shape bg-success shadow rounded-circle text-white">
                                    <i class="ni ni-check-bold"></i>
                                </div>
                                </div>
                                <div>
                                <span class="pl-2 text-md text-dark">Multiple House Property</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="icon icon-xs icon-shape bg-success shadow rounded-circle text-white">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="pl-2 text-md text-dark">Loans</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="icon icon-xs icon-shape bg-success shadow rounded-circle text-white">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="pl-2 text-md text-dark">Salary Above 15 Lakhs </span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="icon icon-xs icon-shape bg-success shadow rounded-circle text-white">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="pl-2 text-md text-dark">Maximum Refund</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a href="/plan_detail/ITR-SAL-03" class="text-center font-weight-bold text-blue">More Details...</a>
                    <br/><br/>
                    <Button color="primary" type="button" to="/auth/buyplan" tag={Link}> 
                        Buy Now
                    </Button>      
                </div> 
            </div> 
                 
        );
    }
}

export default HomePlan;