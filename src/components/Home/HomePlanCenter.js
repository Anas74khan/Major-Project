import React from "react";
import bg from "../../assests/assets_design/img/home/bgPlans.png";

class HomePlanCenter extends React.Component{
    render(){
        
        console.log(this.props.title)
        let title = "Pro";
        if(this.props.title){
            title = this.props.title;
        }
        return(
            <div class="card card-pricing text-center zoom" style={{ backgroundImage: `url(${bg})`, backgroundSize: 'cover', borderRadius:15}}>
                <div>
                    <button type="button" class="btn btn-secondary btn-round mt-4 text-dark" style={{fontSize: 20}}>{title}</button>
                </div>
                <div class="card-body">
                    <span class="display-2 text-white">₹ 999/-</span>
                    <ul class="list-unstyled my-4">
                        <li>
                            <div class="d-flex align-items-center">
                                <div>
                                <div class="icon icon-xs icon-shape bg-success shadow rounded-circle text-white">
                                    <i class="ni ni-check-bold"></i>
                                </div>
                                </div>
                                <div>
                                <span class="pl-2 text-md text-white">Multiple House Property</span>
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
                                    <span class="pl-2 text-md text-white">Loans</span>
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
                                    <span class="pl-2 text-md text-white">Salary Above 15 Lakhs </span>
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
                                    <span class="pl-2 text-md text-white">Maximum Refund</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a href="/plan_detail/ITR-SAL-03" class="text-center font-weight-bold text-white">More Details...</a>
                    <br/><br/>
                    <a href="/plan_detail/ITR-SAL-03" type="button" class="btn btn-secondary mb-3 text-blue">Buy Now</a> 
                                    
                </div> 
            </div> 
                 
        );
    }
}

export default HomePlanCenter;