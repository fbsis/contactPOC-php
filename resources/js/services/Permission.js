import UserService from "./User";

const canAdd = () => {
    return UserService.getRoles().find(e => e.role === 'add');
}

const canDelete = () => {
    return UserService.getRoles().find(e => e.role === 'delete');
}


export default {
    canAdd,
    canDelete
};