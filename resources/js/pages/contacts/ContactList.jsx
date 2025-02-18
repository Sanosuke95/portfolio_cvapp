import React, { useEffect, useState } from "react";
import { getContacts } from "../../services/contactService";

function ContactList() {
    const [contact, setContact] = useState([]);
    useEffect(() => {
        const dataList = async () => {
            const data = await getContacts();
            setContact(data);
        };

        dataList();
        console.log(dataList);
    }, []);
}

export default ContactList;
