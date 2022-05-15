import Home from "views/pages/home/home";
import ItemDetails from "views/pages/dashboard/itemDetails";
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
        path: "/detail-page",
        name: "detail",
        miniName: "L",
        component: ItemDetails,
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