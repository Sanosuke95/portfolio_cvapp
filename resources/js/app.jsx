import React from "react";
import ReactDOM from "react-dom/client";

import "bootstrap/dist/css/bootstrap.min.css";
import { RouterProvider } from "react-router";
import router from "../routes/routes";

// function Hello() {
//     const [data, setData] = useState([]);
//     const [showContact, setShowContact] = useState([]);
//     const contact = new ContactData();
//     const handleSubmit = () => {
//         console.log("Hello");
//         console.log(contact);
//     };

//     useEffect(() => {
//         const contactList = async () => {
//             const result = await contact.getAllContact();
//             setData(result.data);
//         };

//         const contactShow = async () => {
//             const result = await contact.showContact(
//                 "95b3ab8d-7850-4096-8ebd-76601922b8b8"
//             );
//             console.log(result);
//         };
//     }, []);

//     return (
//         <>
//             <Layout>
//                 <h1>Hello World!</h1>
//                 <Button label="Hello" type="primary" submit={handleSubmit} />
//             </Layout>
//         </>
//     );
// }

const root = document.querySelector("#root");
ReactDOM.createRoot(root).render(<RouterProvider router={router} />);
