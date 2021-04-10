<script>
import ContactsService from "../services/Contacts";
import PermissionService from "../services/Permission";
import ModalFormComponent from "./ModalFormComponent.vue";
import ModalConfigComponent from "./ModalConfigComponent";

export default {
  components: { ModalFormComponent, ModalConfigComponent },
  mounted() {
    this.canAdd = PermissionService.canAdd();
    this.canDelete = PermissionService.canDelete();
    this.getContacts();
  },
  data: function () {
    return {
      contacts: [],
      created: false,
      canAdd: true,
      canDelete: true,
    };
  },

  methods: {
    getContacts: function (e) {
      let self = this;
      ContactsService.getAll().then(function (response) {
        self.contacts = response.data.data;
      });
    },

    removeContact: function (e) {
      let self = this;
      ContactsService.remove(e.id).then(function () {
        self.getContacts();
      });
    },

    contactCreated: function (e) {
      this.created = true;
      this.getContacts();
    },
  },
};
</script>

<template>
  <div>
    <button
      type="button"
      class="btn btn-outline-primary"
      data-toggle="modal"
      data-target="#modalContact"
      v-if="canAdd"
    >
      Add new Contact
    </button>

    <button
      type="button"
      class="btn btn-outline-secondary"
      data-toggle="modal"
      data-target="#modalConfig"
    >
      Configuration
    </button>

    <div
      class="alert alert-success lert-dismissible fade show"
      role="alert"
      v-if="created"
    >
      Contact was create with success
      <button
        type="button"
        class="close"
        data-dismiss="alert"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">email</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" :key="contact.id">
          <th scope="row">{{ contact.name }}</th>
          <td>{{ contact.email }}</td>
          <td>
            <button
              type="button"
              class="btn btn-primary"
              v-on:click="removeContact(contact)"
              v-if="canDelete"
            >
              Remove
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <ModalFormComponent @created="contactCreated" />
    <ModalConfigComponent />
  </div>
</template>

<style scoped>
input {
  margin-bottom: 10px;
}
table.table {
  margin-top: 10px;
}

div.alert {
  margin-top: 10px;
}
</style>