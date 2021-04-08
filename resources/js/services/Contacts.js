const getAll = (data) => {
    return axios
        .get("/api/contacts/", {
            headers: {
                Authorization: `Basic ${localStorage.getItem("token")}`,
            },
        })
}

const remove = ($id) => {
    return axios
        .delete("/api/contacts/" + $id, {
            headers: {
                Authorization: `Basic ${localStorage.getItem("token")}`,
            },
        })
}

const create = (data) => {
    return axios
        .post("/api/contacts/", data, {
            headers: {
                Authorization: `Basic ${localStorage.getItem("token")}`,
            },
        })
}


export default {
    getAll,
    create,
    remove
};