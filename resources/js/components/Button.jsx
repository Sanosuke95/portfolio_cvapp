import React from "react";

function Button({ children, className, onClick, type }) {
    return (
        <button onClick={onClick} className={className} type={type}>
            {children}
        </button>
    );
}

export default Button;
