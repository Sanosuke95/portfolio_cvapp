import ContactService from "../services/contactService";

class ContactData {

    constructor() {
        this.contact = new ContactService();
    }

    async getAllContact() {
        try {
            const response = await this.contact.getContacts();
            return response.data;
        } catch (error) {
            console.log(error);
            throw error;
        }
    }

    async showContact(uuid) {
        try {
            const response = await this.contact.showContact(uuid);
            return response;
        } catch (error) {
            console.log(error);
            throw error;
        }
    }
}

export default ContactData;