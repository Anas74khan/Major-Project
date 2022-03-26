import React from 'react';
import ProductCard from '../components/ProductCard';
import Slider from '../components/Slider';

export default function Home() {
  return (
    <div className='page-content'>

      <Slider />
      <ProductCard url="products" title="Top rated products" subtitle="Shop Now" />
      <ProductCard url="products/all/all/all/0/12/offer" title="Best Discount" subtitle="Time to save more" />

    </div>
  )
}
