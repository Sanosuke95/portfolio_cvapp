import axios from "axios";

const apiClient = axios.create({
    baseURL: "http://127.0.0.1:8000/api",
    headers: {
        Authorization: "Bearer ",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    },
});

export default apiClient;
