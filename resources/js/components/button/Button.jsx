import React from "react";
import PropTypes from "prop-types";

const Button = ({ label, buttonType, type }) => {
    return (
        <button className={`btn btn-${buttonType}`} type={type}>
            {label}
        </button>
    );
};

Button.propTypes = {
    label: PropTypes.string.isRequired,
    buttonType: PropTypes.oneOf(["primary", "secondary", "danger"]).isRequired,
    type: PropTypes.func,
};

export default Button;
