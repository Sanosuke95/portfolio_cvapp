import PropTypes from "prop-types";
import React from "react";

const Input = ({
    type,
    id,
    placeholder,
    label,
    rows,
    name,
    value,
    onChange,
}) => {
    if (type === "textarea") {
        return (
            <textarea
                className="form-control"
                rows={rows}
                id={id}
                name={name}
                value={value}
                onChange={onChange}
            >
                {label}
            </textarea>
        );
    } else {
        return (
            <input
                type={type}
                id={id}
                className="form-control"
                placeholder={placeholder}
                name={name}
                value={value}
                onChange={onChange}
            />
        );
    }
};

Input.propTypes = {
    type: PropTypes.string,
    id: PropTypes.string,
    placeholder: PropTypes.string,
    label: PropTypes.string,
    rows: PropTypes.number,
    name: PropTypes.string,
    value: PropTypes.string,
    onChange: PropTypes.any,
};

export default Input;
