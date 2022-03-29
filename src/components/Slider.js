import React, { useEffect, useRef, useState } from 'react';
import api from '../services/api';

export default function Slider(props) {

    const url = window.APIURL + 'sliders/' + (props.category ? props.category : '');
    const [sliders,setSlider] = useState(['asset/images/slider.png']);

    const sliderRef = useRef(null);

    let interval = 0;
    const createInterval = (current,total) => {
        // clearInterval(interval);

        if(total > 1){
            current = current < total && current >= 0 ? current : 0;
            // interval = setInterval(() => {
            //     const slides = sliderRef.current.getElementsByClassName('slider');
            //     for(let i = 0; i < slides.length; i++)
            //         slides[i].classList.remove('active');
            //     current++;
            //     current %= total;
            //     sliderRef.current.getElementsByClassName('slider')[current].classList.add('active');
            //     console.log(current);
            // }, 4000);
        }
    };

    useEffect(() => {
        api(url,{},result => {
            if(result.success){
                if(result.sliders.length > 0){
                    setSlider(result.sliders);
                }
                createInterval(0,result.sliders.length);
            }
            else console.warn('Slider could not be fethced.');
        });
    }, []);

    const previousSlide = () => {
        const slides = sliderRef.current.getElementsByClassName('slider');
        let i = 0;
        for(; i < slides.length; i++){
            if(slides[i].classList.contains('active')){
                slides[i].classList.remove('active');
                i += (sliders.length - 1);
                i %= sliders.length;
                break;
            }
        }
        slides[i].classList.add('active');
        createInterval(i,sliders.length);
    };
    const nextSlide = () => {
        const slides = sliderRef.current.getElementsByClassName('slider');
        let i = 0;
        for(; i < slides.length; i++){
            if(slides[i].classList.contains('active')){
                slides[i].classList.remove('active');
                i++;
                i %= sliders.length;
                break;
            }
        }
        slides[i].classList.add('active');
        createInterval(i,sliders.length);
    };
    
    return (
        <section className='slider-container'>
            <div className='previous' onClick={previousSlide}></div>
            <div className='next' onClick={nextSlide}></div>
            <div className='sliders' ref={sliderRef}>
                {sliders.map((slider,index) => 
                    <div className={'slider' + (index === 0 ? ' active' : '')} key={index}>
                        <img src={slider} alt="banner" />
                    </div>
                )}
            </div>
        </section>
    )
}
