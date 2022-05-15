import React from "react";
import footerLogo from "../../assests/assets_design/img/howitswork/footerlogo.svg";

class Footer extends React.Component{
    render(){
        return(
            <footer className="bg-dark card-round pt-5">
                <div className='row' style={{display: 'flex', justifyContent:'center', alignItems:'center'}}>
                    <div className='col-sm-10' >
                        <h3 className='text-center text-white'>Frequently Asked Questions</h3>
                    </div>
                </div>
                <div className="row px-3 pt-5">
                    <div className="col-sm mm">
                        <img className='rounded' width="200px" height="70px" src={footerLogo} alt="alt tag"/>
                    </div>
                </div>
                <div className='row pt-5' style={{display: 'flex', justifyContent:'center', alignItems:'center'}}>
                    <div className='col-sm-10'>
                        <h5 className='text-center text-white'>Copyright © 2021 Absolute Compliance Private Limited</h5>
                        <h4 className='text-center text-white'>
                            <a href='/' className='text-white'>Terms & conditions</a> | <a href='/' className='text-white'>Privacy policy</a>
                        </h4>
                    </div>
                </div>
          </footer>
        );
    }
}

export default Footer;