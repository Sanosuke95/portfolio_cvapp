import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom/client";
import "bootstrap/dist/css/bootstrap.min.css";

import Button from "./components/Button";
import ContactData from "./data/ContactData";

function Hello() {
    const [data, setData] = useState([]);
    const [showContact, setShowContact] = useState([]);
    const contact = new ContactData();
    const handleSubmit = () => {
        console.log("Hello");
        console.log(contact);
    };

    useEffect(() => {
        const contactList = async () => {
            const result = await contact.getAllContact();
            setData(result.data);
        }

        const contactShow = async () => {
            const result = await contact.showContact('95b3ab8d-7850-4096-8ebd-76601922b8b8');
            console.log(result);
        }
    }, []);

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
