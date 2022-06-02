import Home from "views/pages/home/home";
import Product from "views/pages/product/product";
import CartContainer from "views/pages/cart/Cart";
import OrdersContainer from "views/pages/order/orders";
import OrderContainer from "views/pages/order/order";

const authToken = window.localStorage.getItem('user');

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
        component: CartContainer,
        layout: "",
        invalid: !authToken ? true : false
    },
    {
        path: "/orders",
        name: "orders",
        miniName: "O",
        component: OrdersContainer,
        layout: "",
        invalid: !authToken ? true : false
    },
    {
        path: "/order/:orderNo",
        name: "orderDetails",
        miniName: "OD",
        component: OrderContainer,
        layout: "",
        invalid: !authToken ? true : false
    },
];

export default routes;