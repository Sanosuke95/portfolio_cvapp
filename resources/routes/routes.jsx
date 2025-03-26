import { createBrowserRouter } from "react-router";
import Home from "../js/pages/Home";
import Contact from "../js/pages/contacts/Contact";

const router = createBrowserRouter([
    {
        path: "/",
        Component: Home,
    },
    {
        path: "/contact",
        Component: Contact,
    },
]);

export default router;
