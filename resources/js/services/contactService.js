import apiClient from "../utils/api";

class ContactService
{
    async getContacts() {
        try {
            const response = await apiClient.get('/contact');
            return response;
        } catch (error) {
            console.log(error);
            throw error;
        }
    }

    async showContact(uuid) {
        try {
            const response = await apiClient.get(`/contact/${uuid}`);
            return response;
        } catch (error) {
            console.log(error);
            throw error;
        }
    }
}

export default ContactService;
// async function getContacts() {
//     try {
//         const response = await instance.get("/contact");
//         return response;
//     } catch (error) {
//         console.error("Error fetching contacts : ", error);
//         throw error;
//     }
// }

// async function getContact(uuid) {
//     try {
//         const response = await instance.get(`/contact/${uuid}`);
//         return response;
//     } catch (error) {
//         console.error("Error get contact : ", error);
//         throw error;
//     }
// }

// async function createContact(data) {
//     try {
//         const response = await instance.post("/contact", data);
//         return response;
//     } catch (error) {
//         console.error("Error creation contact", error);
//         throw error;
//     }
// }

// async function deleteContact(uuid) {
//     try {
//         const response = await instance.delete(`/contact/${uuid}`);
//         return response;
//     } catch (error) {
//         console.error("Error delete contact : ", error);
//         throw error;
//     }
// }

// export { getContact, getContacts, createContact, deleteContact };
