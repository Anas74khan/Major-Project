import React from 'react';

export default function Categories(props) {
    
    const categories =  props.categories;

    if(categories.length == 0) return (<></>);
    return (
        <div className='categories'>
            { categories.map((category,index) => <Category name={category.tag} id={category.id} key={index} slug={category.slug} />) }
        </div>
    )
}

function Category(props){

    return (
        <div className='category'>{props.name}</div>
    );
}
