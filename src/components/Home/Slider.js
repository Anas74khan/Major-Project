import React from 'react';
import sliders from 'variables/sliders';
import { UncontrolledCarousel } from "reactstrap";

export default function Slider(props) {

    // const url = 'sliders/' + (props.category ? props.category : '');
        
    return (
        <>
            <UncontrolledCarousel items={sliders} />
        </>
    )
}
