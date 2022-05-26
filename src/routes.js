import Home from "views/pages/home/home";
import Product from "views/pages/product/product";
import CartConatiner from "views/pages/cart/Cart";

const authToken = window.localStorage.getItem('authToken');

const routes = [{
        path: "/home",
        name: "Home",
        miniName: "H",
        component: Home,
        layout: "",
    },
    {
        path: "/product/:product",
        name: "Product",
        miniName: "P",
        component: Product,
        layout: "",
    },
    {
        path: "/cart",
        name: "cart",
        miniName: "C",
        component: CartConatiner,
        layout: "",
        invalid: !authToken ? true : false
    },
];

export default routes;