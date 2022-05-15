import React from "react";
// react library for routing
import { useLocation, Route, Switch, Redirect } from "react-router-dom";
// core components
import AdminNavbar from "components/Navbars/AdminNavbar.js";

import routes from "routes.js";

function Admin() {
  const location = useLocation();
  const mainContentRef = React.useRef(null);
  React.useEffect(() => {
    document.documentElement.scrollTop = 0;
    document.scrollingElement.scrollTop = 0;
    mainContentRef.current.scrollTop = 0;
  }, [location]);
  const getRoutes = (routes) => {
    return routes.map((prop, key) => {
      if (prop.collapse) {
        return getRoutes(prop.views);
      }
      if (prop.layout === "/admin") {
        return (
          <Route
            path={prop.layout + prop.path}
            component={prop.component}
            key={key}
          />
        );
      } else {
        return null;
      }
    });
  };
  
  return (
    <>
      <div className="main-content" ref={mainContentRef}>
        <AdminNavbar
          theme={"dark"}
        />
        <Switch>
          {getRoutes(routes)}
          <Redirect from="*" to="/admin/dashboard" />
        </Switch>
      </div>
    </>
  );
}

export default Admin;
