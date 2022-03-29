import { useState } from "react";
import Footer from "./components/Footer";
import Header from "./components/Header";
import Home from "./pages/Home";
import ProductDetail from "./pages/ProductDetail";

function App() {

  return (
    <div className="App">
      <Header />
      
        <ProductDetail />

      <Footer />
    </div>
  );
}

export default App;
