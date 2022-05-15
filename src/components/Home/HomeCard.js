import React from "react";

class HomeCard extends React.Component{
    render(){
        const img = this.props.image;
        const title = this.props.title;
        const descTitle = this.props.descTitle;
        const descBody = this.props.descBody;
        const color = this.props.color;

        return(
            <div className="col-sm-3">
                <div className="card text-center">
                    <div className="card-body " >
                        <span className="details">
                            <img className="img-fluid" style={{height:180, width:'100%'}} src={img} alt="self Employee" />
                            <div className="pt-5" style={{height:50}}>
                                <b className="display-4 float-left" style={{fontSize:16}}>{title}</b>
                                <i className="ni ni-bold-right display-4 float-right" style={{fontSize:16}}></i> 
                            </div>
                            <div className="content" style={{ backgroundColor:color}}>
                                <div className="middle" style={{height:'100%'}}>
                                    <div>
                                        <h3 className="text-center text-white " >{descTitle}</h3>
                                        <p className="font-weight-600">{descBody} </p>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        );
    }
}

export default HomeCard;