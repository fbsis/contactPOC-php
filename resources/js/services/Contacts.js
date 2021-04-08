const getAll = (data) => {
    return axios
        .get("/api/contacts/", {
            headers: {
                Authorization: `Basic ${localStorage.getItem("token")}`,
            },
        })
}

const remove = ($id) => {
    axios
        .delete("/api/contacts/" + $id, {
            headers: {
                Authorization: `Basic ${localStorage.getItem("token")}`,
            },
        })
        .then(function (response) {
            return response.data;
        })
        .catch(function (error) {
            return "error";
        });
}


export default {
    getAll,
    remove
};