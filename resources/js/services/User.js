
const login = (email, password) => {
    return axios
        .post("/api/login", {
            email: email,
            password: password,
        })
}

const getSession = (data) => {
    return JSON.parse(localStorage.getItem("user"));
}

const getRoles = (data) => {
    return JSON.parse(localStorage.getItem("roles"));
}

const getToken = (data) => {
    return localStorage.getItem("token");
}

const setUserData = (data) => {
    localStorage.setItem("token", data.data);
    localStorage.setItem("roles", JSON.stringify(data.roles));
    localStorage.setItem("user", JSON.stringify(data.user));
    localStorage.getItem("token");
}



export default {
    login,
    getSession,
    getRoles,
    getToken,
    setUserData
};