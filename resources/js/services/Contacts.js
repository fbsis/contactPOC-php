import UserService from "./User";

const getAll = (data) => {
    return axios
        .get("/api/contacts/", {
            headers: {
                Authorization: `Basic ${UserService.getToken()}`,
            },
        })
}

const remove = ($id) => {
    return axios
        .delete("/api/contacts/" + $id, {
            headers: {
                Authorization: `Basic ${UserService.getToken()}`,
            },
        })
}

const create = (data) => {
    return axios
        .post("/api/contacts/", data, {
            headers: {
                Authorization: `Basic ${UserService.getToken()}`,
            },
        })
}


export default {
    getAll,
    create,
    remove
};