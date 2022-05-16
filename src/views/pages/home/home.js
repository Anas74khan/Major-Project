import React from "react";

import CategoryCard from "components/Home/CategoriesCard";
import Slider from "components/Home/Slider";
import ProductContainer from "components/Home/ProductContainer";

const Home = () =>{
    return(
        <>
            <CategoryCard />
            <hr className="my-0 text-primary bg-secondary shadow" />
            <Slider />
            <ProductContainer url="products/all/all/all/0/6" title="Top rated products" subtitle="Shop Now" />
            <ProductContainer url="products/all/all/all/0/6/offer" title="Best Discount" subtitle="Time to save more" />
        </>
    )
}

export default Home;