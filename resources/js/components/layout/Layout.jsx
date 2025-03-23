import React from "react";
import PropTypes from "prop-types";
import Nav from "../nav/Nav";

const Layout = ({ children }) => {
    return (
        <>
            <Nav />
            <div className="container">
                <div>{children}</div>
            </div>
        </>
    );
};

Layout.propTypes = {
    children: PropTypes.node,
};

export default Layout;
