import React from 'react';
import { UncontrolledCarousel } from "reactstrap";

export default function Slider(props) {

    const sliders = props.sliders;
        
    return (
        <>
            <UncontrolledCarousel items={sliders} />
        </>
    )
}
