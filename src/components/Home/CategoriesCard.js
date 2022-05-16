import React from "react";
import { Col, Row, Container } from "reactstrap";
import categories from "variables/categories";

const Category = (props) => {
    return (
        <Col className="text-center">
            {/* <img alt="..." className="rounded-circle shadow" src={props.data.url} height={80} width={80}/> */}
            <h4 className="mt-2" style={{cursor:"pointer"}}>{props.data.title}</h4>
        </Col>
    );
}

const CategoryCard = (props) =>{
    return(
        <Container fluid>
            <Row className="my-4">
                { categories.map((element, index) => <Category data={element} key={index} /> ) }
            </Row>
        </Container>
    )
}


export default CategoryCard;