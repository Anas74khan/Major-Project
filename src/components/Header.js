import React, { useState } from 'react';

export default function Header() {

  const [showLinks,setShowLinks] = useState(false);
  const [user,setUser] = useState(undefined);

  return (
    <header className='header'>

      <div className='logo'>
        <img src='asset/logo.png' alt='logo'/>
      </div>

      <div className='search-container'>
        <input type='search' id='search' placeholder='Search for product...' />
        <img src='asset/icons/search.png' alt='search-icon' />
      </div>

      <div className='header-links'>

        <a className='header-link'>
          <img src='asset/icons/cart.png' alt='cart-icon' />
          <span className='badge'>{user != undefined ? user.cartQuantity : 0}</span>
          <span>Cart</span>
        </a>
        {
          user !== undefined ?
          <a className={'header-link dropdown' + (showLinks ? ' up' : '')} onMouseEnter={() => setShowLinks(true)} onMouseLeave={() => setShowLinks(false)}>
            My Account
          </a>
          :
          <div className='login-register'>
            <a className='login-link'>Login</a>
            <a className='register-link'>Sign Up</a>
          </div>
        }

        {
          showLinks ?
            <div className='accountLinks' onMouseEnter={() => setShowLinks(true)} onMouseLeave={() => setShowLinks(false)}>
              <a className='accountLink'>
                My Profile
              </a>
              <a className='accountLink'>
                Orders
              </a>
              <a className='accountLink'>
                Log out
              </a>
            </div>
          : ''
        }

      </div>

    </header>
  )
}
