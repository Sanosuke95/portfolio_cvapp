import apiClient from "../utils/api";

class ContactService {
    getContacts() {
        apiClient
            .get("/contact")
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }

    showContact(uuid) {
        apiClient
            .get(`/contact/${uuid}`)
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }

    createContact(data) {
        apiClient
            .post("/contact", data)
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }
}

export default ContactService;
