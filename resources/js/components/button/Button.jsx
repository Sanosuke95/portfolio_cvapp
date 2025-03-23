import React from "react";
import PropTypes from "prop-types";

const Button = ({ label, type, submit }) => {
    return (
        <button className={`btn btn-${type}`} onClick={submit}>
            {label}
        </button>
    );
};

Button.propTypes = {
    label: PropTypes.string.isRequired,
    type: PropTypes.oneOf(["primary", "secondary", "danger"]).isRequired,
    submit: PropTypes.func,
};

export default Button;
