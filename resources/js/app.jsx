import React from "react";
import ReactDOM from "react-dom/client";
import "bootstrap/dist/css/bootstrap.min.css";

import Button from "./components/Button";

function Hello() {
    const handleSubmit = () => {
        console.log("Hello");
    };
    return (
        <>
            <h1>Hello World!</h1>
            <Button onClick={handleSubmit} className={"btn btn-primary"}>
                Hello
            </Button>
        </>
    );
}

const container = document.getElementById("root");
const root = ReactDOM.createRoot(container);
root.render(<Hello />);
