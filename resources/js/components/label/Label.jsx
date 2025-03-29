import PropTypes from "prop-types";
import React from "react";

const Label = ({ title, htmlFor }) => {
    return (
        <label htmlFor={htmlFor} className="form-label">
            {title}
        </label>
    );
};

Label.propTypes = {
    title: PropTypes.string,
    htmlFor: PropTypes.string,
};

export default Label;
