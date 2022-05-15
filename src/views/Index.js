import React from 'react';
import './App.css';

import Home from './pages/home/home';
import IndexHeader from 'components/Headers/IndexHeader';
import AdminNavbar from 'components/Navbars/IndexNavbar';

function Index() {
  return (
    <>
      <AdminNavbar/>
      <IndexHeader/>
      {/* <Home /> */}
    </>
  );
}

export default Index;

