import React, { useState } from "react";
import Layout from "../../components/layout/Layout";
import Label from "../../components/label/Label";
import Input from "../../components/input/Input";
import Button from "../../components/button/Button";

function Contact() {
    const [inputs, setInputs] = useState({});

    const handleChange = (e) => {
        const { name, value } = e.target;
        setInputs((values) => ({ ...values, [name]: value }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(inputs);
    };

    return (
        <>
            <Layout>
                <h1>Contact</h1>
                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <Label title="email" />
                        <Input
                            type="text"
                            name="email"
                            value={inputs.email}
                            handleChange={handleChange}
                        />
                    </div>

                    <div className="mb-3">
                        <Label title="subject" />
                        <Input
                            type="text"
                            name="subject"
                            value={inputs.subject}
                            handleChange={handleChange}
                        />
                    </div>

                    <div className="mb-3">
                        <Label title="content" />
                        <Input
                            type="textarea"
                            name="content"
                            value={inputs.content}
                            rows={4}
                            handleChange={handleChange}
                        />
                    </div>
                    <div className="text-center">
                        <Button
                            label="Envoyer"
                            buttonType="primary"
                            type="submit"
                        />
                    </div>
                </form>
            </Layout>
        </>
    );
}

export default Contact;
