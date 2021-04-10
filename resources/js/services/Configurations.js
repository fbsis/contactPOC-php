import UserService from "./User";

const get = (data) => {
    return axios
        .get("/api/config/", {
            headers: {
                Authorization: `Basic ${UserService.getToken()}`,
            },
        })
}
const update = (data) => {
    return axios
        .post("/api/config/", data, {
            headers: {
                Authorization: `Basic ${UserService.getToken()}`,
            },
        })
}


export default {
    get,
    update
};