import React, { useEffect, useState } from 'react';
import Categories from '../components/Categories';
import ProductCard from '../components/ProductCard';
import Slider from '../components/Slider';
import api from '../services/api';

export default function Home() {

  const [categories, setCategories] = useState([]);

  useEffect(() => {
    api('categories',{},result => {
      if(result.success){
        let temp = [];
        for(let i = 0; i < result.categories.length && i < 9; i++)
          temp.push(result.categories[i]);
        setCategories(temp);
      }
      else console.warn('Categories could not be fetched. Error: ' + result.text);
    });
  },[]);

  return (
    <div className='page-content'>

      <Categories categories={categories} />
      <Slider />
      <ProductCard url="products" title="Top rated products" subtitle="Shop Now" />
      <ProductCard url="products/all/all/all/0/12/offer" title="Best Discount" subtitle="Time to save more" />

    </div>
  )
}
