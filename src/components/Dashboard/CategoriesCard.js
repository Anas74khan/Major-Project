import React from "react";
import { Col } from "reactstrap";
const CategoryCard = (props) =>{
    return(
        <Col className="text-center">
            <img alt="..." className="rounded-circle shadow" src={props.data.url} height={80} width={80}/>
            <h4 className="mt-2" style={{cursor:"pointer"}}>{props.data.title}</h4>
        </Col>
    )
}

export default CategoryCard;