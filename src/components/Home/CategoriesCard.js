import React from "react";
import { Col, Row, Container } from "reactstrap";

const Category = (props) => {
    return (
        <Col className="text-center cursor-pointer">
            {/* <img alt="..." className="rounded-circle shadow" src={props.data.url} height={80} width={80}/> */}
            <h4 className="mt-2">{props.data.tag}</h4>
        </Col>
    );
}

const CategoryCard = (props) =>{
    const categories = props.categories;

    return(
        <Container fluid>
            <Row className="my-4">
                { categories.map((element, index) => <Category data={element} key={index} /> ) }
            </Row>
        </Container>
    )
}


export default CategoryCard;