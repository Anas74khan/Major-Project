import React from 'react'

export default function Footer() {
  return (
    <div className='footer mt-3'>
      <div className='footer-container'>

        <div className='links'>
          <div className='link-heading'>About</div>
          <div className='link'>Contact Us</div>
          <div className='link'>About Us</div>
          <div className='link'>Blogs</div>
        </div>

        <div className='links'>
          <div className='link-heading'>Help</div>
          <div className='link'>Cancellation &amp; Return</div>
          <div className='link'>FAQ</div>
        </div>

        <div className='links'>
          <div className='link-heading'>Policy</div>
          <div className='link'>Return Policy</div>
          <div className='link'>Privacy Policy</div>
          <div className='link'>Terms &amp; Conditions</div>
          <div className='link'>Security Policy</div>
        </div>

        <div className='links'>
          <div className='link-heading'>Social</div>
          <div className='link'>LinkedIn</div>
          <div className='link'>Facebook</div>
          <div className='link'>Instagram</div>
          <div className='link'>Twitter</div>
        </div>

      </div>
      <div className='footer-bottom'>
        Developed by Major Project Team
      </div>
    </div>
  )
}
