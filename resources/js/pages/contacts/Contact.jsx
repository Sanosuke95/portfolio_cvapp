import React, { useEffect, useState } from "react";
import Layout from "../../components/layout/Layout";

function Contact() {
    const [contact, setContact] = useState([]);

    useEffect(() => {
        const dataList = async () => {
            const data = await getContacts();
            setContact(data);
        };

        dataList();
        console.log(dataList);
    }, []);

    return (
        <>
            <Layout>
                <h1>Contact</h1>
                {contact.map((item) => {
                    <ul>
                        <li>{item.email}</li>
                    </ul>;
                })}
            </Layout>
        </>
    );
}

export default Contact;
