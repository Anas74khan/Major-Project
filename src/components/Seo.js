import React from 'react'
import { Helmet } from 'react-helmet'

function Seo({title}) {
  return (
    <Helmet title={title} />
  )
}

export default Seo