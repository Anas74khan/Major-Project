import React from 'react';
import { Spinner } from "reactstrap";

export default function Loader() {
  return (
    <div className="loader">
        <Spinner type="grow"/>
    </div>
  )
}
