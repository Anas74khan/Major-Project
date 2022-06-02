import React, { useEffect, useState } from "react";

import CategoryCard from "components/Home/CategoriesCard";
import Slider from "components/Home/Slider";
import ProductContainer from "components/Home/ProductContainer";
import Seo from "components/Seo";
import { api } from "services/api";
import Loader from "components/Loader";

const Home = () =>{

    const [page, setPage] = useState({});
    
    useEffect(() => {
        api("",{}, result => {
            if(!result.success) alert("Some error occured! Try refreshing the page");

            setPage(result);
        });
    },[]);
    
    if(!page.success)
        return(
            <Loader />
        );

    return(
        <>
            <Seo title="Home | E-commerce" />
            { page.categories ? <CategoryCard categories={page.categories} /> : <></> }
            <hr className="my-0 text-primary bg-secondary shadow"/>
            { page.sliders ? <Slider sliders={page.sliders} /> : <></> }

            {
                page.sections && page.sections.map((section, index) =>
                    <ProductContainer key={index} products={section.products} title={section.title} subtitle={section.subtitle} />
                )
            }

        </>
    )
}

export default Home;