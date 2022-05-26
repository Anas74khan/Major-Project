import React from 'react'
import { Spinner } from 'reactstrap'

export default function Preloader() {
  return (
    <div className="preloader">
        <Spinner type="grow"/>
    </div>
  )
}
