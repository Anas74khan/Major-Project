import Dashboard from "views/pages/dashboard/dashboard";
import ItemDetails from "views/pages/dashboard/itemDetails";
import Login from "views/pages/examples/Login.js";
import Register from "views/pages/examples/Register.js";

const routes = [{
        path: "/dashboard",
        name: "Dashboard",
        miniName: "D",
        component: Dashboard,
        layout: "/admin",
    },
    {
        path: "/detail-page",
        name: "detail",
        miniName: "L",
        component: ItemDetails,
        layout: "/admin",
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