import React from "react";


class MainCard extends React.Component{
    render(){
        
        const title = this.props.title;
        const img = this.props.img;
        const bg = this.props.bg;
        const index1 = this.props.index1;

        console.log("hello")
        console.log(index1)
        return(
            <li class="nav-item col-lg-2" style={{paddingRight:0}}>
                <a class="nav-link mb-sm-9 mb-md-0 main_image1" href="/" style={{backgroundColor: bg? '#5e72e4': 'white'}}>
                    <div class="">
                        <div class="card-body mx-auto">
                            <img id="add_image1" src={img} class="img-fluid" alt="" height="100%" />
                        </div>
                        <p class="font-weight-bold text-center">{title}</p>
                    </div>
                </a>
            </li>    
        );
    }
}

export default MainCard;