import React from "react";
// react library for routing
import { Route, Switch, Redirect } from "react-router-dom";
// core components
import UserNavbar from "components/Navbars/UserNavbar.js";

import routes from "routes.js";
import Footer from "components/Footers/Footer";

function Controller() {
  const mainContentRef = React.useRef(null);
  React.useEffect(() => {
    document.documentElement.scrollTop = 0;
    document.scrollingElement.scrollTop = 0;
    mainContentRef.current.scrollTop = 0;
  }, []);
  
  const getRoutes = (routes) => {
    return routes.map((prop, key) => {
      if (prop.collapse) {
        return getRoutes(prop.views);
      }
      if (prop.layout === "") {
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
        <UserNavbar
          theme={"dark"}
        />
        <Switch>
          {getRoutes(routes)}
          <Redirect from="*" to="/home" />
        </Switch>
        <Footer />
      </div>
    </>
  );
}

export default Controller;
