import Home from "views/pages/home/home";
import Product from "views/pages/product/product";
import Login from "views/pages/examples/Login.js";
import Register from "views/pages/examples/Register.js";

const routes = [{
        path: "/home",
        name: "Home",
        miniName: "H",
        component: Home,
        layout: "",
    },
    {
        path: "/product",
        name: "Product",
        miniName: "P",
        component: Product,
        layout: "",
    },
    {
        path: "/login",
        name: "Login",
        miniName: "L",
        component: Login,
        layout: "/auth",
    },
    {
        path: "/register",
        name: "Register",
        miniName: "R",
        component: Register,
        layout: "/auth",
    },
];

export default routes;